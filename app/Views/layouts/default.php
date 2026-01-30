<?php
/**
 * Base layout wrapper for the resume page.
 *
 * @return void
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
    /**
     * Render shared head metadata and styles.
     *
     * @return void
     */
    ?>
    <?= $this->include("partials/header") ?>
  </head>
  <body>
    <?php
    /**
     * Render the primary navigation.
     *
     * @return void
     */
    ?>
    <?= $this->include("partials/nav") ?>
    <?= $this->renderSection("content") ?>
  </body>
</html>
