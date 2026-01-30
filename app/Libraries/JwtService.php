<?php

namespace App\Libraries;

use Config\JWT as JwtConfig;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use InvalidArgumentException;
use Throwable;

/**
 * Service for issuing and validating JWTs.
 */
class JwtService
{
    /**
     * @var JwtConfig
     */
    private JwtConfig $config;

    /**
     * @param JwtConfig|null $config
     */
    public function __construct(?JwtConfig $config = null)
    {
        // Allow config injection for testing while keeping a safe default.
        $this->config = $config ?? config("JWT");
    }

    /**
     * Determine if a usable secret is configured.
     *
     * @return bool
     */
    public function isSecretConfigured(): bool
    {
        $secret = $this->config->getSecret();
        if ($secret === "" || $secret === "CHANGE_ME") {
            return false;
        }

        return true;
    }

    /**
     * Generate an admin JWT for the given username.
     *
     * @param string $username
     * @return string
     */
    public function generateAdminToken(string $username): string
    {
        $normalized = trim($username);
        if ($normalized === "") {
            throw new InvalidArgumentException("Username is required to issue a token.");
        }

        if (!$this->isSecretConfigured()) {
            throw new InvalidArgumentException("JWT secret is not configured.");
        }

        $now = time();
        $payload = [
            "iss" => $this->config->getIssuer(),
            "aud" => $this->config->getAudience(),
            "iat" => $now,
            "nbf" => $now,
            "exp" => $now + $this->config->getTtlSeconds(),
            "sub" => $normalized,
            "role" => "admin",
        ];

        return JWT::encode($payload, $this->config->getSecret(), $this->config->getAlgorithm());
    }

    /**
     * Decode and validate a JWT token.
     *
     * @param string $token
     * @return array<string, mixed>|null
     */
    public function decodeToken(string $token): ?array
    {
        $normalized = trim($token);
        if ($normalized === "" || !$this->isSecretConfigured()) {
            return null;
        }

        // Apply leeway to tolerate minor clock skew.
        JWT::$leeway = $this->config->getLeewaySeconds();

        try {
            $decoded = JWT::decode(
                $normalized,
                new Key($this->config->getSecret(), $this->config->getAlgorithm())
            );
        } catch (Throwable $exception) {
            // Any decode failure should be treated as invalid.
            return null;
        }

        $claims = (array) $decoded;
        if (!$this->validateClaims($claims)) {
            return null;
        }

        return $claims;
    }

    /**
     * Validate issuer and audience claims.
     *
     * @param array<string, mixed> $claims
     * @return bool
     */
    private function validateClaims(array $claims): bool
    {
        $issuer = $claims["iss"] ?? null;
        if (!is_string($issuer) || $issuer !== $this->config->getIssuer()) {
            return false;
        }

        $audience = $claims["aud"] ?? null;
        if (is_string($audience)) {
            return $audience === $this->config->getAudience();
        }

        if (is_array($audience)) {
            return in_array($this->config->getAudience(), $audience, true);
        }

        return false;
    }
}
