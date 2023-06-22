<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Users;
use App\Entity\Tricks;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TricksFixtures extends Fixture implements DependentFixtureInterface
{

    private $slugger;
    public function __construct(SluggerInterface $slugger)
    {
      $this->slugger = $slugger;
    }    

    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');
        
        
        for($tri = 1; $tri <= 10; $tri++ ){
            $trick = new Tricks();
            $trick->setName($faker->text(10));
            $trick->setDescription($faker->text());
            $trick->setSlug($this->slugger->slug($trick->getName())->lower());
            $trick->setUser($this->getReference('admin'));            

            //chercher une référence de catégorie
            $category = $this->getReference('cat-' . rand(1, 3)); 
            $trick->setCategory($category); 
            
            $this->setReference('tri-'.$tri, $trick);
            $manager->persist($trick);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UsersFixtures::class
        ];
    }
       
    
}
