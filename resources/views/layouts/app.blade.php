<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        <title>SocialLink - @yield('titulo')</title>
        @livewireStyles
    </head>

    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-3xl font-black">
                    SocialLink
                </a>

                @auth
                    <nav class="flex gap-2 items-center">
                        <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm
                        uppercase font-bold cursor-pointer" href="{{ route('posts.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Crear
                        </a>

                        <a class="font-bold text-gray-600 text-sm "
                           href="{{ route('posts.index', auth()->user()->username) }}"
                        >
                            Hola:
                            <span class="font-normal capitalize">
                                {{ auth()->user()->username }}
                            </span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 
                            text-sm">
                                Cerrar Sesión
                            </button>
                        </form>
                    </nav>
                @endauth
                
                @guest
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold uppercase text-gray-600 
                            text-sm" href="{{ route('login') }}">Login
                        </a>

                        <a class="font-bold uppercase text-gray-600 
                            text-sm" href="{{ route('register') }}">Crear Cuenta
                        </a>
                    </nav>
                @endguest
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>

            @yield('contenido')
        </main>

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold capitalize">
            SocialLink -  Todos los derechos reservados
            {{ now()->year }}
        </footer>

        @livewireScripts
    </body>
</html>
