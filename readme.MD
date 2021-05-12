# Инструментарий для работы с request-response в кастомных вариантах Symfony

***INTERNAL***

## Установка

composer.json:

```json
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/proklung/custom.request.responser.bundle"
        }
    ]
```

```bash
composer require proklung/custom-request-responser-bundle
```

## Пример конфигурации

По адресу `local/packages/custom_request_responser.yaml` (или `/config/packages/custom_request_responser.yaml` для Wordpress).

```yaml
custom_request_responser:
  defaults:
    enabled: true

  # True - middleware запрещено, false - нет.
  # По умолчанию false.
  middlewares_disabled:
    custom_request_responser.middleware.inline_css: true
    custom_request_responser.middleware.dns_prefetch: true
    custom_request_responser.middleware.remove_comments: true
    custom_request_responser.middleware.collapse_whitespace: true
    custom_request_responser.middleware.remove_quotes: true
    custom_request_responser.middleware.elide_attributes: true

  # Middleware, запускаемые на контент Битрикса.
  # True - middleware запрещено, false - нет.
  # По умолчанию false.
  bitrix_middlewares_disabled:
    custom_request_responser.middleware.inline_css: false
    custom_request_responser.middleware.dns_prefetch: false
    custom_request_responser.middleware.remove_comments: false
    custom_request_responser.middleware.collapse_whitespace: false
    custom_request_responser.middleware.remove_quotes: false
    custom_request_responser.middleware.elide_attributes: false

  headers:
    # Apply a CSP on all the responses
    - Content-Security-Policy: default-src 'self'

    - name: Cache-Control
      value: max-age=31536000, public
      condition: response.headers.get('Content-Type') matches '/^html/'
```

## Комплект

### Обработчики kernel.response

- `custom_request_responser.logger_response` - логгирование Request & Response
- `custom_request_responser.robots` - управление индексацией роута
- `custom_request_responser.compress_response` - минификация Response для типа txt/html
- `custom_request_responser.set.headers` 

### Response middlewares

- `custom_request_responser.middleware.dns_prefetch` - injects tags in the HEAD to enable the browser to do DNS prefetching
- `custom_request_responser.middleware.remove_comments` - eliminates HTML, JS and CSS comments
- `custom_request_responser.middleware.collapse_whitespace` - reduces bytes transmitted in an HTML file by removing unnecessary whitespace
- `custom_request_responser.middleware.remove_quotes` - eliminates unnecessary quotation marks from HTML attributes
- `custom_request_responser.middleware.elide_attributes` - removing attributes from tags when the specified value is equal to the default value
- `custom_request_responser.middleware.inline_css` - transforms the inline "style" attribute of tags into classes by moving the CSS to the header

Помечаются тэгом `response.middleware` и должны наследоваться от `AbstractPageSpeed`.

### Пример кастомного обработчика - нужно ли индексировать роут или нет

```php
use Prokl\CustomRequestResponserBundle\Services\Contracts\IndexRouteManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
```