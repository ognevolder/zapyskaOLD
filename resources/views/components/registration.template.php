<figure class="h-screen flex flex-col gap-[6.4rem] justify-center items-center font-[Nunito]">
  <div class="flex flex-col gap-[3.2rem] items-center">
    <a href="/">
      <h2 class="font-[Pacifico] font-normal text-[19.2rem] text-[#025939] leading-none">Записька</h2>
    </a>
    <hr class="w-[60%] border-[#A69281]">
    <p class="font-extralight text-[#A69281] text-[3.2rem]">РЕЄСТРАЦІЯ</p>
  </div>

  <form class="w-[50%] flex flex-col gap-[2.4rem] items-start text-[2.4rem] font-thin text-[#A69281]" method="POST">
    <div class="w-[100%] flex flex-col gap-[0.8rem]">
      <label class="text-[1.6rem] font-thin text-[#A69281] leading-none" for="name">Введіть імʼя (Прізвище - за вибором):</label>
      <input 
      class="h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]" 
      id="name" 
      type="text" 
      placeholder="Імʼя (Прізвище)">
    </div>

    <div class="w-[100%] flex flex-col gap-[0.8rem]">
      <label class="text-[1.6rem] font-thin text-[#A69281] leading-none" for="password">Введіть пароль (Мінімум 6 символів):</label>
      <input 
      class="h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]" 
      id="password" 
      type="text" 
      placeholder="Пароль">
    </div>

    <div class="w-[100%] flex flex-col gap-[0.8rem]">
      <label class="text-[1.6rem] font-thin text-[#A69281] leading-none" for="login">Введіть логін (Використовуватиметься для авторизації):</label>
      <input 
      class="h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]" 
      id="login" 
      type="text" 
      placeholder="Логін">
    </div>

    <div class="w-[100%] flex flex-col gap-[0.8rem]">
      <label class="text-[1.6rem] font-thin text-[#A69281] leading-none" for="role">Ваша посада (Головна редакторка, Адміністратор тощо):</label>
      <input 
      class="h-[4.8rem] py-[0.8rem] px-[1.6rem] bg-white border border-[#BFBA73]" 
      id="role" 
      type="text" 
      placeholder="Посада">
    </div>
    
    <div>
      <button class="py-[0.8rem] px-[1.6rem] bg-[#A69281] font-normal text-[2.4rem] text-[#FFFDF7]" type="submit">СТВОРИТИ</button>
    </div>
  </form>
</figure>
