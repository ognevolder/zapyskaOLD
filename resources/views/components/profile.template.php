<figure id="username-section">
  <span id="username-display"><?= $user['name'] ?></span>
  <button id="edit-username-btn">Редагувати</button>

  <?php if (\Core\Session::getValue('user', 'admin') == 1) : ?>
    <a href="/admin">Адмін-панель</a>
  <?php endif; ?>

  <?php if (\Core\Session::hasValue('user')) : ?>
    <form action="/session/destroy" method="POST">
      <input type="hidden" name="_method" value="DELETE">
      <button>Вийти</button>
    </form>
  <?php endif; ?>

  <form id="username-form" style="display: none;" method="POST" action="/<?= $user['login_name'] ?>/edit">
    <?php \Core\Csrf::insertToken() ?>
    <input type="hidden" name="_method" value="PATCH">
    <input type="text" name="user_name" id="username-input" value="<?= $user['name'] ?>" required>
    <button type="submit">Зберегти</button>
  </form>
  <?php if (isset($errors['user_name'])) : ?>
    <p class="text-[#c55c55] text-[1.8rem] font-bold"><?= $errors['user_name'] ?></p>
  <?php endif; ?>
</figure>

