<figure class="h-screen flex flex-col gap-[6.4rem] justify-center items-center font-[Nunito]">
  <div class="flex flex-col gap-[3.2rem] items-center">
    <a href="/">
      <h2 class="font-[Pacifico] font-normal text-[19.2rem] text-[#025939] leading-none">Записька</h2>
    </a>
    <hr class="w-[60%] border-[#A69281]">
    <p class="font-extralight text-[#A69281] text-[3.2rem]">РЕЄСТРАЦІЯ</p>
  </div>

  <form class="w-[50%] flex flex-col gap-[2.4rem] items-start text-[2.4rem] font-thin text-[#A69281]" method="POST">
    <!-- Hidden input with CSRF-token -->
    <?php \Core\Csrf::insertToken(); ?>

    <div class="w-[100%] flex flex-col gap-[0.8rem]">
      <label class="text-[1.8rem] font-thin text-[#A69281] leading-none" for="name">Введіть <strong>імʼя</strong> (Прізвище - за вибором):</label>
      <input
      class="h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]"
      id="name"
      name="user_name"
      value="<?= $old['user_name'] ?? null ?>";
      type="text"
      placeholder="Імʼя (Прізвище)">
      <?php if (isset($errors['user_name'])) : ?>
        <p class="text-[#c55c55] text-[1.8rem] font-bold"><?= $errors['user_name'] ?></p>
      <?php endif; ?>
    </div>

    <div class="w-[100%] flex flex-col gap-[0.8rem]">
      <label
      class="text-[1.8rem] font-thin text-[#A69281] leading-none"
      for="password">Введіть <strong>пароль</strong> (Мінімум 6 символів):
      </label>
      <input
      class="h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]"
      id="password"
      name="user_password"
      type="password"
      placeholder="Пароль">
      <?php if (isset($errors['user_password'])) : ?>
        <p class="text-[#c55c55] text-[1.8rem] font-bold"><?= $errors['user_password'] ?></p>
      <?php endif; ?>
    </div>

    <div class="w-[100%] flex flex-col gap-[0.8rem]">
      <label
      class="text-[1.8rem] font-thin text-[#A69281] leading-none"
      for="login">Введіть <strong>логін</strong> (Для авторизації):
      </label>
      <input
      class="h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]"
      id="login"
      name="user_login"
      value="<?= $old['user_login'] ?? null ?>"
      type="text"
      placeholder="Логін">
      <?php if (isset($errors['user_login'])) : ?>
        <p class="text-[#c55c55] text-[1.8rem] font-bold"><?= $errors['user_login'] ?></p>
      <?php endif; ?>
    </div>

    <div>
      <button class="py-[0.8rem] px-[1.6rem] bg-[#A69281] font-normal text-[2.4rem] text-[#FFFDF7]" type="submit">СТВОРИТИ</button>
    </div>
    <?php if (isset($dbErrors)) : ?>
      <p class="text-[#c55c55] text-[1.8rem] font-bold"><?= $dbErrors ?></p>
    <?php endif; ?>
  </form>
</figure>
