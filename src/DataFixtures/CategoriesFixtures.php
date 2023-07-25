<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter = 1;
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
      $this->slugger = $slugger;
    }            
   
    public function load(ObjectManager $manager): void
    {       
        $this->createCategory('Big air', $manager);
        $this->createCategory('Hip', $manager);
        $this->createCategory('Step-up', $manager);
        $this->createCategory('Half-pipe', $manager);
        $manager->flush();
    }

    public function createCategory(string $name, ObjectManager $manager)
    {
        $category = new Categories();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        
        $manager->persist($category);

        //stokée les références
        $this->addReference('cat-'.$this->counter, $category);        
        $this->counter++;
        
        return $category;
    }
}
