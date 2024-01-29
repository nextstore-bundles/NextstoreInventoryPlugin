<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class NextstoreSyliusInventoryPlugin extends AbstractResourceBundle
{
    use SyliusPluginTrait;

    /**
     * @inheritdoc
     */
    public function getSupportedDrivers(): array
    {
        return [
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
    }
    // public function getPath(): string
    // {
    //     return \dirname(__DIR__);
    // }
}
