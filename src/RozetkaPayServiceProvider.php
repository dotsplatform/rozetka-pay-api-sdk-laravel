<?php
/**
 * Description of RozetkaPayServiceProvider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay;

use Illuminate\Support\ServiceProvider;

class RozetkaPayServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rozetka-pay.php',
            'rozetka-pay'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/rozetka-pay.php' => config_path('rozetka-pay.php'),
        ], 'config');
    }
}
