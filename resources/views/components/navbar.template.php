<nav class="mt-[6.4rem] py-[1.6rem] border-[1px] border-transparent border-y-[#BFBA73]">
  <ul class="flex gap-[24px] justify-center font-[Nunito] font-extralight text-[#BFBA73] text-[3.2rem] uppercase">
    <li class="hover:text-[#025939] active:text-[#025939]"><a href="/">Головна</a></li>
    <li class="hover:text-[#025939] active:text-[#025939]"><a href="/posts">Публікації</a></li>
    <li class="hover:text-[#025939] active:text-[#025939]"><a href="/stories">Історії</a></li>
    <li class="hover:text-[#025939] active:text-[#025939]"><a href="/art">Творчість</a></li>
    <li class="hover:text-[#025939] active:text-[#025939]"><a href="/profile"><?= $user['name'] ?? 'Профіль' ?></a></li>
  </ul>
</nav>