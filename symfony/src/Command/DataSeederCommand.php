<?php

namespace App\Command;

use App\Entity\Allergy;
use App\Entity\Block;
use App\Entity\Department;
use App\Entity\Illness;
use App\Entity\Medication;
use App\Entity\Room;
use App\Entity\Specialization;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:data-seed',
    description: 'Create data in the database.',
    hidden: false,
    aliases: ['app:data-seeder']
)]
class DataSeederCommand extends Command
{
    protected static $defaultDescription = 'Create data in the database.';

    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to put data in the database...');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        // Empty because doesn't need to be overloaded
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        // Empty because doesn't need to be overloaded
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        // This big array contains the data we'll put in the database
        // important warning : Doesn't support the foreigns keys for now
        $params = [
            Allergy::class => [
                'attrs' => [
                    'name' => [
                        'get' => 'getName',
                        'set' => 'setName',
                    ],
                ],
                'values' => [
                    '0' => [
                        'name' => 'Povidone iodée',
                    ],
                    '1' => [
                        'name' => 'Penicillin',
                    ],
                ],
            ],
            Block::class => [
                'attrs' => [
                    'phone' => [
                        'get' => 'getPhone',
                        'set' => 'setPhone',
                    ],
                    'floor' => [
                        'set' => 'setFloor',
                    ],
                ],
                'values' => [
                    '0' => [
                        'phone' => '0113467928',
                        'floor' => 0,
                    ],
                    '1' => [
                        'phone' => '0117399731',
                        'floor' => 1,
                    ],
                ],
            ],
            Department::class => [
                'attrs' => [
                    'name' => [
                        'get' => 'getName',
                        'set' => 'setName',
                    ],
                    'head' => [
                        'get' => 'getHead',
                        'set' => 'setHead',
                    ],
                    'oathDate' => [
                        'get' => 'getOathDate',
                        'set' => 'setOathDate',
                    ],
                ],
                'values' => [
                    '0' => [
                        'name' => 'Oncologie',
                        'head' => 1,
                        'oathDate' => new \DateTime(),
                    ],
                    '1' => [
                        'name' => 'Pédiatrie',
                        'head' => 2,
                        'oathDate' => new \DateTime(),
                    ],
                    '2' => [
                        'name' => 'Cardiologie',
                        'head' => 3,
                        'oathDate' => new \DateTime(),
                    ],
                ],
            ],
            Illness::class => [
                'attrs' => [
                    'name' => [
                        'get' => 'getName',
                        'set' => 'setName',
                    ],
                ],
                'values' => [
                    '0' => [
                        'name' => 'Rhume',
                    ],
                    '1' => [
                        'name' => 'SARS-CoV-2',
                    ],
                ],
            ],
            Medication::class => [
                'attrs' => [
                    'name' => [
                        'get' => 'getName',
                        'set' => 'setName',
                    ],
                    'brand' => [
                        'set' => 'setBrand',
                    ],
                    'price' => [
                        'set' => 'setPrice',
                    ],
                    'description' => [
                        'set' => 'setDescription',
                    ],
                ],
                'values' => [
                    '0' => [
                        'name'        => 'Povidone iodée',
                        'brand'       => 'Bétadine',
                        'price'       => 97.0,
                        'description' => 'Solution moussante pour application locale. Flacon de 500 ml',
                    ],
                    '1' => [
                        'name'        => 'Pénicilline',
                        'brand'       => 'AMODEX Gé',
                        'price'       => 3010.0,
                        'description' => 'Antibiotique bêta-lactamine',
                    ],
                ],
            ],
            // Room::class => [
            //     'attrs' => [
            //         'name' => [
            //             'set' => 'setName',
            //         ],
            //         'type' => [
            //             'set' => 'setType',
            //         ],
            //         'number' => [
            //             'get' => 'getNumber',
            //             'set' => 'setNumber',
            //         ],
            //         'floor' => [
            //             'set' => 'setFloor',
            //         ],
            //         'blockId' => [
            //             'set'   => 'setBlockId',
            //             'model' => Block::class,
            //         ],
            //     ],
            //     'values' => [
            //         '0' => [
            //             'name'    => 'Salle d\'attente principale',
            //             'type'    => 'wait',
            //             'number'  => '001',
            //             'floor'   => '0',
            //             'blockId' => 1,
            //         ],
            //         '1' => [
            //             'name'    => 'Salle d\'opération n°1',
            //             'type'    => 'operation',
            //             'number'  => '011',
            //             'floor'   => '1',
            //             'blockId' => 2,
            //         ],
            //     ],
            // ],
            Specialization::class => [
                'attrs' => [
                    'name' => [
                        'get' => 'getName',
                        'set' => 'setName',
                    ],
                ],
                'values' => [
                    '0' => [
                        'name' => 'Chirurgie',
                    ],
                    '1' => [
                        'name' => 'Allergologie',
                    ],
                ],
            ],
        ];

        $nbCreated = 0;
        $nbAlreadyCreated = 0;
        $nbCreationFailed = 0;

        // Each model of the array is going to be evaluated
        foreach ($params as $modelName => $model) {
            // We get the objects already vreated in the database
            $elemAlreadyCreated = $this->entityManager->getRepository($modelName)->findAll();
            foreach ($model['values'] as $value) {
                // If an object already exists in the database, we don't create it
                if (empty(array_filter($elemAlreadyCreated, function ($elem) use (&$value, &$model) {
                    return empty(array_filter($model['attrs'], function ($attr, $name) use (&$value, $elem) {
                        // The presence of the get tell us the attribute is unique
                        return array_key_exists('get', $attr) && $elem->{$attr['get']}() === $value[$name];
                    }, ARRAY_FILTER_USE_BOTH));
                }))) {
                    $obj = new $modelName();
                    $creating = true;
                    foreach ($value as $name => $val) {
                        if (array_key_exists('set', $model['attrs'][$name])) {
                            // We set all the attributes that have a setter in the array
                            $obj->{$model['attrs'][$name]['set']}($val);
                        }
                    }
                    if ($creating) {
                        $this->entityManager->persist($obj);
                        $nbCreated++;
                    } else {
                        $nbCreationFailed++;
                    }
                } else {
                    $nbAlreadyCreated++;
                }
            }
        }

        $this->entityManager->flush();

        $output->writeln(sprintf(
            "%d éléments ont été créés\n%d éléments étaient déjà créés\n%d élément n'ont pas put être créés",
            $nbCreated,
            $nbAlreadyCreated,
            $nbCreationFailed
        ));
        return Command::SUCCESS;
    }
}
