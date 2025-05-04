<figure class="h-screen flex flex-col gap-[6.4rem] justify-center items-center font-[Nunito]">
  <div class="flex flex-col gap-[3.2rem] items-center">
    <a href="/">
      <h2 class="font-[Pacifico] font-normal text-[19.2rem] text-[#025939] leading-none">Записька</h2>
    </a>
    <hr class="w-[60%] border-[#BFBA73]">
    <p class="font-extralight text-[#BFBA73] text-[3.2rem] leading-none">АВТОРИЗАЦІЯ</p>
  </div>

  <form 
  class="flex flex-col gap-[1.6rem] items-center text-[2.4rem] font-thin text-[#BFBA73]" 
  method="POST"
  action="/login"
  >
    <!-- Hidden input with CSRF-token -->
    <?php \Core\Csrf::insertToken(); ?>
  
    <input 
    class="w-[36rem] h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]"
    name="login" 
    type="text"
    placeholder="Логін">

    <input 
    class="w-[36rem] h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]"
    name="password"
    type="password" 
    placeholder="Пароль">

    <div>
      <button class="py-[0.8rem] px-[1.6rem] bg-[#BFBA73] font-normal text-[2.4rem] text-[#FFFDF7]">ВХІД</button>
    </div>
  </form>

  <div class="flex gap-[0.8rem] text-[1.6rem] text-[#BFBA73] font-light">
    <p>Ще не зареєстрували профіль?</p>
    <span class="text-[#025939]"><a class="" href="/registration">Реєстрація</a></span>
  </div>
</figure>