<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    private $passwordEncoder;
    private $slugger;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, SluggerInterface $slugger)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager): void
    {      
        $admin = new Users();
        $admin->setEmail('admin@gmail.com');
        $admin->setLastname('kaa');
        $admin->setFirstname('zayn');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        $this->addReference('admin', $admin);
        $manager->persist($admin);

        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <= 5; $usr++ ){
            $user = new Users();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
        );

            $manager->persist($user);
        }
        $manager->flush();
    }
}
