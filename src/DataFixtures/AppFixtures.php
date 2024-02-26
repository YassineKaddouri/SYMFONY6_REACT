<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Invoice;
use App\Entity\Customer;

class AppFixtures extends Fixture
{



    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $chrono=1;

        for ($c = 0; $c < mt_rand(5, 20); $c++) {
            $customer = new Customer();
            $customer->setFirstName($faker->firstName())
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setCompany($faker->company);

            $manager->persist($customer);

            for ($i = 0; $i < mt_rand(3, 10); $i++) {
                $invoice = new Invoice();
                $invoice->setAmount($faker->randomFloat(2, 2, 5000))
                    ->setSentAt($faker->dateTimeBetween('-6 months'))

                    ->setStatus($faker->randomElement(['SENT', 'PAID', 'CANCELLED']))
                    ->setCustomer($customer)
                    ->setChrono($chrono);

                    $chrono++;

                $manager->persist($invoice);
            }
        }

        $manager->flush();
    }





}
