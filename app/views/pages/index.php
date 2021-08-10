<?php require APPROOT . '/views/inc/header.php';?>
<?= flash('logged_in')?>
<div class="jumbotron jumbotron-fluid text-center">
  <div class="container">
      <h1 class=' display-4 '><?= $data['title'] ?> </h1>
    <p class="lead">
        <?=$data['description']?>
    </p>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>
