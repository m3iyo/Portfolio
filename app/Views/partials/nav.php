<?php
/**
 * Primary navigation bar.
 *
 * @return void
 */
?>
<nav class="navbar custom-navbar" role="navigation" aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item brand-text" href="#top">m3iyo</a>

      <a
        role="button"
        class="navbar-burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="mainNavbar"
      >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="mainNavbar" class="navbar-menu">
      <div class="navbar-end">
        <a class="navbar-item" href="#skills">skills</a>
        <a class="navbar-item" href="#projects">projects</a>
        <a class="navbar-item" href="#cta">contacts</a>
        <a class="navbar-item" href="#education">education</a>
        <?php if (!empty($isAdmin)): ?>
          <a class="navbar-item" href="<?= site_url("admin/dashboard") ?>">admin</a>
          <a class="navbar-item" href="<?= site_url("admin/logout") ?>">logout</a>
        <?php else: ?>
          <a class="navbar-item" href="#admin-login" data-modal-target="adminLoginModal" aria-label="Admin login">
            <svg
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.75"
              stroke-linecap="round"
              stroke-linejoin="round"
              aria-hidden="true"
            >
              <path d="M20 21c0-4.418-3.582-8-8-8s-8 3.582-8 8" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<div id="top" class="page-top-spacer"></div>
