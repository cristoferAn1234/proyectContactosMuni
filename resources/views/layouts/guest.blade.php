<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistema de Gestión de Contactos') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .header-logo {
                height: 80px;
                object-fit: contain;
                transition: transform 0.3s ease;
            }
            .header-logo:hover {
                transform: scale(1.05);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
        
        <!-- Header with 3 logos -->
        <header class="bg-white dark:bg-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo 1 - Izquierda -->
                    <div class="flex-1 flex justify-start">
                        <img src="{{ asset('images/logo-left.png') }}" 
                             alt="Logo Izquierdo" 
                             class="header-logo"
                             onerror="this.src='https://via.placeholder.com/150x80/4F46E5/FFFFFF?text=Logo+1'">
                    </div>
                    
                    <!-- Logo 2 - Centro -->
                    <div class="flex-1 flex justify-center">
                        <div class="text-center">
                            <img src="{{ asset('images/logo-center.png') }}" 
                                 alt="Logo Central" 
                                 class="header-logo mx-auto"
                                 onerror="this.src='https://via.placeholder.com/150x80/06B6D4/FFFFFF?text=Sistema+de+Contactos'">
                        </div>
                    </div>
                    
                    <!-- Logo 3 - Derecha -->
                    <div class="flex-1 flex justify-end">
                        <img src="{{ asset('images/logo-right.png') }}" 
                             alt="Logo Derecho" 
                             class="header-logo"
                             onerror="this.src='https://via.placeholder.com/150x80/4F46E5/FFFFFF?text=Logo+3'">
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-xl overflow-hidden sm:rounded-lg border border-gray-200 dark:border-gray-700">
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <footer class="mt-8 mb-4 text-center text-sm text-gray-600 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} Sistema de Gestión de Contactos Municipales. Todos los derechos reservados.</p>
            </footer>
        </div>
    </body>
</html>
