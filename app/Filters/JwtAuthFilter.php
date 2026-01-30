<?php

namespace App\Filters;

use App\Libraries\JwtService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filter that enforces JWT authentication for protected routes.
 */
class JwtAuthFilter implements FilterInterface
{
    /**
     * @param RequestInterface $request
     * @param array|string|null $arguments
     * @return ResponseInterface|null
     */
    public function before(RequestInterface $request, $arguments = null): ?ResponseInterface
    {
        $jwtConfig = config("JWT");
        $jwtService = new JwtService($jwtConfig);

        // Extract token from Authorization header or cookie.
        $token = $this->extractToken($request, $jwtConfig->getCookieName());
        if ($token === null) {
            return redirect()->to(site_url("admin"));
        }

        $claims = $jwtService->decodeToken($token); 
        if ($claims === null) {
            $response = redirect()->to(site_url("/"));
            $response->deleteCookie($jwtConfig->getCookieName());
            return $response;
        }

        return null;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|string|null $arguments
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
        // No post-response handling needed for JWT authentication.
    }

    /**
     * Extract a bearer token from the Authorization header or cookie.
     *
     * @param RequestInterface $request
     * @param string $cookieName
     * @return string|null
     */
    private function extractToken(RequestInterface $request, string $cookieName): ?string
    {
        $authHeader = $request->getHeaderLine("Authorization");
        if ($authHeader !== "") {
            $matches = [];
            if (preg_match("/^Bearer\\s+(.+)$/i", $authHeader, $matches) === 1) {
                $token = trim($matches[1]);
                if ($token !== "") {
                    return $token;
                }
            }
        }

        $cookie = $request->getCookie($cookieName);
        if (is_string($cookie) && $cookie !== "") {
            return $cookie;
        }

        return null;
    }
}
