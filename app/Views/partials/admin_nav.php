<?php
/**
 * Admin navigation bar.
 *
 * @return void
 */
?>
<nav class="navbar custom-navbar" role="navigation" aria-label="admin navigation">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item brand-text" href="<?= site_url("admin/dashboard") ?>">admin</a>

      <a
        role="button"
        class="navbar-burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="adminNavbar"
      >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="adminNavbar" class="navbar-menu">
      <div class="navbar-end">
        <a class="navbar-item" href="<?= site_url("/") ?>">view site</a>
        <a class="navbar-item" href="<?= site_url("admin/logout") ?>">logout</a>
      </div>
    </div>
  </div>
</nav>
