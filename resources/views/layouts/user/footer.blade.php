<footer class="bg-[#3c88f8] w-full">
  <div class="flex flex-col md:flex-row mx-10 md:mx-40     space-y-5 md:space-y-0 pt-20">
    <div class="flex flex-col space-y-1 w-full">
      <h1 class="font-bold text-2xl text-white pb-0 md:pb-5">HELP CENTER</h1>
      <a href="{{ route('faq') }}" class="content">FAQS</a>
      <a href="{{ route('private') }}" class="content">Privacy Policy</a>
      <a href="{{ route('terms') }}" class="content">Terms and Condition</a>
    </div>
    <div class="flex flex-col w-full">
      <h1 class="font-bold text-2xl text-white pb-0 md:pb-5">ABOUT 24F7 APLLIANCES</h1>
      <a href="{{ route('users.store.locator') }}" class="content">Store Locator</a>
      <a href="{{ url('about') }}" class="content">About Us</a>
      <a href="#" class="content">User Manual</a>
    </div>
    <div class="flex flex-col w-full">
      <h1 class="font-bold text-2xl text-white pb-0 md:pb-5">FOLLOW US HERE</h1>
      <div class="flex items-center gap-2 hover:text-[#FF7700]">
        <a href="https://www.facebook.com/24f7svc"> <i class="fa-brands fa-square-facebook text-3xl text-white  hover:text-[#FF7700]"></i></a>
        <a href="https://www.facebook.com/24f7svc" class="content">Facebook</a>
      </div>
    </div>
  </div>
  <div class="flex flex-col md:flex-row mx-10 md:mx-40 space-y-2 md:space-y-0 whitespace-nowrap py-10 text-white justify-between">
    <h1 class="text-sm">Copyright 2025. 24f7 Appliances. All Rights Reserved.</h1>
    <a href="{{ route('developer') }}" class="hover:underline">About The Developer
  </div>
</footer>