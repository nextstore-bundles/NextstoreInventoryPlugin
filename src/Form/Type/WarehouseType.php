<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class WarehouseType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('code', TextType::class, [
                'label' => 'sylius.ui.code',
                'constraints' => [
                    new NotBlank(null, 'Code cannot be empty')
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
                'constraints' => [
                    new NotBlank(null, 'Name cannot be empty')
                ]
            ])
            ->add('location', TextType::class, [
                'label' => 'sylius.ui.address',
            ])
        ;
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix(): string
    {
        return 'nextstore_sylius_inventory_warehouse';
    }
}
