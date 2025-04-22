<?php

use Core\App;
?>
<figure class="px-[5.6rem] py-[4.8rem] bg-[#fff] border border-[#BFBA73] flex flex-col gap-[3.2rem] font-[Nunito] overflow-hidden">
  <!-- Дата + тег -->
  <div class="flex gap-[0.8rem] text-[1.6rem]">
    <a href="#"><span class="font-normal text-[#BFBA73]">#<?= $post['tag'] ?></span></a>
    <span class="font-light text-[#BFBFBF]"><?= date_format(date_create($post['date']), "Y/m/d - H:i") ?></span>
  </div>

  <!-- Заголовок і тіло -->
   <a href="#">
     <div class="flex flex-col gap-[0.8rem] text-[#262626] overflow-hidden">
       <h2 class="text-[3.6rem] font-bold leading-[4.2rem] break-words overflow-hidden">
         <?= mb_strimwidth($post['title'], 0, 70, '...') ?>
       </h2>
       <p class="text-[1.8rem] font-normal leading-[2.4rem] break-words overflow-hidden">
         <?= mb_strimwidth($post['body'], 0, 200, '...') ?>
       </p>
     </div>
   </a>

  <!-- Автор -->
  <div class="flex gap-[0.8rem] text-[1.8rem]">
    <a href="#"><span class="font-semibold text-[#025939]"><?= App::getAuthorForPost($post, $authors)['name'] ?></span></a>
    <span class="font-light text-[#BFBFBF]"><?= App::getAuthorForPost($post, $authors)['role'] ?></span>
  </div>
</figure>