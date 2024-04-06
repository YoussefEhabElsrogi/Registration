<?php require_once './layouts/head.php' ?>
<?php require_once './core/sessions.php' ?>

<div class="container mt-5">
  <form action="./handelrs/handelProject.php" method="POST" enctype="multipart/form-data">
    <?php if (issetSession('auth')): ?> <!-- Check if success message exists in session -->
      <div class="alert alert-success col text-center"> <!-- Display success message -->
        <?php echo $_SESSION['auth']; ?>
      </div>
      <?php removeSession('auth'); endif; ?>
    <?php if (issetSession('errors')): ?>
      <?php foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger text-center display-6 " role="alert">
          <?php echo $error; ?>
        </div>
      <?php endforeach; ?>
      <?php removeSession('errors'); endif; ?>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="mb-3">
      <label for="des" class="form-label">Description</label>
      <input type="text" class="form-control" name="des" id="des">
    </div>
    <div>
      <input class="form-control form-control-lg" id="formFileLg" name="file" type="file">
    </div>
    <button type="submit" class="btn btn-primary mt-4">Submit</button>
  </form>

</div>

<?php require_once './layouts/js.php' ?>