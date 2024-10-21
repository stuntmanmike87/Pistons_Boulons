<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'asset_mapper' => [
            'paths' => [
                'assets/',
            ],
            'excluded_patterns' => [
                '*/assets/styles/_*.scss',
                '*/assets/styles/**/_*.scss',
            ],
        ],
    ]);
};
