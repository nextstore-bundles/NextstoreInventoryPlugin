<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Form\Type;

use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class InventoryMovementProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', InventoryProductAutocompleteChoiceType::class, [
                'label' => 'sylius.form.promotion_filter.products',
                'warehouse' => $options['warehouse'],
                'choice_name' => 'productCode',
                'choice_value' => 'id',
                'multiple' => false,
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'sylius.ui.quantity',
                'constraints' => [
                    new NotBlank(null, 'Quantity cannot be empty'),
                    new Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Quantity must contain only numbers',
                    ]),
                ]
            ])
            ->add('notes', TextType::class, [
                'label' => 'sylius.ui.notes',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InventoryMovementProduct::class,
        ])->setRequired('warehouse');
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix(): string
    {
        return 'nextstore_sylius_inventory_inventory_movement_product';
    }

}
