<header x-data="{ cartOpen: false, mobileSearchOpen: false, mobileMenuOpen: false }" class="fixed z-50 top-0 w-full shadow-sm shadow-black">
    <nav>
        <div class="mx-0 lg:mx-16 h-full justify-between flex">
            <div>
                <div class="flex w-[330px] xl:w-[760px] whitespace-nowrap">
                    <!--Humburgar button-->
                    <div class="ml-5 lg:ml-0 block xl:hidden">
                    <i 
                    class="fa-solid fa-bars absolute top-7 text-white text-5xl cursor-pointer"
                    @click="mobileMenuOpen = true"
                    ></i>

                    </div>

                    <a href="{{ route('welcome') }}">
                        <div class="flex items-center mr-3">
                            <img src="{{ asset('storage/24f7/24f7.png') }}" class="logo" alt="Logo">
                            <div class="branding">
                                <h1 class="font-bold text-6xl">24f7</h1>
                                <h2 class="font-base text-sm text-end">Air Conditioner</h2>
                            </div>
                        </div>
                    </a>
                    

                    
                    
                    <div class="selector ml-6">
                        <!-- Brands Dropdown -->
                        <div class="group relative">
                            <a href="#">Brands <i class="fa-solid fa-chevron-down text-xs"></i></a>
                            <div class="absolute hidden group-hover:flex flex-col bg-white text-black mt-2 shadow-lg rounded-md py-2 w-40 z-10">
                            <div class="absolute -top-2 left-16 transform -translate-x-1/2 w-4 h-4 bg-white rotate-45"></div>.
                            <a href="{{ route('users.orders.index') }}" class="hover:bg-[#3c88f8] text-[#3c88f8] hover:text-white px-4 py-2">All Brands</a>
                            <a href="{{ url('/users/orders?brand=Carrier') }}" class="hover:bg-[#3c88f8] text-[#3c88f8] hover:text-white px-4 py-2">Carrier</a>
                            <a href="{{ url('/users/orders?brand=Daikin') }}" class="hover:bg-[#3c88f8] text-[#3c88f8] hover:text-white px-4 py-2">Daikin</a>
                            <a href="{{ url('/users/orders?brand=Midea') }}" class="hover:bg-[#3c88f8] text-[#3c88f8] hover:text-white px-4 py-2">Midea</a>
                            </div>
                        </div>

                        <!-- servces with Tooltip -->
                        <div class="relative group">
                            <a href="#">Services</a>
                            <div class="absolute left-1/2 -translate-x-1/2 mt-6 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap delay-1000">
                            Cleaning and Repairing
                            </div>
                        </div>

                        <!-- Support with Tooltip -->
                        <div class="relative group">
                            <a href="{{ url('about') }}">About Us</a>
                            <div class="absolute left-1/2 -translate-x-1/2 mt-6 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap delay-1000">
                            About Us
                            </div>
                        </div>

                        <!-- Store Locator with Tooltip -->
                        <div class="relative group">
                            <a href="{{ route('users.store.locator') }}">Store Locator</a>
                            <div class="absolute left-1/2 -translate-x-1/2 mt-6 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap delay-1000">
                            Store Locator
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <script src="//unpkg.com/alpinejs" defer></script>

            <!-- right part-->

            <div class="flex items-center gap-6 w-[600px]">
<form action="{{ route('users.orders.index') }}#products" method="GET" class="w-full hidden sm:block relative">
    <i class="fas fa-search absolute pl-3 py-3 text-[#FF7700]"></i>
    <input 
        type="search" 
        name="query" 
        placeholder="Search a product" 
        class="w-full rounded-2xl pl-8 h-full focus:outline-none focus:ring-0"
        value="{{ request('query') }}"
    >
</form>


                <div class="flex flex-col h-full w-full place-content-center items-center xl:items-start whitespace-nowrap">
                   @auth 
                   <div class="hidden xl:flex items-center mb-1">
                    <!-- Welcome text with dropdown -->
                    <x-dropdown align="right" width="40">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center text-white transition  ease-in-out duration-150">
                                <h1 class="flex items-center gap-2">
                        Welcome, 
                                </h1>
                                    <div class="ms-5 flex hover:text-[#FF7700] items-center">
                                        <div class="mr-1">{{ ucfirst(Auth::user()->first_name )}}</div>
                                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                    <i class="fa-solid fa-user pl-16 text-[24px] hover:text-[#FF7700]"></i>
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('users.profile.order.history')">
                                    {{ __('Orders') }}
                                    <i class="fa-solid fa-receipt pl-16 text-[24px] hover:text-[#FF7700]"></i>
                                </x-dropdown-link>
                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                        <i class="fa-solid fa-right-from-bracket pl-[53px] text-[24px] hover:text-[#FF7700]"></i>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </h1>
                </div>
                
                
                    @endauth
                    
                    <div class="flex gap-5 sm:gap-10 lg:gap-0">
                        <i class="fas fa-search block sm:hidden text-[24px] text-white hover:text-[#FF7700] cursor-pointer"
                            @click="mobileSearchOpen = !mobileSearchOpen"></i>
                            @if (Route::has('login'))
                            <div class="flex">
                                    @auth
                                        <h1 class="flex gap-3 text-white hover:text-[#FF7700] cursor-pointer">
                                        <a href="{{ url('/welcome') }}"><i class="fa-solid fa-house text-[24px]"></i>
                                        <a href="{{ url('/welcome') }}" class="hidden lg:block mr-10">
                                                Home </a>
                                        </h1>
                                    @else
                                        <div class="text-white hover:text-[#FF7700] flex gap-3">
                                        <a href="{{ route('login') }}" > <i class=" fa-solid fa-user text-[24px] mr-3 lg:mr-0"></i></a>
                                        <a
                                             href="{{ route('login') }}"
                                            class="hidden lg:block"
                                        >
                                            Log in  
                                        </a>

                                        @if (Route::has('register'))
                                            <span class="hidden lg:block mr-0">/</span>
                                        <a
                                            href="{{ route('register') }}"
                                            class=" hidden lg:block mr-2">
                                            Register
                                        </a>
                                        @endif
                                    @endauth
                            @endif
                                    </div>
                                        @auth
                                            <a href="{{ route('users.cart.index') }}" class="flex items-center gap-2 text-white hover:text-[#FF7700] cursor-pointer">
                                                <i class="fa-solid fa-cart-shopping text-[24px]"></i>
                                                <span class="relative">
                                                    <h1 class="hidden md:block">My Cart</h1>
                                                    <!-- The badge that will display the cart item count -->
                                                    <span id="cart-count-badge" class="absolute -top-3 -right-6 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center hidden">
                                                        0
                                                    </span>
                                                </span>
                                            </a>
                                        @endauth

                                    
                                    
                                    
                                </div>

                    </h1>
                    </div>            
                </div>
            </div>
            <!-- end of right part-->
        </div>

        <!-- Funtion for search bar mobile -->
            <div x-show="mobileSearchOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-5"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-5"
            class="sm:hidden bg-[#3c88f8] shadow-md px-4 py-3"
            style="display: none;">
            <form action="{{ route('users.orders.index') }}#products" method="GET" class="flex items-center">
                <i class="fas fa-search absolute left-7 text-[#FF7700] mr-2"></i>
                <input type="search"
                name="query"
                    placeholder="Find your next must have..."
                    class="w-full border border-gray-300 rounded-2xl px-8 py-2 focus:outline-none focus:ring-0"
                    value="{{ request('query') }}" />
            </form>
            </div>
             

            <!-- Backdrop for mobile menu -->
            <div 
                x-show="mobileMenuOpen"
                x-transition.opacity
                class="fixed inset-0 bg-black bg-opacity-50 z-40"
                @click="mobileMenuOpen = false"
                style="display: none;">
            </div>

            <!-- Mobile Slide-in Menu -->
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed top-0 left-0 h-full w-[250px] bg-[#3c88f8] z-50 transform"
                @click.outside="mobileMenuOpen = false"
                style="display: none;"
            >
            <div class="flex flex-col gap-6 py-6 text-white text-lg">
                <div class="flex flex-col">
                    
                    <div class="flex items-center">
                        <h1 class="pl-6">Welcome,</h1>
                        @auth
                        <div class="font-medium text-base ms-2 text-white">{{ Auth::user()->name }}</div>
                    </div>
                        <div class=" pl-6 font-light text-sm text-white">{{ Auth::user()->email }}</div>
                        
                </div>
                
                <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                    <i class="fa-solid fa-user pl-[120px] text-[24px] hover:text-[#FF7700] "></i>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('users.profile.order.history')">
                    {{ __('Orders') }}
                    <i class="fa-solid fa-receipt pl-[120px] text-[24px] hover:text-[#FF7700]"></i>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                        <i class="fa-solid fa-right-from-bracket pl-[107px] text-[24px] hover:text-[#FF7700]"></i>
                    </x-responsive-nav-link>
                </form>
                @endauth
            </div>
                <div class="border rounded-md py-6 mx-6 px-7 flex gap-7 mb-5">
                            
                                <div class="relative group ">
                                    <a href="{{ url('about') }}"><i class="fa-solid fa-headset text-5xl border rounded-md shadow-lg px-1"></i></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 mt-6 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap delay-1000">
                                    About Us
                                    </div>
                                </div>
                                <div class="relative group">
                                    <a href="{{ route('users.store.locator') }}"><i class="fa-solid fa-store text-5xl border rounded-md shadow-lg"></i></a>
                                    <div class="absolute left-1/2 -translate-x-1/2 mt-6 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap delay-1000">
                                    Store Locator
                                    </div>
                                </div>
                </div>
                <hr class="w-full">
                <div class="flex flex-col">
                <a href="#" class="font-bold px-6 my-2">Brands</a>
                        <a href="{{ route('users.orders.index') }}" class="ml-6 pl-4 py-2 hover:bg-blue-500">All Brands</a>
                        <a href="{{ url('/users/orders?brand=Carrier') }}" class="ml-6 pl-4 py-2 hover:bg-blue-500">Carrier</a>
                        <a href="{{ url('/users/orders?brand=Daikin') }}" class="ml-6 pl-4 py-2 hover:bg-blue-500">Daikin</a>
                        <a href="{{ url('/users/orders?brand=Midea') }}" class="ml-6 pl-4 py-2 hover:bg-blue-500">Midea</a>
                </div>
                <hr class="w-full">
                <div class="flex flex-col">
                <a href="#" class="font-bold px-6 my-2">Services</a>
                    <a href="#" class="ml-6 pl-4 py-2 hover:bg-blue-500">Cleaning</a>
                    <a href="#" class="ml-6 pl-4 py-2 hover:bg-blue-500">Repairing</a>
                </div>
            </div>
        </div>

    </nav>
  
</header>