<?php

use Core\Router;
?>

<?php Router::component('head-open.php') ?>

<figure class="h-screen flex flex-col justify-center items-center gap-[6.4rem]">
  <div>
    <h2 class="font-[Nunito] font-[600] text-[4.8rem] text-[#BFBA73]">От халепа...</h2>
  </div>
    
  <div class="flex flex-col">
    <h1 class="font-[Nunito] font-[800] text-[19.2rem] text-[#025939] leading-[19.2rem]">404</h1>
    <h3 class="font-[Nunito] font-[300] text-[3.6rem] text-[#BFBA73]">Загубилася сторінка</h3>
  </div>
</figure>

<?php Router::component('head-close.php') ?>