<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * JWT configuration for admin authentication.
 */
class JWT extends BaseConfig
{
    /**
     * @var string
     */
    public string $defaultIssuer = "portfolio-admin";

    /**
     * @var string
     */
    public string $defaultAudience = "portfolio-admin";

    /**
     * @var string
     */
    public string $defaultSecret = "CHANGE_ME";

    /**
     * @var string
     */
    public string $defaultAlgorithm = "HS256";

    /**
     * @var int
     */
    public int $defaultTtlMinutes = 25;

    /**
     * @var int
     */
    public int $defaultLeewaySeconds = 30;

    /**
     * @var string
     */
    public string $defaultCookieName = "admin_jwt";

    /**
     * Read a string value from the environment with fallback.
     *
     * @param string $key
     * @param string $fallback
     * @return string
     */
    private function readEnvString(string $key, string $fallback): string
    {
        // Normalize env values while preserving defaults.
        $value = env($key);
        if ($value === false || $value === null || $value === "") {
            return $fallback;
        }

        return trim((string) $value);
    }

    /**
     * Read an integer value from the environment with fallback.
     *
     * @param string $key
     * @param int $fallback
     * @return int
     */
    private function readEnvInt(string $key, int $fallback): int
    {
        // Ensure numeric config values are safe and positive.
        $value = env($key);
        if ($value === false || $value === null || $value === "") {
            return $fallback;
        }

        $normalized = trim((string) $value);
        if (!ctype_digit($normalized)) {
            return $fallback;
        }

        $parsed = (int) $normalized;
        return $parsed > 0 ? $parsed : $fallback;
    }

    /**
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->readEnvString("JWT_ISSUER", $this->defaultIssuer);
    }

    /**
     * @return string
     */
    public function getAudience(): string
    {
        return $this->readEnvString("JWT_AUDIENCE", $this->defaultAudience);
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->readEnvString("JWT_SECRET", $this->defaultSecret);
    }

    /**
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->readEnvString("JWT_ALGORITHM", $this->defaultAlgorithm);
    }

    /**
     * @return int
     */
    public function getTtlSeconds(): int
    {
        $minutes = $this->readEnvInt("JWT_TTL_MINUTES", $this->defaultTtlMinutes);
        return $minutes * 60;
    }

    /**
     * @return int
     */
    public function getLeewaySeconds(): int
    {
        return $this->readEnvInt("JWT_LEEWAY_SECONDS", $this->defaultLeewaySeconds);
    }

    /**
     * @return string
     */
    public function getCookieName(): string
    {
        return $this->readEnvString("JWT_COOKIE_NAME", $this->defaultCookieName);
    }
}
