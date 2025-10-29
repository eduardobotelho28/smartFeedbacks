<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
use Exception;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return Services::response()
                ->setJSON(['error' => 'Token não fornecido'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $token = substr($authHeader, 7); // remove "Bearer "
        $key = getenv('JWT_SECRET') ;
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            // Adiciona dados decodificados na requisição para uso no controller
            $request->decodedToken = (array) $decoded;
        } catch (Exception $e) {
            return Services::response()
                ->setJSON(['error' => 'Token inválido ou expirado', 'details' => $e->getMessage()])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nada a fazer aqui
    }
}
