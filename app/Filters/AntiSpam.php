<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class AntiSpam implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        $userAgent = strtolower($request->getUserAgent()->getAgentString());

        $referer   = $request->getHeaderLine('Referer');

        $ipAddress = $request->getIPAddress();

        if (! $this->isValidUserAgent($userAgent)) {
            return $this->deny('Acesso não permitido. User-Agent inválido.');
        }

        $expectedBase = site_url('forms/reply');
        if (! $this->isValidReferer($referer, $expectedBase)) {
            return $this->deny('Acesso negado. Referer inválido.');
        }

        $form_hash = $request->getUri()->getSegments()[2] ?? null;

        $throttle    = Services::throttler();
        
        $histPerDay  = 5;
        $throttleKey = "reply_{$form_hash}_" . md5($ipAddress);

        if ($throttle->check($throttleKey, $histPerDay, 86400) === false) {
            return $this->deny('Limite diário de respostas atingido. Tente novamente em outro momento.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nada a fazer aqui
    }

    private function isValidUserAgent(string $agent): bool
    {
        return preg_match('/(mozilla|chrome|safari|firefox|edge|android|iphone|ipad|mobile)/i', $agent);
    }

    private function isValidReferer(string $referer, string $expectedBase): bool
    {
        if (empty($referer)) return false;

        // Permite tanto localhost quanto produção
        return preg_match('#^' . preg_quote($expectedBase, '#') . '(/[\w\d]+)?#', $referer);
    }

    private function deny(string $message)
    {
        return service('response')
            ->setStatusCode(429)
            ->setJSON([
                'success' => false,
                'message' => $message,
            ]);
    }
}
