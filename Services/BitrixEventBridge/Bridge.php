<?php

namespace Prokl\CustomRequestResponserBundle\Services\BitrixEventBridge;

use Bitrix\Main\Context;
use Prokl\CustomRequestResponserBundle\Event\Listeners\PageSpeedMiddlewares;

/**
 * Class Bridge
 * Способ запускать PageSpeed middlewares на нативных маршрутах.
 * @package Prokl\CustomRequestResponserBundle\Services\BitrixEventBridge
 *
 * @since 21.02.2021
 * @since 28.02.2021 В админке middleware не действуют во избежании побочных эффектов.
 */
class Bridge extends PageSpeedMiddlewares
{
    /**
     * Обработчик события OnEndBufferContent.
     *
     * @param string $content Контент.
     *
     * @return void
     */
    public function handleEvent(string &$content) : void
    {
        /** @psalm-suppress UndefinedClass */
        $request = Context::getCurrent()->getRequest();
        if ($request->isAdminSection()) {
            return;
        }

        foreach ($this->middlewaresBag as $middleware) {
            $content = $middleware->apply($content);
        }
    }
}