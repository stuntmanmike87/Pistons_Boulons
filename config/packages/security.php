<?php

declare(strict_types=1);

use App\Entity\User;
use App\Security\UserLoginAuthenticator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'enable_authenticator_manager' => true, 
		'password_hashers' => [
			PasswordAuthenticatedUserInterface::class => 'auto', 
			User::class => [
				'algorithm' => 'sodium'
			]
		], 
        'providers' => [
            'app_user_provider' => [
                'entity' => [
                    'class' => User::class,
                    'property' => 'login',
                ],
            ],
        ],
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false,
            ],
            'main' => [
                'lazy' => true,
                'provider' => 'app_user_provider',
                'custom_authenticator' => UserLoginAuthenticator::class,
                'logout' => [
                    'path' => 'app_logout',
                    'target' => 'home',
                ],
                "pattern" => "^/",
            ],
        ],
        'access_control' => [
            [
                'path' => '^/client/',
                'roles' => 'ROLE_COLLABORATEUR',
            ],
            [
                'path' => '^/prestation/index',
                'roles' => 'ROLE_COLLABORATEUR',
            ],
            [
                'path' => '^/prestation/new',
                'roles' => 'ROLE_COLLABORATEUR',
            ],
            [
                'path' => '^/prestation/id',
                'roles' => 'ROLE_COLLABORATEUR',
            ],
            [
                'path' => '^/prestationid/edit',
                'roles' => 'ROLE_COLLABORATEUR',
            ],
            [
                'path' => '^/rendez/vous/',
                'roles' => 'ROLE_COLLABORATEUR',
            ],
            [
                'path' => '^/logout/',
                'roles' => 'ROLE_COLLABORATEUR',
            ],
            [
                'path' => '^/content/index',
                'roles' => 'ROLE_ADMIN',
            ],
            [
                'path' => '^/content/new',
                'roles' => 'ROLE_ADMIN',
            ],
            [
                'path' => '^/content/id',
                'roles' => 'ROLE_ADMIN',
            ],
            [
                'path' => '^/content/id/edit',
                'roles' => 'ROLE_ADMIN',
            ],
            [
                'path' => '^/collaborateur/',
                'roles' => 'ROLE_ADMIN',
            ],
            [
                'path' => '^/user/control/',
                'roles' => 'ROLE_ADMIN',
            ],
        ],
        'role_hierarchy' => [
            'ROLE_ADMIN' => 'ROLE_COLLABORATEUR',
        ],
    ]);

    if ($containerConfigurator->env() === "test") {
        $containerConfigurator->extension("security", [
            "password_hashers" => [
                PasswordAuthenticatedUserInterface::class => [
                    "algorithm" => "auto",
                    "cost" => 4,
                    "time_cost" => 3,
                    "memory_cost" => 10,
                ],
            ],
        ]);
    }
};
