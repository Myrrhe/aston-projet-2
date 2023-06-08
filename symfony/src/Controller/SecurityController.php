<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/admin/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // To prevent a logged user to come back to the login form
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_admin_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
 
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout()
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/admin/password_change', name: 'admin_password_change', methods: ['GET', 'POST'])]
    public function adminPasswordChange(UserPasswordHasherInterface $passwordHasher,
                                        EntityManagerInterface $entityManager,
                                        Request $request,
                                        ): Response
    {
        $password1 = '';
        $password2 = '';
        $password3 = '';
        $form = $this->createFormBuilder()
            ->add('password1', PasswordType::class, ['label' => 'Ancien mot de passe :',])
            ->add('password2', PasswordType::class, ['label' => 'Nouveau mot de passe :',])
            ->add('password3', PasswordType::class, ['label' => 'Confirmation du nouveau mot de passe :',])
            ->add('save', SubmitType::class, ['label' => 'Modifier mon mot de passe',])
            ->getForm();
        
        $form->handleRequest($request);

        $rightPassword = true;
        $passwordMatch = true;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            /** @var PasswordAuthenticatedUserInterface */
            $passwordAuthenticatedUserInterface = $this->getUser();

            $rightPassword = $passwordHasher->isPasswordValid($passwordAuthenticatedUserInterface, $data['password1']);
            $passwordMatch = $data['password2'] == $data['password3'];

            if (!$rightPassword || !$passwordMatch) {
                if (!$rightPassword) {
                    $form->get('password1')->addError(new FormError('Votre ancien mot de passe est incorrect. Veuillez le rectifier.'));
                }
                if (!$passwordMatch) {
                    $form->get('password3')->addError(new FormError('Les deux mots de passe ne correspondent pas.'));
                }
                return $this->renderForm('admin_password_change/admin_password_change.html.twig', [
                    'password1' => $password1,
                    'password2' => $password2,
                    'password3' => $password3,
                    'form' => $form,
                ]);
            }
            /** @var User */
            $user = $passwordAuthenticatedUserInterface;
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $passwordAuthenticatedUserInterface,
                    $data['password3'],
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('admin_password_change_done');
        }
        return $this->renderForm('admin_password_change/admin_password_change.html.twig', [
            'password1' => $password1,
            'password2' => $password2,
            'password3' => $password3,
            'form' => $form,
        ]);
        
    }

    #[Route('/admin/password_change/done/', name: 'admin_password_change_done', methods: ['GET'])]
    public function adminPasswordChangeDone()
    {
        return $this->render('admin_password_change/admin_password_change_done.html.twig', []);
    }
}
