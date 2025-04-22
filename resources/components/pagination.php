<?php if ($paginator->totalPages > 1): ?>
  <nav class="pagination flex justify-center my-[3.2rem] gap-[1.6rem] font-[Nunito] font-normal text-[3.2rem] text-[#BFBA73] text-center leading-none">

    <!-- Попередня сторінка -->
    <?php if ($paginator->currentPage > 1): ?>
      <a href="?page=<?= $paginator->currentPage - 1 ?>" class="px-[1.6rem] py-[0.8rem] border border-[#BFBA73] hover:border-[#025939] hover:text-[#025939]">
      ←
      </a>
    <?php endif; ?>

    <!-- Номери сторінок -->
    <?php foreach ($paginator->pages() as $page): ?>
      <a href="?page=<?= $page ?>" class="px-[1.6rem] py-[0.8rem] border <?= $page === $paginator->currentPage ? 'border-[#025939] text-[#025939]' : 'border-[#BFBA73]' ?>">
        <?= $page ?>
      </a>
    <?php endforeach; ?>

    <!-- Наступна сторінка -->
    <?php if ($paginator->currentPage < $paginator->totalPages): ?>
      <a href="?page=<?= $paginator->currentPage + 1 ?>" class="px-[1.6rem] py-[0.8rem] border border-[#BFBA73] hover:border-[#025939] hover:text-[#025939]">
      →
      </a>
    <?php endif; ?>

  </nav>
<?php endif; ?>