<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Images;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{ 
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($img = 1; $img <= 100; $img++){
            $image = new Images();
            $image->setname($faker->image(null, 640, 480));
            $trick = $this->getReference('tri-' .rand(1, 10));
            $image->setTrick($trick);
            $manager->persist($image);

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
