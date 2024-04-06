<?php require_once './layouts/head.php' ?>
<?php require_once './core/functions.php' ?>
<?php require_once './core/validations.php' ?>

<?php
$fileName = './json/dataProject.json';
$dataInFileJson = file_get_contents($fileName);
$dataInFileArray = json_decode($dataInFileJson, true);

if (requireInput($dataInFileArray)):
  redirectPage('project.php');
endif;
?>
<div class="d-flex flex-column h-100 bg-light">
  <main class="flex-shrink-0">
    <!-- Navigation-->
    <?php require_once './layouts/nav.php' ?>
    <!-- Projects Section-->
    <section class="py-5">
      <div class="container px-5 mb-5">
        <div class="text-center mb-5">
          <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Projects</span></h1>
        </div>
        <div class="row gx-5 justify-content-center">
          <div class="col-lg-11 col-xl-9 col-xxl-8">
            <!-- Project Card 1-->
            <?php foreach ($dataInFileArray as $item): ?>
              <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                <div class="card-body p-0">
                  <div class="d-flex align-items-center">
                    <div class="p-5">
                      <h2 class="fw-bolder">
                        <?php echo $item['name'] ?>
                      </h2>
                      <p>
                        <?php echo $item['description'] ?>
                      </p>
                    </div>
                    <img class="img-fluid" src="<?php echo './images/' . $item['nameImage'] ?>"
                      alt="The imgae didn't upad">
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- Call to action section-->
    <section class="py-5 bg-gradient-primary-to-secondary text-white">
      <div class="container px-5 my-5">
        <div class="text-center">
          <h2 class="display-4 fw-bolder mb-4">Let's build something together</h2>
          <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="contact.php">Contact me</a>
        </div>
      </div>
    </section>
  </main>
  <!-- Footer-->
  <?php require_once './layouts/footer.php' ?>
</div>
<!-- Bootstrap core JS-->
<?php require_once './layouts/js.php' ?>