<?php 

namespace App\Entity\MyTrait;


use Doctrine\ORM\Mapping as ORM;

trait SlugTrait
{  
     /**
     * @ORM\Column(type="string", length=255)
     */     
     private $slug;

     public function getSlug(): ?string
     {
         return $this->slug;
     }
 
     public function setSlug(string $slug): self
     {
         $this->slug = $slug;
 
         return $this;
     }
}