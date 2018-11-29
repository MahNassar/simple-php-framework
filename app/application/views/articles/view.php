<?php

use core\helpers\session\Auth;
use core\helpers\StringHelper;

include(VIEWS . "/header.php");
?>

<div class="container">
  <?php if ($article = $data['model']) : ?>
      <div class="row">
        <div class="col-md-6">
          <p><?= $article['created_at'] ?></p>
        </div>
        <div class="col-md-6">
          <?php if(Auth::isLogged() && $article['author_id'] == Auth::user()['id']): ?>
            <a type="button" class="btn btn-warning" href="/articles/edit/<?= $article['id'] ?>">update</a>
          <?php endif; ?>
        </div>
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