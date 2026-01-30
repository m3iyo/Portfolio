<?php
/**
 * @return void
 */
?>
<?= $this->extend("layouts/default") ?>
<?= $this->section("content") ?>

<!-- HERO -->
    <section id="about" class="hero landing-hero">
      <div class="hero-body" style="width: 100%;">
        <div class="container">
          <div class="columns is-vcentered">
            <div class="column is-8">
              <p class="landing-kicker is-size-5 mb-2"><?= esc($profile["kicker"]) ?></p>

              <h1 class="landing-title title is-1 mb-4">
                <?= esc($profile["headline"]) ?>
                <span class="sparkle">✦</span><span class="sparkle" style="color:#f4c556;">✦</span>
              </h1>

              <p class="landing-muted is-size-6 mb-5">
                <?= esc($profile["subheadline"]) ?>
              </p>

              <div class="hero-actions">
                <a
                  target="_blank"
                  class="button is-rounded btn-primary"
                  href="<?= base_url($profile["resume_url"]) ?>"
                  download="<?= esc($profile["resume_url"]) ?>"
                >
                  <span style="display:inline-flex; align-items:center; gap:10px;">
                    <svg
                      stroke="currentColor"
                      fill="none"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      width="18"
                      height="18"
                      xmlns="http://www.w3.org/2000/svg"
                      style="display:block;"
                    >
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                      <polyline points="7 10 12 15 17 10"></polyline>
                      <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Resume</span>
                  </span>
                </a>

                <a class="button is-rounded btn-outline" href="<?= esc($profile["contact_url"] ?? "#") ?>">Get in Touch</a>

                <?php
                /**
                 * Render LinkedIn icon with a hardcoded SVG to avoid CDN dependencies.
                 *
                 * @return void
                 */
                ?>
                <a
                  class="icon-pill"
                  href="https://www.linkedin.com/in/lord-patrick-raizen-togonon-868448273/"
                  target="_blank"
                  rel="noreferrer"
                  aria-label="LinkedIn"
                >
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                    style="display:block;"
                  >
                    <path
                      fill="currentColor"
                      d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.266 2.37 4.266 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.919-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.777 13.019H3.56V9h3.554v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.727v20.545C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.273V1.727C24 .774 23.2 0 22.222 0h.003z"
                    />
                  </svg>
                </a>
                <?php foreach ($socialLinks as $link): ?>
                  <?php $labelLower = strtolower((string) ($link["label"] ?? "")); ?>
                  <?php if ($labelLower === "linkedin"): ?>
                    <?php continue; ?>
                  <?php endif; ?>
                  <a
                    class="icon-pill"
                    href="<?= esc($link["url"]) ?>"
                    target="_blank"
                    rel="noreferrer"
                    aria-label="<?= esc($link["label"]) ?>"
                  >
                    <img src="<?= esc($link["icon_url"]) ?>" alt="<?= esc($link["label"]) ?>" />
                  </a>
                <?php endforeach; ?>
              </div>

              <div class="tags is-justify-content-left mt-4">
                <?php foreach ($profileTags as $tag): ?>
                  <span class="tag <?= esc($tag["tag_class"]) ?>"><?= esc($tag["label"]) ?></span>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="column is-4 is-hidden-touch"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- MAIN -->
    <section class="section section-main">
      <div class="container">

        <!-- SKILLS -->
        <div id="skills" class="section-block">
          <div class="columns is-variable is-6 is-centered">
            <div class="column is-10">
              <div class="block-head">
                <h2 class="title is-5 has-text-centered">Skills</h2>
                <p class="subtitle is-6 has-text-centered">
                  <?= esc($settings["skills_subtitle"] ?? "Technologies and tools I usually work with") ?>
                </p>
              </div>

              <div class="columns is-multiline is-variable is-3 is-centered">
                <?php foreach ($skillGroups as $group): ?>
                  <?php $isFullWidth = $group["name"] === "Interests"; ?>
                  <div class="column <?= $isFullWidth ? "is-12" : "is-12-mobile is-6-tablet is-6-desktop" ?>">
                    <div class="box">
                      <p class="has-text-weight-semibold mb-2 has-text-centered" style="color:#fff;"><?= esc($group["name"]) ?></p>

                      <?php if ($group["layout"] === "list"): ?>
                        <div class="content has-text-centered">
                          <ul class="tags are-medium is-justify-content-center">
                            <?php foreach ($group["skills"] as $skill): ?>
                              <li class="tag">
                                <?php if (!empty($skill["icon_url"])): ?>
                                  <img class="skill-icon" src="<?= esc($skill["icon_url"]) ?>" alt="<?= esc($skill["label"]) ?>" />
                                <?php endif; ?>
                                <?= esc($skill["label"]) ?>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      <?php else: ?>
                        <div class="tags are-medium is-justify-content-center">
                          <?php foreach ($group["skills"] as $skill): ?>
                            <span class="tag<?= $group["name"] === "Interests" ? " is-link is-light" : "" ?>">
                              <?php if (!empty($skill["icon_url"])): ?>
                                <img class="skill-icon" src="<?= esc($skill["icon_url"]) ?>" alt="<?= esc($skill["label"]) ?>" />
                              <?php endif; ?>
                              <?= esc($skill["label"]) ?>
                            </span>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="section-divider"></div>

        <!-- PROJECTS -->
        <div id="projects" class="section-block">
          <div class="columns is-variable is-6 is-centered">
            <div class="column is-10">
              <div class="block-head">
                <h2 class="title is-4 has-text-centered">Projects</h2>
                <p class="subtitle is-6 has-text-centered">
                  <?= esc($settings["projects_subtitle"] ?? "Featured projects and implementation highlights") ?>
                </p>
              </div>

              <div class="cards-stack">
                <?php foreach ($projects as $project): ?>
                  <article class="card">
                    <div class="card-content">
                      <div class="content">
                        <h3 class="title is-5 mb-2" style="color:#fff;">
                          <?= esc($project["title"]) ?>
                        </h3>

                        <div class="tags mb-3">
                          <?php foreach ($project["tags"] as $tag): ?>
                            <span class="tag <?= esc($tag["tag_class"]) ?>"><?= esc($tag["label"]) ?></span>
                          <?php endforeach; ?>
                        </div>

                        <ul>
                          <?php foreach ($project["highlights"] as $highlight): ?>
                            <li><?= esc($highlight["highlight"]) ?></li>
                          <?php endforeach; ?>
                        </ul>

                        <?php $hasFlex = (count($project["links"]) + count($project["docs"])) > 1; ?>
                        <div class="mt-4"<?= $hasFlex ? " style=\"display:flex; flex-wrap: wrap; gap: 10px;\"" : "" ?>>
                          <?php foreach ($project["links"] as $link): ?>
                            <a
                              class="button is-rounded btn-demo"
                              href="<?= esc($link["url"]) ?>"
                              target="_blank"
                              rel="noreferrer"
                            >
                              <?= esc($link["label"]) ?>
                            </a>
                          <?php endforeach; ?>

                          <?php foreach ($project["docs"] as $doc): ?>
                            <button
                              class="button is-rounded btn-demo"
                              type="button"
                              data-modal-target="project-modal-<?= esc($doc["id"]) ?>"
                            >
                              <?= esc($doc["button_label"]) ?>
                            </button>
                          <?php endforeach; ?>
                        </div>
                      </div>
                    </div>
                  </article>
                <?php endforeach; ?>
              </div>

            </div>
          </div>
        </div>

        <div class="section-divider"></div>

        <!-- EDUCATION -->
        <div id="education" class="section-block">
          <div class="columns is-centered">
            <div class="column is-10">
              <div class="block-head">
                <h2 class="title is-4 has-text-centered">Education</h2>
                <p class="subtitle is-6 has-text-centered">
                  <?= esc($settings["education_subtitle"] ?? "Academic background") ?>
                </p>
              </div>

              <div class="box">
                <div class="content">
                  <?php $educationCount = count($education); ?>
                  <?php foreach ($education as $index => $entry): ?>
                    <h3 class="title is-6 mb-1" style="color:<?= esc($entry["color"]) ?>;">
                      <?= esc($entry["level"]) ?> (<?= esc($entry["years"]) ?>) — <?= esc($entry["location"]) ?>
                    </h3>
                    <p class="<?= $index === $educationCount - 1 ? "mb-0" : "mb-4" ?>">
                      <strong style="color:<?= esc($entry["color"]) ?>;"><?= esc($entry["school"]) ?></strong><br />
                      <?= $entry["details"] ?>
                    </p>
                  <?php endforeach; ?>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="section-divider"></div>

        <!-- CONTACT CTA -->
        <div id="cta" class="section-block">
          <div class="columns is-centered">
            <div class="column is-10">
              <div class="block-head">
                <h2 class="title is-4 has-text-centered">
                  <?= esc($settings["cta_title"] ?? "Contact") ?>
                </h2>
                <p class="subtitle is-6 has-text-centered">
                  <?= esc($settings["cta_subtitle"] ?? "Let’s build something meaningful together") ?>
                </p>

              </div>

              <div class="box has-text-centered">
                <p class="mb-4">
                  <?= esc($settings["cta_body"] ?? "If you want to collaborate, discuss a project, or just say hello, feel free to reach out.") ?>
                </p>
                <div class="buttons is-centered">
                  <a
                    class="button is-rounded btn-outline btn-cta"
                    href="<?= esc($settings["cta_facebook_url"] ?? "https://facebook.com") ?>"
                    target="_blank"
                    rel="noreferrer"
                    aria-label="Facebook"
                  >
                    <img class="skill-icon" src="https://cdn.simpleicons.org/facebook/ffffff" alt="Facebook" />
                  </a>
                  <a
                    class="button is-rounded btn-outline btn-cta"
                    href="<?= esc($settings["cta_instagram_url"] ?? "https://instagram.com") ?>"
                    target="_blank"
                    rel="noreferrer"
                    aria-label="Instagram"
                  >
                    <img class="skill-icon" src="https://cdn.simpleicons.org/instagram/ffffff" alt="Instagram" />
                  </a>
                </div>
              </div>
              <div class="card contact-card mt-5">
                <header class="card-header">
                  <p class="card-header-title">Send me an email</p>
                </header>
                <div class="card-content">
                  <form
                    id="contactForm"
                    class="contact-form"
                    method="post"
                    action="<?= site_url("contact") ?>"
                    novalidate
                  >
                    <?= csrf_field() ?>
                    <?php if (!empty($contactSuccess)): ?>
                      <div class="notification is-success is-light" role="status" aria-live="polite">
                        <?= esc($contactSuccess) ?>
                      </div>
                    <?php endif; ?>
                    <?php if (!empty($contactError)): ?>
                      <div class="notification is-danger is-light" role="status" aria-live="polite">
                        <?= esc($contactError) ?>
                      </div>
                    <?php endif; ?>
                    <div class="columns is-variable is-5">
                      <div class="column is-6">
                        <div class="field">
                          <label class="label">Name</label>
                          <div class="control">
                            <input class="input" type="text" name="name" placeholder="Your name" value="<?= esc($contactOld["name"] ?? "") ?>" required />
                          </div>
                        </div>
                        <div class="field">
                          <label class="label">Email</label>
                          <div class="control">
                            <input class="input" type="email" name="email" placeholder="you@example.com" value="<?= esc($contactOld["email"] ?? "") ?>" required />
                          </div>
                        </div>
                      </div>
                      <div class="column is-6">
                        <div class="field">
                          <label class="label">Message</label>
                          <div class="control">
                            <textarea class="textarea" name="message" rows="6" placeholder="Write your message..." required><?= esc($contactOld["message"] ?? "") ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="field has-text-right">
                      <button class="button is-rounded btn-outline btn-cta" type="submit">Send Email</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <?php
    /**
     * Render the shared footer partial.
     *
     * @return void
     */
    ?>
    <?= $this->include("partials/footer") ?>

    <?php foreach ($projects as $project): ?>
      <?php foreach ($project["docs"] as $doc): ?>
        <div id="project-modal-<?= esc($doc["id"]) ?>" class="modal">
          <div class="modal-background"></div>

          <div class="modal-card" style="width: min(980px, 94vw);">
            <header class="modal-card-head">
              <p class="modal-card-title"><?= esc($doc["modal_title"]) ?></p>
              <button class="delete" aria-label="close"></button>
            </header>

            <section class="modal-card-body">
              <iframe
                class="doc-frame"
                src="<?= esc($doc["preview_url"]) ?>"
                allow="autoplay"
              ></iframe>
            </section>

            <footer class="modal-card-foot" style="justify-content: flex-end;">
              <div class="doc-actions">
                <a
                  class="button is-rounded btn-demo"
                  href="<?= esc($doc["download_url"]) ?>"
                  target="_blank"
                  rel="noreferrer"
                >
                  Download PDF
                </a>

                <button class="button is-rounded btn-outline" type="button" data-modal-close="true">
                  Close
                </button>
              </div>
            </footer>
          </div>

          <button class="modal-close is-large" aria-label="close"></button>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>

    <div id="adminLoginModal" class="modal admin-login-modal">
      <div class="modal-background"></div>

      <div class="modal-card" style="width: min(560px, 92vw);">
        <header class="modal-card-head">
          <p class="modal-card-title">Admin</p>
          <button class="delete" aria-label="close"></button>
        </header>

        <section class="modal-card-body">
          <?php if (!empty($adminError)): ?>
            <div class="notification is-danger is-light"><?= esc($adminError) ?></div>
          <?php endif; ?>

          <form method="post" action="<?= site_url("admin") ?>">
            <?= csrf_field() ?>
            <div class="field">
              <label class="label">Username</label>
              <div class="control">
                <input class="input" type="text" name="username" required />
              </div>
            </div>

            <div class="field">
              <label class="label">Password</label>
              <div class="control">
                <input class="input" type="password" name="password" required />
              </div>
            </div>

            <div class="field has-text-centered">
              <button class="button is-rounded btn-outline btn-cta" type="submit">Sign In</button>
            </div>
          </form>
        </section>
      </div>

      <button class="modal-close is-large" aria-label="close"></button>
    </div>

    <script>
      /**
       * Initialize navbar and modal interactions.
       * @returns {void}
       */
      document.addEventListener("DOMContentLoaded", () => {
        // Toggle the Bulma burger menu on mobile.
        const burgers = Array.prototype.slice.call(document.querySelectorAll(".navbar-burger"), 0);
        burgers.forEach((burger) => {
          burger.addEventListener("click", () => {
            const targetId = burger.dataset.target;
            const target = targetId ? document.getElementById(targetId) : null;
            burger.classList.toggle("is-active");
            if (target) {
              target.classList.toggle("is-active");
            }
          });
        });

        /**
         * Wire open/close handlers for all modal triggers.
         * @returns {Array<{ modal: HTMLElement, closeModal: () => void }>}
         */
        const wireModals = () => {
          const modalButtons = Array.prototype.slice.call(document.querySelectorAll("[data-modal-target]"), 0);
          const controllers = [];

          modalButtons.forEach((button) => {
            const targetId = button.getAttribute("data-modal-target");
            if (!targetId) {
              return;
            }
            const modal = document.getElementById(targetId);
            if (!modal) {
              return;
            }

            const closeEls = modal.querySelectorAll(".modal-background, .modal-close, .delete, [data-modal-close]");

            // Show the modal and lock background scroll.
            const openModal = (event) => {
              if (event && event.preventDefault) {
                event.preventDefault();
              }
              modal.classList.add("is-active");
              document.documentElement.classList.add("is-clipped");
            };

            // Hide the modal and unlock background scroll.
            const closeModal = () => {
              modal.classList.remove("is-active");
              document.documentElement.classList.remove("is-clipped");
            };

            button.addEventListener("click", openModal);
            closeEls.forEach((el) => el.addEventListener("click", closeModal));

            controllers.push({ modal, closeModal });
          });

          return controllers;
        };

        const modalControllers = wireModals();

        const adminModal = document.getElementById("adminLoginModal");
        const shouldOpenAdmin = window.location.hash === "#admin-login" || <?= !empty($adminError) ? "true" : "false" ?>;
        if (adminModal && shouldOpenAdmin) {
          adminModal.classList.add("is-active");
          document.documentElement.classList.add("is-clipped");
        }

        // Close any open modal on Escape for accessibility.
        document.addEventListener("keydown", (event) => {
          if (event.key !== "Escape") {
            return;
          }
          modalControllers.forEach((controller) => {
            if (controller.modal.classList.contains("is-active")) {
              controller.closeModal();
            }
          });
        });

      });
    </script>


<?= $this->endSection() ?>
