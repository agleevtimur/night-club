<?php

namespace App\EventSubscriber;

use App\Controller\TokenAuthenticatedController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class TokenSubscriber implements EventSubscriberInterface
{
    private array $tokens;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->tokens = $parameterBag->get('tokens');
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof TokenAuthenticatedController) {
            $token = $event->getRequest()->query->get('token');
            if (!in_array($token, $this->tokens)) {
                $token = $this->decryptToken($token);
                if (!in_array($token, $this->tokens)) {
                    throw new AccessDeniedHttpException('This action needs a valid token!');
                }
            }
        }
    }


    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    // простой пример "раскодирования" токена (фронт отправляет "закодированный" токен)
    private function decryptToken(string $token): string
    {
        return substr($token, strlen($token) / 2);
    }
}