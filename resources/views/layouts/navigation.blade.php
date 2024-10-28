<nav x-data="{ open: false }" class="bg-stone-800 text-white border-b border-stone-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="https://eastgateshoppingcentre.com/wp-content/uploads/2023/08/maccies.png" 
                            alt="Logo McDonald's" class="block h-14 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('productos.index')" :active="request()->routeIs('productos.index')">
                        {{ __('Menú') }}
                    </x-nav-link>
                    <x-nav-link :href="route('addresses.index')" :active="request()->routeIs('addresses.*')">
                        {{ __('Mis Direcciones') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sucursales.index')" :active="request()->routeIs('sucursales.*')">
                        {{ __('Sucursales') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pedidos.index')" :active="request()->routeIs('pedidos.index')">
                        {{ __('Mis Pedidos') }}
                    </x-nav-link>
                    <!-- Nuevo enlace para el formulario de contacto -->
                    <x-nav-link :href="route('contacto.create')" :active="request()->routeIs('contacto.create')">
                        {{ __('Contacto') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown and Cart Icon -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Ícono del Carrito -->
                <a href="{{ route('cart.show') }}" class="flex items-center mr-4">
                    <img src="/images/cart.png" alt="Carrito" class="h-8 w-8"> <!-- Ícono de carrito -->
                </a>

                <!-- Settings Dropdown -->
                @if(Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-stone-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="bg-yellow-400 text-black font-bold px-6 py-2 rounded-full shadow-md">
                        Iniciar sesión
                    </a>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-stone-700 focus:outline-none focus:bg-stone-700 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('productos.index')" :active="request()->routeIs('productos.index')">
                {{ __('Menú') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('addresses.index')" :active="request()->routeIs('addresses.*')">
                {{ __('Mis Direcciones') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sucursales.index')" :active="request()->routeIs('sucursales.index')">
                {{ __('Encontrar Sucursal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pedidos.index')" :active="request()->routeIs('pedidos.index')">
                {{ __('Mis Pedidos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contacto.create')" :active="request()->routeIs('contacto.create')">
                {{ __('Contacto') }}
            </x-responsive-nav-link>

            <!-- Ícono del Carrito en la Vista Móvil -->
            <x-responsive-nav-link :href="route('cart.show')">
                <img src="/images/cart.png" alt="Carrito" class="h-8 w-8 inline-block"> Carrito
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-stone-700">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-stone-400">{{ Auth::user()->email }}</div>
                </div>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}" class="bg-yellow-400 text-black font-bold px-6 py-2 rounded-full shadow-md">
                        Iniciar sesión
                    </a>
                </div>
            @endauth

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
