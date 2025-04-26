<?php

use Core\Router;

?>
<article class="my-[3.2rem] grid grid-cols-2 gap-[1.6rem]">
  <?php foreach ($posts as $post) : ?>
    <?php Router::component('post', ['post' => $post, 'authors' => $authors]) ?>
  <?php endforeach; ?>
</article>


