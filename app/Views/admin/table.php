<?php
/**
 * Admin table management view.
 *
 * @return void
 */
$textareaFields = [
    "subheadline",
    "details",
    "setting_value",
    "highlight",
    "description",
    "message",
];
$isDeleteOnlyTable = $table === "contact_messages";
$displayFields = $fields;
if ($isDeleteOnlyTable) {
    $displayFields = array_values(array_filter(
        $fields,
        static fn (string $field): bool => $field !== "updated_at"
    ));
}
?>
<?= $this->extend("layouts/admin") ?>
<?= $this->section("content") ?>

<section class="section admin-section">
  <div class="container">
    <div class="level">
      <div class="level-left">
        <div>
          <h1 class="title is-4 mb-1"><?= esc($table) ?></h1>
          <p class="subtitle is-6">
            <?= $isDeleteOnlyTable ? "Delete records only" : "Create, update, or delete records" ?>
          </p>
        </div>
      </div>
      <div class="level-right">
        <?php if (!$isDeleteOnlyTable): ?>
        <button class="button is-rounded btn-outline btn-cta mr-2" type="button" data-toggle="add-form">
          Add
        </button>
        <?php endif; ?>
        <a class="button is-rounded btn-outline btn-cta" href="<?= site_url("admin/dashboard") ?>">Back</a>
      </div>
    </div>

    <?php if (!$isDeleteOnlyTable): ?>
    <div class="box admin-card is-hidden" id="addForm">
      <h2 class="title is-6">Add New</h2>
      <form method="post" action="<?= site_url("admin/table/" . $table . "/create") ?>">
        <?= csrf_field() ?>
            <?php
            /**
             * Provide placeholders per table for known fields.
             *
             * @return array<string, string>
             */
            $tablePlaceholders = [
                "profiles" => [
                    "name" => "e.g., Lord Patrick Raizen Togonon",
                    "kicker" => "e.g., Hi, I'm Lord Patrick,",
                    "headline" => "e.g., A Computer Science student based in the Philippines.",
                    "subheadline" => "Short intro paragraph",
                    "resume_url" => "Resume_Togonon.pdf",
                    "contact_url" => "https://example.com/contact",
                ],
                "profile_tags" => [
                    "profile_id" => "1",
                    "label" => "DOST Scholar - JLSS (2024 - 2026)",
                    "tag_class" => "is-info",
                    "display_order" => "1",
                ],
                "social_links" => [
                    "label" => "GitHub",
                    "url" => "https://github.com/username",
                    "icon_url" => "https://cdn.simpleicons.org/github/ffffff",
                    "display_order" => "1",
                ],
                "skill_groups" => [
                    "name" => "Languages",
                    "layout" => "tags | list",
                    "display_order" => "1",
                ],
                "skills" => [
                    "group_id" => "1",
                    "label" => "Python",
                    "icon_url" => "https://cdn.simpleicons.org/python",
                    "description" => "Optional short detail",
                    "display_order" => "1",
                ],
                "projects" => [
                    "title" => "Project title",
                    "display_order" => "1",
                ],
                "project_tags" => [
                    "project_id" => "1",
                    "label" => "PyTorch",
                    "tag_class" => "is-info is-light",
                    "display_order" => "1",
                ],
                "project_highlights" => [
                    "project_id" => "1",
                    "highlight" => "Short project highlight",
                    "display_order" => "1",
                ],
                "project_links" => [
                    "project_id" => "1",
                    "label" => "View Demo",
                    "url" => "https://example.com/demo",
                    "display_order" => "1",
                ],
                "project_docs" => [
                    "project_id" => "1",
                    "button_label" => "View Paper",
                    "modal_title" => "Project Paper",
                    "preview_url" => "https://docs.google.com/.../preview",
                    "download_url" => "https://docs.google.com/.../export?format=pdf",
                    "display_order" => "1",
                ],
                "education" => [
                    "level" => "Tertiary",
                    "years" => "2022–Present",
                    "location" => "La Paz, Iloilo, PH",
                    "school" => "West Visayas State University",
                    "details" => "Additional details (HTML allowed)",
                    "color" => "#ffffff",
                    "display_order" => "1",
                ],
                "site_settings" => [
                    "setting_key" => "cta_title",
                    "setting_value" => "Contact",
                ],
                "contact_messages" => [
                    "name" => "Jane Doe",
                    "email" => "jane@example.com",
                    "message" => "Hello! I would like to connect about a project.",
                ],
            ];
            $placeholders = $tablePlaceholders[$table] ?? [];
            ?>
            <div class="columns is-multiline">
          <?php foreach ($displayFields as $field): ?>
            <?php if ($field === "id"): ?>
              <?php continue; ?>
            <?php endif; ?>
            <div class="column is-6">
              <label class="label"><?= esc($field) ?></label>
                  <?php $placeholder = $placeholders[$field] ?? ("Enter " . $field); ?>
                  <?php if (in_array($field, $textareaFields, true)): ?>
                    <textarea class="textarea" name="<?= esc($field) ?>" rows="3" placeholder="<?= esc($placeholder) ?>"></textarea>
                  <?php else: ?>
                    <input class="input" type="text" name="<?= esc($field) ?>" placeholder="<?= esc($placeholder) ?>" />
                  <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="field">
          <button class="button is-rounded btn-outline btn-cta" type="submit">Create</button>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <div class="box admin-card">
      <h2 class="title is-6">Existing Records</h2>
      <div class="table-container">
        <table class="table is-fullwidth admin-table">
          <thead>
            <tr>
              <?php foreach ($displayFields as $field): ?>
                <th><?= esc($field) ?></th>
              <?php endforeach; ?>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($rows)): ?>
              <tr>
                <td colspan="<?= count($displayFields) + 1 ?>">No records found.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($rows as $row): ?>
                <?php $rowId = $row["id"] ?? uniqid("row_", true); ?>
                <?php $formId = "update-form-" . (string) $rowId; ?>
                <form id="<?= esc($formId) ?>" method="post" action="<?= site_url("admin/table/" . $table . "/update") ?>">
                  <?= csrf_field() ?>
                </form>
                <tr data-row>
                  <?php foreach ($displayFields as $field): ?>
                    <?php $value = $row[$field] ?? ""; ?>
                    <td>
                      <?php $placeholder = $placeholders[$field] ?? ("Enter " . $field); ?>
                      <?php if ($field === "id"): ?>
                        <input class="input is-small" type="text" name="id" value="<?= esc($value) ?>" readonly form="<?= esc($formId) ?>" />
                      <?php elseif (in_array($field, $textareaFields, true)): ?>
                        <textarea class="textarea is-small" name="<?= esc($field) ?>" rows="2" form="<?= esc($formId) ?>"<?= $isDeleteOnlyTable ? " readonly" : " disabled" ?> placeholder="<?= esc($placeholder) ?>"><?= esc($value) ?></textarea>
                      <?php else: ?>
                        <input class="input is-small" type="text" name="<?= esc($field) ?>" value="<?= esc($value) ?>" form="<?= esc($formId) ?>"<?= $isDeleteOnlyTable ? " readonly" : " disabled" ?> placeholder="<?= esc($placeholder) ?>" />
                      <?php endif; ?>
                    </td>
                  <?php endforeach; ?>
                  <td class="admin-actions">
                    <div class="buttons">
                      <?php if (!$isDeleteOnlyTable): ?>
                      <button class="button is-rounded btn-outline btn-cta is-small" type="button" data-edit="<?= esc($formId) ?>">
                        Edit
                      </button>
                      <button class="button is-rounded btn-outline btn-cta is-small is-hidden" type="submit" form="<?= esc($formId) ?>" data-save="<?= esc($formId) ?>">
                        Save
                      </button>
                      <?php endif; ?>
                      <form
                        method="post"
                        action="<?= site_url("admin/table/" . $table . "/delete") ?>"
                        onsubmit="return confirm('Delete this record?');"
                        class="<?= $isDeleteOnlyTable ? "" : "is-hidden" ?>"
                        data-delete="<?= esc($formId) ?>"
                      >
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= esc($row["id"] ?? "") ?>" />
                        <button class="button is-rounded btn-outline btn-cta is-small" type="submit">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const addButton = document.querySelector("[data-toggle=\"add-form\"]");
    const addForm = document.getElementById("addForm");
    if (addButton && addForm) {
      addButton.addEventListener("click", () => {
        addForm.classList.toggle("is-hidden");
      });
    }

    const editButtons = Array.prototype.slice.call(document.querySelectorAll("[data-edit]"), 0);
    editButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const formId = button.getAttribute("data-edit");
        const row = button.closest("[data-row]");
        if (!row || !formId) {
          return;
        }
        const inputs = row.querySelectorAll("input, textarea");
        inputs.forEach((input) => {
          if (input.getAttribute("name") === "id") {
            return;
          }
          input.removeAttribute("disabled");
        });

        button.classList.add("is-hidden");
        const saveButton = row.querySelector(`[data-save="${formId}"]`);
        const deleteForm = row.querySelector(`[data-delete="${formId}"]`);
        if (saveButton) {
          saveButton.classList.remove("is-hidden");
        }
        if (deleteForm) {
          deleteForm.classList.remove("is-hidden");
        }
      });
    });
  });
</script>

<?= $this->endSection() ?>
