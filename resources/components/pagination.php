<?php if ($paginator->totalPages > 1): ?>
  <nav class="flex justify-center mt-8">
    <ul class="inline-flex -space-x-px text-sm">
      
      <?php if ($paginator->hasPrev()): ?>
        <li>
          <a href="?page=<?= $paginator->currentPage - 1 ?>" 
             class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
            &laquo;
          </a>
        </li>
      <?php endif; ?>

      <?php
        $pages = $paginator->pages();
        if ($pages[0] > 1) {
          echo '<li><a href="?page=1" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a></li>';
          echo '<li><span class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300">...</span></li>';
        }
      ?>

      <?php foreach ($pages as $p): ?>
        <li>
          <a href="?page=<?= $p ?>" 
             class="px-3 py-2 leading-tight border border-gray-300 <?= $p == $paginator->currentPage 
                  ? 'text-white bg-[#BFBA73]' 
                  : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700' ?>">
            <?= $p ?>
          </a>
        </li>
      <?php endforeach; ?>

      <?php
        if (end($pages) < $paginator->totalPages) {
          echo '<li><span class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300">...</span></li>';
          echo '<li><a href="?page=' . $paginator->totalPages . '" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">' . $paginator->totalPages . '</a></li>';
        }
      ?>

      <?php if ($paginator->hasNext()): ?>
        <li>
          <a href="?page=<?= $paginator->currentPage + 1 ?>" 
             class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
            &raquo;
          </a>
        </li>
      <?php endif; ?>

    </ul>
  </nav>
<?php endif; ?>