<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'password_hashers' => [
            PasswordAuthenticatedUserInterface::class => 'auto',
        ],
        'providers' => [
            'users_in_memory' => [
                'memory' => null,
            ],
        ],
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false,
            ],
            'main' => [
                'lazy' => true,
                'provider' => 'users_in_memory',
            ],
        ],
        //'access_control' => null,
        //'access_control' => [
            //[
                //'path' => '^/admin',
                //'roles' => 'ROLE_ADMIN'
            //],
            //[
                //'path' => '^/profile',
                //'roles' => 'ROLE_USER'
            //],
        //],
        //'access_control' => [
            //[
                //'path' => '^/...',
                //'roles' => 'ROLE_USER'
            //],
            //[
                //'path' => '^/user/id',
                //'roles' => 'ROLE_USER'
            //],
            //[
                //'path' => '^/user/id/edit',
                //'roles' => 'ROLE_USER'
            //]
            //[
                //'path' => '^/...',
                //'roles' => 'ROLE_COLLABORATEUR'
            //]
        //],
    ]);
    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('security', [
            'password_hashers' => [
                PasswordAuthenticatedUserInterface::class => [
                    'algorithm' => 'auto',
                    'cost' => 4,
                    'time_cost' => 3,
                    'memory_cost' => 10,
                ],
            ],
        ]);
    }
};
