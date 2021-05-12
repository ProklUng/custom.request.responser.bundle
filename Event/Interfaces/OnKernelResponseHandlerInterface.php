<?php

namespace Prokl\CustomRequestResponserBundle\Event\Interfaces;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

/**
 * Interface OnKernelResponseHandlerInterface
 * @package Prokl\CustomRequestResponserBundle\Event\Interfaces
 *
 * @since 20.10.2020
 */
interface OnKernelResponseHandlerInterface
{
    /**
     * Обработчик события kernel.request.
     *
     * @param ResponseEvent $event Объект события.
     *
     * @return void
     */
    public function handle(ResponseEvent $event): void;
}
