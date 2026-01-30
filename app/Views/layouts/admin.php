<?php
/**
 * Admin layout wrapper.
 *
 * @return void
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <?= $this->include("partials/header") ?>
    <link rel="stylesheet" href="<?= base_url("css/admin.css") ?>" />
  </head>
  <body>
    <?= $this->include("partials/admin_nav") ?>
    <?= $this->renderSection("content") ?>
    <script>
      /**
       * Toggle the admin navbar on mobile.
       * @returns {void}
       */
      document.addEventListener("DOMContentLoaded", () => {
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
      });
    </script>
  </body>
</html>
