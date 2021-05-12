<?php declare(strict_types=1);

namespace Prokl\CustomRequestResponserBundle;

use Prokl\CustomRequestResponserBundle\DependencyInjection\CustomRequestResponserExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class CustomRequestResponserBundle
 * @package Prokl\CustomRequestResponserBundle
 *
 * @since 04.12.2020
 */
class CustomRequestResponserBundle extends Bundle
{
    /**
     * @return CustomRequestResponserExtension
     */
    public function getContainerExtension(): CustomRequestResponserExtension
    {
        return new CustomRequestResponserExtension;
    }
}
