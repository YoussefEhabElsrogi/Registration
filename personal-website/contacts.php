<?php require_once './layouts/head.php'; ?>
<?php require_once './core/functions.php' ?>
<?php require_once './core/validations.php' ?>

<?php
$fileName = './json/dataContact.json';
$dataInFileJson = file_get_contents($fileName);
$dataInFileArray = json_decode($dataInFileJson, true);

if (requireInput($dataInFileArray)):
  redirectPage('contact.php');
endif;
?>

<div class="container mt-4">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Message</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataInFileArray as $item): ?>
        <tr>
          <?php foreach ($item as $value): ?>
            <td>
              <?php echo $value; ?>
            </td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include './layouts/js.php'; ?>