<?php

namespace App\Controllers;

use App\Libraries\JwtService;
use App\Models\EducationModel;
use App\Models\ProfileModel;
use App\Models\ProfileTagModel;
use App\Models\ProjectDocModel;
use App\Models\ProjectHighlightModel;
use App\Models\ProjectLinkModel;
use App\Models\ProjectModel;
use App\Models\ProjectTagModel;
use App\Models\SiteSettingModel;
use App\Models\SkillGroupModel;
use App\Models\SkillModel;
use App\Models\SocialLinkModel;
use Config\JWT as JwtConfig;

class Home extends BaseController
{
    /**
     * Render the resume landing page.
     *
     * @return string
     */
    public function index(): string
    {
        // Ensure URL helper is available for base_url() in the view.
        helper("url");

        $session = session();
        $adminError = $session->getFlashdata("admin_error");
        $adminDebug = $session->getFlashdata("admin_debug");
        $adminErrorQuery = $this->request->getGet("admin_error");
        /** @var JwtConfig $jwtConfig */
        $jwtConfig = config("JWT");
        $jwtService = new JwtService($jwtConfig);
        // Resolve admin state from JWT instead of session flags.
        $token = $this->request->getCookie($jwtConfig->getCookieName());
        $isAdmin = is_string($token) && $jwtService->decodeToken($token) !== null;
        if (empty($adminError) && $adminErrorQuery === "1") {
            $adminError = "Invalid credentials.";
        }

        $profileModel = new ProfileModel();
        $profileTagModel = new ProfileTagModel();
        $socialLinkModel = new SocialLinkModel();
        $skillGroupModel = new SkillGroupModel();
        $skillModel = new SkillModel();
        $projectModel = new ProjectModel();
        $projectTagModel = new ProjectTagModel();
        $projectHighlightModel = new ProjectHighlightModel();
        $projectLinkModel = new ProjectLinkModel();
        $projectDocModel = new ProjectDocModel();
        $educationModel = new EducationModel();
        $siteSettingModel = new SiteSettingModel();

        $profile = $profileModel->first();
        if (!$profile) {
            $profile = [
                "name" => "Portfolio",
                "kicker" => "Hi, I'm",
                "headline" => "A Computer Science student based in the Philippines.",
                "subheadline" => "A motivated developer focused on applied AI/ML and practical software projects—building tools, prototypes, and systems that solve real problems.",
                "resume_url" => "Resume_Togonon.pdf",
                "contact_url" => "#",
            ];
        }

        $profileTags = [];
        if (isset($profile["id"])) {
            $profileTags = $profileTagModel
                ->where("profile_id", (int) $profile["id"])
                ->orderBy("display_order", "ASC")
                ->findAll();
        }

        $socialLinks = $socialLinkModel
            ->orderBy("display_order", "ASC")
            ->findAll();

        $skillGroups = [];
        foreach ($skillGroupModel->orderBy("display_order", "ASC")->findAll() as $group) {
            $skills = $skillModel
                ->where("group_id", (int) $group["id"])
                ->orderBy("display_order", "ASC")
                ->findAll();
            $group["skills"] = $skills;
            $skillGroups[] = $group;
        }

        $projects = [];
        foreach ($projectModel->orderBy("display_order", "ASC")->findAll() as $project) {
            $projectId = (int) $project["id"];
            $project["tags"] = $projectTagModel
                ->where("project_id", $projectId)
                ->orderBy("display_order", "ASC")
                ->findAll();
            $project["highlights"] = $projectHighlightModel
                ->where("project_id", $projectId)
                ->orderBy("display_order", "ASC")
                ->findAll();
            $project["links"] = $projectLinkModel
                ->where("project_id", $projectId)
                ->orderBy("display_order", "ASC")
                ->findAll();
            $project["docs"] = $projectDocModel
                ->where("project_id", $projectId)
                ->orderBy("display_order", "ASC")
                ->findAll();
            $projects[] = $project;
        }

        $education = $educationModel
            ->orderBy("display_order", "ASC")
            ->findAll();

        $settings = [];
        foreach ($siteSettingModel->findAll() as $setting) {
            $settings[$setting["setting_key"]] = $setting["setting_value"];
        }

        return view("resume", [
            "profile" => $profile,
            "profileTags" => $profileTags,
            "socialLinks" => $socialLinks,
            "skillGroups" => $skillGroups,
            "projects" => $projects,
            "education" => $education,
            "settings" => $settings,
            "adminError" => $adminError,
            "adminDebug" => $adminDebug,
            "isAdmin" => $isAdmin,
        ]);
    }
}
