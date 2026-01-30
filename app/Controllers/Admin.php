<?php

namespace App\Controllers;

use App\Libraries\JwtService;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Admin as AdminConfig;
use Config\Database;
use Config\JWT as JwtConfig;

/**
 * Admin controller for basic CRUD management.
 */
class Admin extends BaseController
{
    /**
     * @var string[]
     */
    private array $allowedTables = [
        "profiles",
        "profile_tags",
        "social_links",
        "skill_groups",
        "skills",
        "projects",
        "project_tags",
        "project_highlights",
        "project_links",
        "project_docs",
        "education",
        "site_settings",
        "contact_messages",
    ];

    /**
     * Render login and handle authentication.
     *
     * @return string|RedirectResponse
     */
    public function login()
    {
        /** @var JwtConfig $jwtConfig */
        $jwtConfig = config("JWT");
        $jwtService = new JwtService($jwtConfig);
        // Short-circuit when a valid token already exists.
        $existingToken = $this->request->getCookie($jwtConfig->getCookieName());
        if (is_string($existingToken) && $jwtService->decodeToken($existingToken) !== null) {
            return redirect()->to(site_url("admin/dashboard"));
        }

        if ($this->request->getMethod(true) === "POST") {
            $username = trim((string) $this->request->getPost("username"));
            $password = trim((string) $this->request->getPost("password"));

            /** @var AdminConfig $adminConfig */
            $adminConfig = config("Admin");
            $isValidUser = hash_equals($adminConfig->getUsername(), $username);
            $isValidPass = $adminConfig->verifyPassword($password);

            if ($isValidUser && $isValidPass) {
                // Issue a short-lived JWT when credentials are valid.
                try {
                    $token = $jwtService->generateAdminToken($username);
                } catch (\Throwable $exception) {
                    log_message("error", "JWT generation failed: {message}", ["message" => $exception->getMessage()]);
                    session()->setFlashdata("admin_error", "Unable to sign you in. Please try again.");
                    return redirect()->to(site_url("/?admin_error=1#admin-login"));
                }

                $response = redirect()->to(site_url("admin/dashboard"));
                // Store the token in an HTTP-only cookie for browser auth.
                $response->setCookie(
                    $jwtConfig->getCookieName(),
                    $token,
                    $jwtConfig->getTtlSeconds(),
                    "",
                    "/",
                    "",
                    $this->request->isSecure(),
                    true,
                    "Lax"
                );
                return $response;
            }

            session()->setFlashdata("admin_error", "Invalid credentials.");
            return redirect()->to(site_url("/?admin_error=1#admin-login"));
        }

        return redirect()->to(site_url("/#admin-login"));
    }

    /**
     * Logout the admin user.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        /** @var JwtConfig $jwtConfig */
        $jwtConfig = config("JWT");
        $response = redirect()->to(site_url("/"));
        // Explicitly remove the JWT cookie on logout.
        $response->deleteCookie($jwtConfig->getCookieName());
        return $response;
    }

    /**
     * Render the dashboard with table links.
     *
     * @return string|RedirectResponse
     */
    public function dashboard()
    {
        $guard = $this->requireLogin();
        if ($guard instanceof RedirectResponse) {
            return $guard;
        }

        $tableGroups = [
            "Profile" => ["profiles", "profile_tags", "social_links"],
            "Skills" => ["skill_groups", "skills"],
            "Projects" => ["projects", "project_tags", "project_highlights", "project_links", "project_docs"],
            "Education" => ["education"],
            "Settings" => ["site_settings"],
            "Messages" => ["contact_messages"],
        ];

        return view("admin/dashboard", [
            "pageTitle" => "Admin Dashboard",
            "tableGroups" => $tableGroups,
        ]);
    }

    /**
     * Render a table management view.
     *
     * @param string $table
     * @return string|RedirectResponse
     */
    public function table(string $table)
    {
        $guard = $this->requireLogin();
        if ($guard instanceof RedirectResponse) {
            return $guard;
        }

        if (!$this->isAllowedTable($table)) {
            return $this->response->setStatusCode(404, "Table not found.");
        }

        $db = Database::connect();
        $fields = $db->getFieldNames($table);
        $rows = $db->table($table)->orderBy("id", "ASC")->get()->getResultArray();

        return view("admin/table", [
            "pageTitle" => "Manage " . $table,
            "table" => $table,
            "fields" => $fields,
            "rows" => $rows,
        ]);
    }

    /**
     * Create a new row in a table.
     *
     * @param string $table
     * @return RedirectResponse
     */
    public function create(string $table): RedirectResponse
    {
        $guard = $this->requireLogin();
        if ($guard instanceof RedirectResponse) {
            return $guard;
        }

        if (!$this->isAllowedTable($table)) {
            return redirect()->to(site_url("admin/dashboard"));
        }

        $db = Database::connect();
        $fields = $db->getFieldNames($table);
        $data = $this->collectRowData($fields);
        if (!empty($data)) {
            $db->table($table)->insert($data);
        }

        return redirect()->to(site_url("admin/table/" . $table));
    }

    /**
     * Update a row in a table.
     *
     * @param string $table
     * @return RedirectResponse
     */
    public function update(string $table): RedirectResponse
    {
        $guard = $this->requireLogin();
        if ($guard instanceof RedirectResponse) {
            return $guard;
        }

        if (!$this->isAllowedTable($table)) {
            return redirect()->to(site_url("admin/dashboard"));
        }

        $id = (int) $this->request->getPost("id");
        if ($id <= 0) {
            return redirect()->to(site_url("admin/table/" . $table));
        }

        $db = Database::connect();
        $fields = $db->getFieldNames($table);
        $data = $this->collectRowData($fields);
        if (!empty($data)) {
            $db->table($table)->where("id", $id)->update($data);
        }

        return redirect()->to(site_url("admin/table/" . $table));
    }

    /**
     * Delete a row in a table.
     *
     * @param string $table
     * @return RedirectResponse
     */
    public function delete(string $table): RedirectResponse
    {
        $guard = $this->requireLogin();
        if ($guard instanceof RedirectResponse) {
            return $guard;
        }

        if (!$this->isAllowedTable($table)) {
            return redirect()->to(site_url("admin/dashboard"));
        }

        $id = (int) $this->request->getPost("id");
        if ($id > 0) {
            $db = Database::connect();
            $db->table($table)->where("id", $id)->delete();
        }

        return redirect()->to(site_url("admin/table/" . $table));
    }

    /**
     * Ensure admin session is active.
     *
     * @return RedirectResponse|null
     */
    private function requireLogin(): ?RedirectResponse
    {
        /** @var JwtConfig $jwtConfig */
        $jwtConfig = config("JWT");
        $jwtService = new JwtService($jwtConfig);
        // Validate JWT cookie for protected admin routes.
        $token = $this->request->getCookie($jwtConfig->getCookieName());
        if (is_string($token) && $jwtService->decodeToken($token) !== null) {
            return null;
        }

        // Invalid or expired token should send users back to the main site.
        $response = redirect()->to(site_url("/"));
        $response->deleteCookie($jwtConfig->getCookieName());
        return $response;
    }

    /**
     * Validate that a table is allowed to be managed.
     *
     * @param string $table
     * @return bool
     */
    private function isAllowedTable(string $table): bool
    {
        return in_array($table, $this->allowedTables, true);
    }

    /**
     * Collect posted form data for insert/update.
     *
     * @param string[] $fields
     * @return array<string, mixed>
     */
    private function collectRowData(array $fields): array
    {
        $data = [];
        foreach ($fields as $field) {
            if ($field === "id") {
                continue;
            }
            $value = $this->request->getPost($field);
            if ($value === null) {
                continue;
            }
            $data[$field] = $value;
        }

        return $data;
    }
}
