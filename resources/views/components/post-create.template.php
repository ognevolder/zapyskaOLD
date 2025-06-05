<main>
  <!-- Bradcrumbs -->
  <figure class="mt-[6.4rem] text-[2.4rem] text-[#025939] font-[500] font-[Nunito]">
    <span><a href="/profile"><?= \Core\Session::getValue('user', 'name') ?></a></span>
    <span>-></span>
    <span>СТВОРЕННЯ</span>
  </figure>
  <!-- Info -->
  <p class="w-[95.6rem] mt-[3.6rem] mb-[6.4rem] font-[200] font-[Nunito] text-[2rem] text-[#262626]">
    Створення нової публікації або історії. Будь ласка, оберіть відповідний варіант з випадаючого меню нижче.
    Якщо ви впевнені в тексті публікації, то, натиснувши на <strong>“Опублікувати”</strong> ви автоматично збережете запис
    у базу даних й текст стане публічно доступним на головній сторінці. У випадку,
    якщо ви не хочете робити текст публічним, то залиште відмітку біля поля <strong>“Приватно”</strong>,
    а якщо не встигли дописати, то можете зберегти в <strong>“Чернетки”</strong> для подальшого редагування.
  </p>
  <form class="flex flex-col gap-[1.6rem]" action="/post/create" method="POST">
    <!-- Title input -->
    <div class="flex gap-[1.6rem]">
      <input class="w-[95.6rem] p-[1.6rem] bg-[#fff] border border-[#BFBA73] text-[#BFBA73] text-[2.8rem] font-[Nunito] font-[500]" type="text" name="post-title" placeholder="Заголовок публікації">
      <div class="flex flex-col gap-[1.6rem]">
        <p class="text-[2rem] text-[#BFBA73] font-[Nunito] font-[200]">Не більше 128 символів</p>
        <?php if (isset($errors)) : ?>
          <p class="text-[2rem] text-[#f35353] font-[Nunito] font-[500]"><?= $errors['title'] ?? '' ?></p>
        <?php endif; ?>
      </div>
    </div>
    <!-- Body input -->
    <div class="flex gap-[1.6rem]">
      <textarea class="w-[95.6rem] p-[1.6rem] bg-[#fff] border border-[#BFBA73] text-[#BFBA73] text-[2.8rem] font-[Nunito] font-[500]" rows="7" name="post-body" placeholder="Текст"></textarea>
      <div class="flex flex-col gap-[1.6rem]">
        <p class="text-[2rem] text-[#BFBA73] font-[Nunito] font-[200]">Не більше 128 символів</p>
        <?php if (isset($errors)) : ?>
          <p class="text-[2rem] text-[#f35353] font-[Nunito] font-[500]"><?= $errors['body'] ?? '' ?></p>
        <?php endif; ?>
      </div>
    </div>
    <!-- Tag input -->
    <div class="flex gap-[1.6rem]">
      <input class="w-[95.6rem] p-[1.6rem] bg-[#fff] border border-[#BFBA73] text-[#BFBA73] text-[2.8rem] font-[Nunito] font-[500]" type="text" name="post-tag" placeholder="Таг">
      <div class="flex flex-col gap-[1.6rem]">
        <p class="text-[2rem] text-[#BFBA73] font-[Nunito] font-[200]">Не більше 128 символів</p>
        <?php if (isset($errors)) : ?>
          <p class="text-[2rem] text-[#f35353] font-[Nunito] font-[500]"><?= $errors['tag'] ?? '' ?></p>
        <?php endif; ?>
      </div>
    </div>
    <!-- Submit action-buttons -->
    <div class="flex gap-[1.6rem] mt-[1.6rem]">
      <button class="py-[1.2rem] px-[1.6rem] border border-[#BFBA73] text-[1.6rem] text-[#BFBA73] font-[Nunito] font-[500] cursor-pointer" type="submit" formaction="/post/draft">Чернетка</button>
      <button class="py-[1.2rem] px-[1.6rem] text-[1.6rem] text-[#fff] bg-[#025939] font-[Nunito] font-[500] cursor-pointer" type="submit">Опублікувати</button>
      <div class="flex gap-[0.8rem] items-center">
        <input type="checkbox" id="privacy" name="privacy">
        <label class="font-[Nunito] text-[#262626] text-[1.6rem] font-[400]" for="privacy">Приватно</label>
      </div>
    </div>
  </form>
</main>