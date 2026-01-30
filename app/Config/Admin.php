<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Admin authentication settings.
 */
class Admin extends BaseConfig
{
    /**
     * Default admin username used when ADMIN_USERNAME is not set.
     *
     * @var string
     */
    public string $defaultUsername = "admin";

    /**
     * Default admin password hash used when ADMIN_PASSWORD is not set.
     *
     * @var string
     */
    public string $defaultPasswordHash = "$2y$10$4YFHsLEfkQXT.WsdzlmfK.JHg0HWCfrwDqhXGphjNmSoN34YbjLIO";

    /**
     * Get the configured admin username.
     *
     * @return string
     */
    public function getUsername(): string
    {
        $envValue = env("ADMIN_USERNAME");
        if (($envValue === false || $envValue === null || $envValue === "") && isset($_ENV["ADMIN_USERNAME"])) {
            $envValue = $_ENV["ADMIN_USERNAME"];
        }
        if (($envValue === false || $envValue === null || $envValue === "") && isset($_SERVER["ADMIN_USERNAME"])) {
            $envValue = $_SERVER["ADMIN_USERNAME"];
        }
        if ($envValue !== false && $envValue !== "") {
            return trim((string) $envValue);
        }

        return $this->defaultUsername;
    }

    /**
     * Verify the given password against the configured credential.
     *
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        $envPassword = env("ADMIN_PASSWORD");
        if (($envPassword === false || $envPassword === null || $envPassword === "") && isset($_ENV["ADMIN_PASSWORD"])) {
            $envPassword = $_ENV["ADMIN_PASSWORD"];
        }
        if (($envPassword === false || $envPassword === null || $envPassword === "") && isset($_SERVER["ADMIN_PASSWORD"])) {
            $envPassword = $_SERVER["ADMIN_PASSWORD"];
        }

        if ($envPassword !== false && $envPassword !== "" && $envPassword !== null) {
            $normalized = trim((string) $envPassword);
            if (
                (str_starts_with($normalized, "\"") && str_ends_with($normalized, "\"")) ||
                (str_starts_with($normalized, "'") && str_ends_with($normalized, "'"))
            ) {
                $normalized = substr($normalized, 1, -1);
                $normalized = trim($normalized);
            }
            if ($normalized === "") {
                return false;
            }
            if (preg_match('/^\$2[aby]\$/', $normalized) === 1) {
                return password_verify($password, $normalized);
            }

            return hash_equals($normalized, $password);
        }

        return password_verify($password, $this->defaultPasswordHash);
    }
}
