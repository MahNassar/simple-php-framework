<?php

use core\helpers\StringHelper;
use core\helpers\session\Auth;

include(VIEWS . "/header.php");
?>

<div class="container">
<?php if ($data['models']) : ?>
    <?php foreach ($data['models'] as $index => $article) : ?>
      <div class="row">
        <div class="col-md-8">
          <p><a href="/articles/<?= $article['id'] ?>"><?= $article['created_at'] ?> - <?= $article['title'] ?></a></p>
          <p><?= StringHelper::truncate(strip_tags($article['content']), 1000) ?></p>
          <div class="row">
            <div class="col-md-6">
              Author: <?= $article['author_name'] ?>
            </div>
            <div class="col-md-6">
              comments : <?= $article['comments_count'] ?>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <a href="/articles/<?= $article['id'] ?>"><img src="<?= $article['image'] ? $article['image'] : 'https://via.placeholder.com/300C/O%20https://placeholder.com/' ?>" class="img-thumbnail"></a>
        </div>
      </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<?php include(VIEWS . "/footer.php");?>