<div class="flex gap-[1.6rem]">
<!-- Side-panel -->
  <aside class="w-[34.8rem] h-screen bg-[#FFF] p-[6.4rem] flex flex-col gap-[3.2rem]">
    <img class="w-[16rem] h-[16rem] rounded-[50%] mb-[1.6rem]" src="#">
    <ul class="flex flex-col gap-[0.4rem] leading-none text-[#025939] font-[Nunito]">
      <li class="text-[3.2rem] font-[400]"><?= $user['name'] ?></li>
      <li class="text-[2.4rem] font-[200]">@<?= $user['login'] ?><li>
    </ul>
    <ul class="flex flex-col gap-[1.6rem] leading-none text-[#262626] text-[3.2rem] font-[200] font-[Nunito]">
      <li>
        <?php if (\Core\Session::getValue('user', 'admin') == 1) : ?>
          <a href="/admin">Адмін-панель</a>
        <?php endif; ?>
      </li>
      <li>Профіль</li>
      <li>Публікації</li>
      <li>Історії</li>
      <li>Чернетки</li>
      <li>Творчість</li>
      <li>
        <?php if (\Core\Session::hasValue('user')) : ?>
          <form action="/session/destroy" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <button class="cursor-pointer">Вийти</button>
          </form>
        <?php endif; ?>
      </li>
    </ul>
  </aside>

  <main class="w-full">
    <figure class="py-[3.2rem] px-[6.4rem] bg-[#fff] flex justify-between items-center">
      <ul>
        <li>
          <span>Публікації:<span>4</span></span>
        </li>
      </ul>
      <a class="px-[1.6rem] py-[0.8rem] text-[#FFFDF7] text-[2.4rem] font-[Nunito] font-[400] bg-[#025939]" href="/post/create">СТВОРЕННЯ</a>
    </figure>
  </main>
</div>


