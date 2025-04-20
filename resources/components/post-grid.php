<?php

use Core\Router;
?>
<article class="my-[3.2rem] flex gap-[1.8rem]">
  <?php foreach ($data as $post) : ?>
    <?php Router::component('post.php', ['post' => $post]) ?>
  <?php endforeach; ?>
</article>


