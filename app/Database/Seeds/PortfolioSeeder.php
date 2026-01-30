<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seed initial portfolio content.
 */
class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = $this->db;

        $db->disableForeignKeyChecks();
        $db->table("project_docs")->truncate();
        $db->table("project_links")->truncate();
        $db->table("project_highlights")->truncate();
        $db->table("project_tags")->truncate();
        $db->table("projects")->truncate();
        $db->table("skills")->truncate();
        $db->table("skill_groups")->truncate();
        $db->table("profile_tags")->truncate();
        $db->table("social_links")->truncate();
        $db->table("profiles")->truncate();
        $db->table("education")->truncate();
        $db->table("site_settings")->truncate();
        $db->enableForeignKeyChecks();

        $db->table("profiles")->insert([
            "name" => "Lord Patrick Raizen Togonon",
            "kicker" => "Hi, I'm Lord Patrick,",
            "headline" => "A Computer Science student based in the Philippines.",
            "subheadline" => "A motivated developer focused on applied AI/ML and practical software projects—building tools, prototypes, and systems that solve real problems.",
            "resume_url" => "Resume_Togonon.pdf",
            "contact_url" => "#",
        ]);
        $profileId = (int) $db->insertID();

        $db->table("profile_tags")->insertBatch([
            [
                "profile_id" => $profileId,
                "label" => "West Visayas State University (2022-Present)",
                "tag_class" => "is-info",
                "display_order" => 1,
            ],
            [
                "profile_id" => $profileId,
                "label" => "DOST Scholar - JLSS (2024 - 2026)",
                "tag_class" => "is-info",
                "display_order" => 2,
            ],
        ]);

        $db->table("social_links")->insertBatch([
            [
                "label" => "GitHub",
                "url" => "https://github.com/m3iyo",
                "icon_url" => "https://cdn.simpleicons.org/github/ffffff",
                "display_order" => 1,
            ],
            [
                "label" => "LinkedIn",
                "url" => "https://www.linkedin.com/in/lord-patrick-raizen-togonon-868448273/",
                "icon_url" => "https://cdn.simpleicons.org/linkedin/ffffff",
                "display_order" => 2,
            ],
        ]);

        $db->table("skill_groups")->insertBatch([
            [
                "name" => "Languages",
                "layout" => "tags",
                "display_order" => 1,
            ],
            [
                "name" => "Machine Learning & AI",
                "layout" => "tags",
                "display_order" => 2,
            ],
            [
                "name" => "Systems & Networking",
                "layout" => "list",
                "display_order" => 3,
            ],
            [
                "name" => "Tools",
                "layout" => "tags",
                "display_order" => 4,
            ],
            [
                "name" => "Interests",
                "layout" => "tags",
                "display_order" => 5,
            ],
        ]);

        $skillGroupIds = [];
        foreach ($db->table("skill_groups")->get()->getResultArray() as $group) {
            $skillGroupIds[$group["name"]] = (int) $group["id"];
        }

        $db->table("skills")->insertBatch([
            [
                "group_id" => $skillGroupIds["Languages"],
                "label" => "Python",
                "icon_url" => "https://cdn.simpleicons.org/python",
                "display_order" => 1,
            ],
            [
                "group_id" => $skillGroupIds["Languages"],
                "label" => "C++",
                "icon_url" => "https://cdn.simpleicons.org/cplusplus",
                "display_order" => 2,
            ],
            [
                "group_id" => $skillGroupIds["Languages"],
                "label" => "HTML",
                "icon_url" => "https://cdn.simpleicons.org/html5",
                "display_order" => 3,
            ],
            [
                "group_id" => $skillGroupIds["Languages"],
                "label" => "Tailwind CSS",
                "icon_url" => "https://cdn.simpleicons.org/tailwindcss",
                "display_order" => 4,
            ],
            [
                "group_id" => $skillGroupIds["Languages"],
                "label" => "PHP",
                "icon_url" => "https://cdn.simpleicons.org/php",
                "display_order" => 5,
            ],
            [
                "group_id" => $skillGroupIds["Languages"],
                "label" => "JavaScript",
                "icon_url" => "https://cdn.simpleicons.org/javascript",
                "display_order" => 6,
            ],
            [
                "group_id" => $skillGroupIds["Machine Learning & AI"],
                "label" => "Keras",
                "icon_url" => "https://cdn.simpleicons.org/keras",
                "display_order" => 1,
            ],
            [
                "group_id" => $skillGroupIds["Machine Learning & AI"],
                "label" => "TensorFlow",
                "icon_url" => "https://cdn.simpleicons.org/tensorflow",
                "display_order" => 2,
            ],
            [
                "group_id" => $skillGroupIds["Machine Learning & AI"],
                "label" => "PyTorch",
                "icon_url" => "https://cdn.simpleicons.org/pytorch",
                "display_order" => 3,
            ],
            [
                "group_id" => $skillGroupIds["Machine Learning & AI"],
                "label" => "OpenCV",
                "icon_url" => "https://cdn.simpleicons.org/opencv/ffffff",
                "display_order" => 4,
            ],
            [
                "group_id" => $skillGroupIds["Machine Learning & AI"],
                "label" => "Pandas",
                "icon_url" => "https://cdn.simpleicons.org/pandas/ffffff",
                "display_order" => 5,
            ],
            [
                "group_id" => $skillGroupIds["Machine Learning & AI"],
                "label" => "NumPy",
                "icon_url" => "https://cdn.simpleicons.org/numpy/ffffff",
                "display_order" => 6,
            ],
            [
                "group_id" => $skillGroupIds["Machine Learning & AI"],
                "label" => "YOLO",
                "icon_url" => "https://cdn.simpleicons.org/yolo/ffffff",
                "display_order" => 7,
            ],
            [
                "group_id" => $skillGroupIds["Systems & Networking"],
                "label" => "Network traffic analysis with Wireshark",
                "icon_url" => "https://cdn.simpleicons.org/wireshark/ffffff",
                "display_order" => 1,
            ],
            [
                "group_id" => $skillGroupIds["Systems & Networking"],
                "label" => "Cisco Packet Tracer",
                "icon_url" => "https://cdn.simpleicons.org/cisco/ffffff",
                "display_order" => 2,
            ],
            [
                "group_id" => $skillGroupIds["Systems & Networking"],
                "label" => "CLI and PowerShell scripting",
                "icon_url" => "https://cdn.simpleicons.org/linux/ffffff",
                "display_order" => 3,
            ],
            [
                "group_id" => $skillGroupIds["Tools"],
                "label" => "Git",
                "icon_url" => "https://cdn.simpleicons.org/git",
                "display_order" => 1,
            ],
            [
                "group_id" => $skillGroupIds["Tools"],
                "label" => "GitHub",
                "icon_url" => "https://cdn.simpleicons.org/github",
                "display_order" => 2,
            ],
            [
                "group_id" => $skillGroupIds["Tools"],
                "label" => "Vim",
                "icon_url" => "https://cdn.simpleicons.org/vim",
                "display_order" => 3,
            ],
            [
                "group_id" => $skillGroupIds["Interests"],
                "label" => "Artificial Intelligence & Machine Learning",
                "icon_url" => "https://cdn.simpleicons.org/probot/ffffff",
                "display_order" => 1,
            ],
            [
                "group_id" => $skillGroupIds["Interests"],
                "label" => "CyberSecurity",
                "icon_url" => "https://cdn.simpleicons.org/cyberdefenders/ffffff",
                "display_order" => 2,
            ],
        ]);

        $db->table("projects")->insertBatch([
            [
                "title" => "OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization",
                "display_order" => 1,
            ],
            [
                "title" => "SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)",
                "display_order" => 2,
            ],
            [
                "title" => "Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection",
                "display_order" => 3,
            ],
        ]);

        $projects = [];
        foreach ($db->table("projects")->get()->getResultArray() as $project) {
            $projects[$project["title"]] = (int) $project["id"];
        }

        $db->table("project_tags")->insertBatch([
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "label" => "Python", "tag_class" => "is-info is-light", "display_order" => 1],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "label" => "PyTorch", "tag_class" => "is-info is-light", "display_order" => 2],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "label" => "ResNet18", "tag_class" => "is-info is-light", "display_order" => 3],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "label" => "YOLOv8", "tag_class" => "is-info is-light", "display_order" => 4],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "label" => "OpenCV", "tag_class" => "is-info is-light", "display_order" => 5],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "label" => "Next.js", "tag_class" => "is-info is-light", "display_order" => 6],

            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "label" => "Flutter (Dart)", "tag_class" => "is-success is-light", "display_order" => 1],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "label" => "Firebase Firestore", "tag_class" => "is-success is-light", "display_order" => 2],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "label" => "Firebase SDKs", "tag_class" => "is-success is-light", "display_order" => 3],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "label" => "Cloud Firestore REST API", "tag_class" => "is-success is-light", "display_order" => 4],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "label" => "Android", "tag_class" => "is-success is-light", "display_order" => 5],

            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "label" => "Python", "tag_class" => "is-warning is-light", "display_order" => 1],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "label" => "YOLOv8", "tag_class" => "is-warning is-light", "display_order" => 2],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "label" => "OpenCV", "tag_class" => "is-warning is-light", "display_order" => 3],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "label" => "NumPy", "tag_class" => "is-warning is-light", "display_order" => 4],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "label" => "ONNX", "tag_class" => "is-warning is-light", "display_order" => 5],
        ]);

        $db->table("project_highlights")->insertBatch([
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "highlight" => "Developed a diagnostic system for automatic fracture classification and localization from X-ray images", "display_order" => 1],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "highlight" => "Implemented a hybrid pipeline: ResNet18 (classification) + YOLOv8 (localization)", "display_order" => 2],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "highlight" => "Preprocessed and augmented X-ray images to improve robustness", "display_order" => 3],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "highlight" => "Evaluated using accuracy, precision, recall, and F1-score", "display_order" => 4],
            ["project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"], "highlight" => "Designed modular architecture supporting efficient inference and future clinical integration", "display_order" => 5],

            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "highlight" => "Built a mobile gig marketplace connecting job seekers and employers for low-skilled work opportunities in Iloilo City", "display_order" => 1],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "highlight" => "Implemented job posting, browsing, and in-app job applications with activity-based tracking", "display_order" => 2],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "highlight" => "Added real-time messaging (conversation list, history, notifications — noted as buggy)", "display_order" => 3],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "highlight" => "Designed role-aware navigation so users can switch between job seeker and employer behaviors", "display_order" => 4],
            ["project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"], "highlight" => "Integrated a Firebase-backed architecture for profiles, job posts, and messages with responsive sync", "display_order" => 5],

            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "highlight" => "Created a real-time pipeline to detect and count vehicles from video streams", "display_order" => 1],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "highlight" => "Fine-tuned YOLOv8 on a custom top-view/aerial vehicle dataset for surveillance viewpoints", "display_order" => 2],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "highlight" => "Implemented ROI-based counting using polygon regions and center-point filtering", "display_order" => 3],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "highlight" => "Computed normalized traffic density using D = N / A for consistent metrics", "display_order" => 4],
            ["project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"], "highlight" => "Exported the trained model to ONNX for cross-platform deployment and scalable integration", "display_order" => 5],
        ]);

        $db->table("project_links")->insertBatch([
            [
                "project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"],
                "label" => "View Demo",
                "url" => "https://orthovision.vercel.app/",
                "display_order" => 1,
            ],
            [
                "project_id" => $projects["SideQuest: A Mobile Platform for Sideline Gigs and Local Job Matching (Iloilo City)"],
                "label" => "View Repo",
                "url" => "https://github.com/m3iyo/side_quest",
                "display_order" => 1,
            ],
        ]);

        $db->table("project_docs")->insertBatch([
            [
                "project_id" => $projects["OrthoVision: A Computer-Aided Diagnostic System for Bone Fracture Classification and Localization"],
                "button_label" => "View Paper",
                "modal_title" => "OrthoVision",
                "preview_url" => "https://docs.google.com/document/d/1dq9v-I7YESPmHRFMf58A3kCTxxcQoqOOuzsIvMdxb_8/preview",
                "download_url" => "https://docs.google.com/document/d/1dq9v-I7YESPmHRFMf58A3kCTxxcQoqOOuzsIvMdxb_8/export?format=pdf",
                "display_order" => 2,
            ],
            [
                "project_id" => $projects["Real-Time Traffic Density Estimation Using Fine-Tuned YOLOv8 Object Detection"],
                "button_label" => "View Paper",
                "modal_title" => "Traffic Density Paper",
                "preview_url" => "https://drive.google.com/file/d/107UcAoh1FpbHfSkvP_FRRjUBZGHw1YPE/preview",
                "download_url" => "https://drive.google.com/uc?export=download&id=107UcAoh1FpbHfSkvP_FRRjUBZGHw1YPE",
                "display_order" => 1,
            ],
        ]);

        $db->table("education")->insertBatch([
            [
                "level" => "Tertiary",
                "years" => "2022–Present",
                "location" => "La Paz, Iloilo, PH",
                "school" => "West Visayas State University",
                "details" => "Organization: Vice President for External Affairs, West Esports",
                "color" => "#ffffff",
                "display_order" => 1,
            ],
            [
                "level" => "Secondary",
                "years" => "2016–2022",
                "location" => "Leganes, Iloilo, PH",
                "school" => "Leganes National High School",
                "details" => "Graduation Date: March 2022<br /><span class=\"is-size-7\">Math Club Officer Service Awardee, With High Honors</span>",
                "color" => "#b3b3b3",
                "display_order" => 2,
            ],
            [
                "level" => "Primary",
                "years" => "2010–2016",
                "location" => "Leganes, Iloilo, PH",
                "school" => "Leganes Central Elementary School",
                "details" => "Graduation Date: March 2016<br /><span class=\"is-size-7\">Award: Academic Excellence</span>",
                "color" => "#a6a6a6",
                "display_order" => 3,
            ],
        ]);

        $db->table("site_settings")->insertBatch([
            [
                "setting_key" => "footer_text",
                "setting_value" => "2025 © Lord Patrick Raizen Togonon • All Rights Reserved.",
            ],
            [
                "setting_key" => "skills_subtitle",
                "setting_value" => "Technologies and tools I usually work with",
            ],
            [
                "setting_key" => "projects_subtitle",
                "setting_value" => "Featured projects and implementation highlights",
            ],
            [
                "setting_key" => "education_subtitle",
                "setting_value" => "Academic background",
            ],
            [
                "setting_key" => "cta_title",
                "setting_value" => "Contact",
            ],
            [
                "setting_key" => "cta_subtitle",
                "setting_value" => "Let’s build something meaningful together",
            ],
            [
                "setting_key" => "cta_body",
                "setting_value" => "If you want to collaborate, discuss a project, or just say hello, feel free to reach out.",
            ],
            [
                "setting_key" => "cta_facebook_url",
                "setting_value" => "https://facebook.com",
            ],
            [
                "setting_key" => "cta_gmail_email",
                "setting_value" => "hello@example.com",
            ],
            [
                "setting_key" => "cta_instagram_url",
                "setting_value" => "https://instagram.com",
            ],
        ]);
    }
}
