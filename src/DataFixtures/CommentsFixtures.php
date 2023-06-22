<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Users;
use App\Entity\Comments;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($com = 1; $com <= 30; $com++){
            $comment = new Comments();
            $comment->setContent($faker->sentence(mt_rand(1, 5)));
            $trick = $this->getReference('tri-' .rand(1, 10));
            $comment->setTrick($trick);
            $comment->setUser($this->getReference('admin'));
            $manager->persist($comment);

        }        

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            TricksFixtures::class
        ];
    }
}
