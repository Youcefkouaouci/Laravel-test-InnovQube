<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel Booking') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-primary-600">
                            🏠 Laravel Booking
                        </h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('properties.index') }}" class="text-gray-700 hover:text-primary-600">
                            Propriétés
                        </a>
                        @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-600">
                            Dashboard
                        </a>
                        <a href="{{ route('bookings.index') }}" class="text-gray-700 hover:text-primary-600">
                            Mes réservations
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                            Inscription
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl font-bold mb-4">
                        Trouvez votre prochaine location de vacances
                    </h1>
                    <p class="text-xl mb-8 text-primary-100">
                        Découvrez des propriétés exceptionnelles pour vos séjours
                    </p>
                    <a href="{{ route('properties.index') }}"
                        class="inline-block bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Explorer les propriétés
                    </a>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">

                    </div>
                    <h3 class="text-lg font-semibold mb-2">Propriétés vérifiées</h3>
                    <p class="text-gray-600">Toutes nos propriétés sont soigneusement sélectionnées et vérifiées</p>
                </div>

                <div class="text-center">
                    <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">

                    </div>
                    <h3 class="text-lg font-semibold mb-2">Prix transparents</h3>
                    <p class="text-gray-600">Pas de frais cachés, prix clairs et compétitifs</p>
                </div>

                <div class="text-center">
                    <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">

                    </div>
                    <h3 class="text-lg font-semibold mb-2">Réservation sécurisée</h3>
                    <p class="text-gray-600">Système de réservation sécurisé et fiable</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
