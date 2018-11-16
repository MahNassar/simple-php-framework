<?php

// print_r($data['models']);die;

use core\helpers\StringHelper;

include(VIEWS . "/header.php");
?>

<div class="container">
  <?php if ($article = $data['model']) : ?>
      <div class="row">
        <p><?= $article['created_at'] ?></p>
      </div>
      <div class="row">
        <p><?= $article['title'] ?></p>
      </div>
      <div class="row">
        <img src="<?= $article['image'] ? $article['image'] : 'https://via.placeholder.com/400C/O%20https://placeholder.com/' ?>" class="img-thumbnail">
        <br>
        <?= $article['content'] ?>
        <br><br><br>
      </div>
      <div class="row">
        <p>Author: <?= $article['author_name'] ?></p>
      </div>
  <?php endif; ?>
</div>

<?php include(VIEWS . "/footer.php");?>