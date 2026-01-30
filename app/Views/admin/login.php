<?php
/**
 * Admin login view.
 *
 * @return void
 */
?>
<?= $this->extend("layouts/admin") ?>
<?= $this->section("content") ?>

<section class="section admin-section">
  <div class="container">
    <div class="modal is-active admin-modal">
      <div class="modal-background"></div>
      <div class="modal-card admin-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Login</p>
        </header>
        <section class="modal-card-body">
          <?php $error = session()->getFlashdata("error"); ?>
          <?php if (!empty($error)): ?>
            <div class="notification is-danger is-light"><?= esc($error) ?></div>
          <?php endif; ?>

          <form method="post" action="/admin">
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
    </div>
  </div>
</section>

<?= $this->endSection() ?>
