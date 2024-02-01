<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Form\Type;

use Nextstore\SyliusInventoryPlugin\Model\InventoryMovement;
use Nextstore\SyliusInventoryPlugin\Model\Warehouse;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class InventoryMovementType extends AbstractResourceType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'sylius.ui.type',
                'choices' => [
                    'Income' => InventoryMovement::INCOME,
                    'Outcome' => InventoryMovement::OUTCOME
                ],
                'constraints' => [
                    new NotBlank(null, 'Type cannot be empty')
                ]
            ])
            ->add('assignDate', DateType::class, [
                'label' => 'nextstore_sylius_inventory.ui.assign_date',
                'widget' => 'single_text',
            ])
            ->add('warehouse', EntityType::class, [
                'class' => Warehouse::class,
                'required' => true
            ])
            ->add('notes', TextType::class, [
                'label' => 'sylius.ui.notes',
            ])
            // ->add('products', CollectionType::class, [
            //     'label' => 'nextstore_sylius_inventory.ui.inventory_products',
            //     'entry_type' => InventoryMovementProductType::class,
            //     'attr' => [
            //         'class' => 'ui segment'
            //     ],
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'by_reference' => false,
            // ])
        ;
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix(): string
    {
        return 'nextstore_sylius_inventory_inventory_movement';
    }
}
