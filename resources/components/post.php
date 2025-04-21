<?php

use Core\App;
?>
<figure class="px-[5.6rem] border-[0.1rem] border-[#BFBA73] bg-[#fff]">
<!-- Date and tag -->
  <div class="my-[3.2rem] flex gap-[1.2rem]">
    <a href="#" class="font-[Nunito] text-[1.6rem] font-[200] text-[#BFBFBF]"><?= date_format(date_create($post['date']), "Y/m/d H:i") ?></a>
    <a href="#" class="font-[Nunito] text-[1.6rem] font-[200] text-[#BFBA73]">#<?= $post['tag'] ?></a>
  </div>
  
  <!-- Title and body -->
  <div class="flex flex-col gap-[0.8rem]">
    <a href="#">
      <h2 class="font-[Nunito] text-[3.6rem] font-[700] text-[#262626] leading-[4.2rem]">
        <?= mb_strimwidth($post['title'], 0, 53, '...') ?>
      </h2>
    </a>

    <p class="font-[Nunito] text-[1.8rem] font-[400] text-[#262626] leading-[2.4rem]">
      <?= mb_strimwidth($post['body'], 0, 192, '...') ?>
    </p>
  </div>
  
  <!-- Author -->
  <div class="my-[3.2rem] flex gap-[1.2rem]">
    <a href="#" class="font-[Nunito] text-[1.8rem] font-[600] text-[#025939]"><?= App::getAuthorForPost($post, $authors)['name'] ?></a>
    <span class="font-[Nunito] text-[1.8rem] font-[200] text-[#BFBFBF]"><?= App::getAuthorForPost($post, $authors)['role'] ?></span>
  </div>
</figure>