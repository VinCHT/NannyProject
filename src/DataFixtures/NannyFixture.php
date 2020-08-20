<?php

namespace App\DataFixtures;

use App\Entity\Nanny;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Faker\Factory;

class NannyFixture extends Fixture
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {

        $this->manager= $manager;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++) {
            $nanny = new Nanny();
            $nanny
                ->setTitle($faker->words(5, true))
                ->setDescription($faker->sentences(3, true))
                ->setExperience($faker->numberBetween(0, 30))
                ->setPrice($faker->numberBetween(10, 20))
                ->setStatut($faker->numberBetween(0, count(Nanny::STATUT) - 1))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setOccuppe(false);
            $manager->persist($nanny);
        }
            $manager->flush();
    }
}
