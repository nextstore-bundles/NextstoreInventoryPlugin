<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Form\Type;

use Nextstore\SyliusInventoryPlugin\Model\InventoryMovement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddProductToMovementType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('products', CollectionType::class, [
                'label' => 'nextstore_sylius_inventory.ui.inventory_products',
                'entry_type' => InventoryMovementProductType::class,
                'entry_options' => [
                    'warehouse' => $options['warehouse']
                ],
                'attr' => [
                    'class' => 'ui segment'
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'ui primary button', 'style' => 'margin-top: 10px']
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InventoryMovement::class,
        ])->setRequired('warehouse');
    }
}
