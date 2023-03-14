<?php

use App\Kernel;

require_once dirname(__DIR__).'/aston-projet-2/symfony/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
