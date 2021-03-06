<?php

namespace Prokl\CustomRequestResponserBundle\Services\IndexRoutesManager;

use Prokl\CustomRequestResponserBundle\Services\Contracts\IndexRouteManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminRouteProcessor
 * @package Prokl\CustomRequestResponserBundle\Services\IndexRoutesManager
 *
 * Пример кастомного обработчика - нужно ли индексировать роут или нет.
 *
 * @since 18.02.2021
 */
class AdminRouteProcessor implements IndexRouteManagerInterface
{
    /**
     * @inheritDoc
     */
    public function shouldIndex(Request $request): bool
    {
        $url = $request->getPathInfo();

        // Не индексировать страницы, в url которых встречается /api/.
        if (stripos($url, '/api/') !== false) {
            return false;
        }

        return true;
    }
}
