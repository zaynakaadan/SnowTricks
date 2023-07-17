<?php

namespace App\Entity;

use App\Entity\MyTrait\CreatedAtTrait;
use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
{
    use CreatedAtTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    
    /**
     * @ORM\ManyToOne(targetEntity=Tricks::class, inversedBy="comments")
     */
    private $trick;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {        
        $this->created_at = new \DateTimeImmutable();
        
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    

    public function getTrick(): ?Tricks
    {
        return $this->trick;
    }

    public function setTrick(?Tricks $trick): self
    {
        $this->trick = $trick;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        // Convert the DateTime object to DateTimeImmutable if it exists
        return $this->created_at instanceof \DateTimeInterface ? \DateTimeImmutable::createFromMutable($this->created_at) : null;
    }
}
