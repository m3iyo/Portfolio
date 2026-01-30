<?php
/**
 * Admin dashboard view.
 *
 * @return void
 */
?>
<?= $this->extend("layouts/admin") ?>
<?= $this->section("content") ?>

<section class="section admin-section">
  <div class="container">
    <div class="block-head">
      <h1 class="title is-4 has-text-centered">Admin Dashboard</h1>
      <p class="subtitle is-6 has-text-centered">Manage your content tables</p>
    </div>

    <?php
    /**
     * Map database table names to human-friendly labels.
     *
     * @var array<string, string>
     */
    $tableLabels = [
        "profiles" => "Profile",
        "profile_tags" => "Profile tags",
        "social_links" => "Social links",
        "skill_groups" => "Skill groups",
        "skills" => "Skills",
        "projects" => "Projects",
        "project_tags" => "Project Tags",
        "project_highlights" => "Project Highlights",
        "project_links" => "Project Links",
        "project_docs" => "Project Files",
        "education" => "Education",
        "site_settings" => "Settings",
        "contact_messages" => "Messages",
    ];
    ?>

    <?php foreach ($tableGroups as $groupName => $tables): ?>
      <div class="box admin-card">
        <div class="block-head">
          <h2 class="title is-5 has-text-centered"><?= esc($groupName) ?></h2>
        </div>

        <div class="columns is-multiline">
          <?php foreach ($tables as $table): ?>
            <?php $label = $tableLabels[$table] ?? $table; ?>
            <div class="column is-12">
              <div class="card admin-card">
                <div class="card-content">
                  <div class="level">
                    <div class="level-left">
                      <p class="has-text-weight-semibold"><?= esc($label) ?></p>
                    </div>
                    <div class="level-right">
                      <a class="button is-rounded btn-outline btn-cta" href="<?= site_url("admin/table/" . $table) ?>">
                        Manage
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?= $this->endSection() ?>
