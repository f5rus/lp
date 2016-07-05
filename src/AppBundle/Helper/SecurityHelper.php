<?php

namespace AppBundle\Helper;

use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Security;

/**
 * Class SecurityHelper
 * @package AppBundle\Helper
 */
class SecurityHelper
{
    /**
     * @var AuthenticationProviderManager
     */
    private $providerManager;
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var string
     */
    private $providerKey;

    /**
     * @param AuthenticationProviderManager $providerManager
     * @param Logger $logger
     * @param TokenStorage $tokenStorage
     * @param string $providerKey
     */
    public function __construct(AuthenticationProviderManager $providerManager, Logger $logger, TokenStorage $tokenStorage, $providerKey)
    {
        $this->providerManager = $providerManager;
        $this->logger = $logger;
        $this->tokenStorage = $tokenStorage;
        $this->providerKey = $providerKey;
    }

    /**
     * @param $username
     * @param $password
     * @return null|\Symfony\Component\Security\Core\Authentication\Token\TokenInterface
     * @throws \Exception
     */
    public function authenticate($username, $password)
    {
        $username = trim($username);

        if (strlen($username) > Security::MAX_USERNAME_LENGTH) {
            throw new BadCredentialsException('Invalid username.');
        }

        $returnValue = $this->providerManager->authenticate(new UsernamePasswordToken($username, $password, $this->providerKey));

        if ($returnValue instanceof TokenInterface) {
            $this->onSuccess($returnValue);
        } else {
            throw new \RuntimeException('authenticate() must either return an implementation of TokenInterface, or null.');
        }

        return true;
    }

    private function onSuccess(TokenInterface $token)
    {
        if (null !== $this->logger) {
            $this->logger->info('User has been authenticated successfully.', array('username' => $token->getUsername()));
        }

        $this->tokenStorage->setToken($token);
    }
}