<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use App\Entity\Categories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


class CategoriesFormType extends AbstractType
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
                   new NotBlank(['message' => 'Le nom du catégorie ne peut pas être vide']),
                   new Assert\Callback([$this, 'validateUniqueName']),
                ],
            ]);                    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
            'constraints' => [
                new Assert\Callback([$this, 'validateUniqueName']),
            ],
        ]);
    }
    public function validateUniqueName($value, ExecutionContextInterface $context): void
    {
        // Vérifier si le nom est unique dans la base de données
        $existingTrick = $this->entityManager->getRepository(Categories::class)->findOneBy(['name' => $value]);

        if ($existingTrick) {
            $context->buildViolation('Ce nom de catégorie est déjà utilisé.')->addViolation();
        }
    }
}
