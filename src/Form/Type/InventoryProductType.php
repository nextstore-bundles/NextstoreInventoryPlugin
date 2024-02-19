<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Form\Type;

use Nextstore\SyliusInventoryPlugin\Model\Warehouse;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAutocompleteChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class InventoryProductType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('stock', TextType::class, [
                'label' => 'nextstore_sylius_inventory.ui.stock',
                'constraints' => [
                    new NotBlank(null, 'stock cannot be empty')
                ]
            ])
            ->add('product', ProductAutocompleteChoiceType::class, [
                'label' => 'sylius.form.promotion_filter.products',
                'multiple' => false,
            ])
            ->add('warehouse', EntityType::class, [
                'class' => Warehouse::class,
                'required' => true,
                'constraints' => [
                    new NotNull(null, 'choose ware house')
                ]
            ]);
        $builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix(): string
    {
        return 'nextstore_sylius_inventory_inventory_product';
    }

    public function onPostSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $data = $form->getData();

        if ($data->getProduct() !== null) {
            $data->setProductCode($data->getProduct()->getCode());
        }
    }
}
