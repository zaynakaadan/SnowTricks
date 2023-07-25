<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Tricks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class TricksFormType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', null, [
            'label' => 'Nom',
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le nom du trick ne peut pas être vide']),
                new Assert\Callback([$this, 'validateUniqueName']),
            ],

        ])
        ->add('description')
        ->add('category', EntityType::class, [ 
            'class' => Categories::class,
             'choice_label' => 'name',
             'label' => 'Catégorie', 
 
            ])
        ->add('images', FileType::class, [
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new All(
                    new Image([
                    'maxWidth' => 1280,
                    'maxWidthMessage'  => 'L\'image doit faire {{ max_width }} pixels de large au maximum'
                    ])
                )
            ]
        ]);            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
            'constraints' => [
                new Assert\Callback([$this, 'validateUniqueName']),
            ],
        ]);
    }
    public function validateUniqueName($value, ExecutionContextInterface $context): void
    {
        // Vérifier si le nom est unique dans la base de données
        $existingTrick = $this->entityManager->getRepository(Tricks::class)->findOneBy(['name' => $value]);

        if ($existingTrick) {
            $context->buildViolation('Ce nom de trick est déjà utilisé.')->addViolation();
        }
    }
}
