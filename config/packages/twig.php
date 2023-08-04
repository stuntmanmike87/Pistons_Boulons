<?php

declare(strict_types=1);

use App\Service\AgendaService;
use App\Service\FooterService;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('twig', [
        'default_path' => '%kernel.project_dir%/templates',
        'globals' => [
            'appConfig' => service(FooterService::class),
            'agenda' => service(AgendaService::class),
        ],
    ]);
};
