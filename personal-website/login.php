<?php require_once './layouts/head.php' ?>
<?php require_once './core/sessions.php' ?>

<div class="container mt-5">
  <div>
    <form action="./handelrs/handelLogin.php" method="POST">
      <div class="mb-3">
        <?php if (issetSession('errors')): ?>
          <?php foreach ($_SESSION['errors'] as $error): ?>
            <div class="alert alert-danger text-center display-6 " role="alert">
              <?php echo $error; ?>
            </div>
          <?php endforeach; ?>
          <?php removeSession('errors'); endif; ?>
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          value="youssefelsrogi@gmail.com">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="youssefehab">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<?php require_once './layouts/js.php' ?>