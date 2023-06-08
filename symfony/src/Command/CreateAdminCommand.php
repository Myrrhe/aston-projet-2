<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Creates a new admin.',
    hidden: false,
    aliases: ['app:add-admin']
)]
class CreateAdminCommand extends Command
{
    protected static $defaultDescription = 'Creates a new admin.';

    private bool $requirePassword;

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher,
                                private EntityManagerInterface $entityManager,
                                bool $requirePassword = false)
    {
        $this->requirePassword = $requirePassword;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to create an admin...')
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the admin.')
            ->addArgument('password', $this->requirePassword ? InputArgument::REQUIRED : InputArgument::OPTIONAL,
                          'User password')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        // Empty because doesn't need to be overloaded
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        // Empty because doesn't need to be overloaded
    }

    protected function execute(InputInterface $input,
                               OutputInterface $output): int
    {
        $password = 'admin';
        if (!is_null($input->getArgument('password'))) {
            $password = $input->getArgument('password');
        }
        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setUsername('admin');
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $password,
            )
        );
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $output->writeln('L\'admin ' . $input->getArgument('email') . ' a été crée avec succès. Mot de passe : ' . $password);
        return Command::SUCCESS;
    }
}
