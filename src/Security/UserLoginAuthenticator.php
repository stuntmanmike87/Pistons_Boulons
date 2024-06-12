<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\Collaborateur;
use App\Entity\User;
use App\Repository\CollaborateurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

final class UserLoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const string LOGIN_ROUTE = 'app_login';

    // private readonly UserRepository $userRepository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly CsrfTokenManagerInterface $csrfTokenManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly CollaborateurRepository $repositoryCollabo,
        private readonly UserRepository $userRepository
    ) {
        // $this->userRepository = $userRepository;
    }

    #[\Override]
    public function supports(Request $request): bool
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
        // return ($request->getPathInfo() === '/login' && $request->isMethod('POST'));
    }

    #[\Override]
    public function authenticate(Request $request): Passport // PassportInterface
    {
        $login = $request->request->get('login');
        $password = $request->request->get('password');

        return new Passport(
            new UserBadge((string) $login, function ($userIdentifier) {
                // optionally pass a callback to load the User manually
                $user = $this->userRepository->findOneBy(['login' => $userIdentifier]);
                if (null == $user) {
                    throw new UserNotFoundException();
                    // throw new CustomUserMessageAuthenticationException("Erreur d'authentification");
                }

                return $user;
            }),
            new CustomCredentials(static fn ($credentials, User $user) => 'tada' === $credentials, $password)
        );
    }

    public function getCredentials(Request $request): mixed
    {
        $credentials = [
            'login' => $request->request->get('login'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            SecurityRequestAttributes::LAST_USERNAME,
            $credentials['login']
        );

        return $credentials;
    }

    /**
     * @param array<string> $credentials
     * @param UserProviderInterface<User> $userProvider
     */
    public function getUser(array $credentials, UserProviderInterface $userProvider): User
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);

        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        // /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['login' => (string) $credentials['login']]);

        if (!$user instanceof User) {
            throw new UserNotFoundException("L'identifiant n'a pas été trouvé.");
        }

        return $user;
    }

    /**
     * @param array<string> $credentials
     */
    public function checkCredentials(array $credentials, PasswordAuthenticatedUserInterface $user): bool
    {
        // ** @var PasswordAuthenticatedUserInterface $user */
        return $this->passwordHasher->isPasswordValid($user, $credentials['password']);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     *
     * @param array<string> $credentials
     */
    public function getPassword(array $credentials): ?string
    {
        return $credentials['password'];
    }

    #[\Override]
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName/* , $providerKey */): ?Response
    {
        $targetPath = $this->getTargetPath($request->getSession(), $firewallName/* $providerKey */);
        if (null !== $targetPath) {
            return new RedirectResponse($targetPath);
        }

        $user = $token->getUser();
        // on géneère la date du jour en mode date time pour modifier le champ derniere connexion du collabo
        $today = new \DateTime('now');
        // On pointe sur l'id de l'utilisateur
        // on récupère le collaborateur en fonction de son id d'utilisateur
        $collab = $this->repositoryCollabo->findOneBy([
            'user' => $user,
        ]);

        if ($collab instanceof Collaborateur) {
            // on met a jour le chp derniereConnexion  de collabo
            $collab->setDateHeureDerniereConnexion($today);
            $this->entityManager->persist($collab);
            $this->entityManager->flush();
        }

        // For example : return new RedirectResponse($this->urlGenerator->generate('some_route'));
        return new RedirectResponse($this->urlGenerator->generate('agendaMensuel'));
    }

    #[\Override]
    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
