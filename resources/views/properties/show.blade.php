<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $property->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Détails de la propriété -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        @if($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}"
                            alt="{{ $property->name }}"
                            class="w-full h-96 object-cover rounded-lg mb-6">
                        @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg mb-6 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        @endif

                        <h3 class="text-2xl font-bold mb-4">{{ $property->name }}</h3>

                        <div class="flex gap-4 mb-6 text-gray-600">
                            <span>📍 {{ $property->location }}</span>
                            <span>🛏️ {{ $property->bedrooms }} chambres</span>
                            <span>🚿 {{ $property->bathrooms }} salles de bain</span>
                            <span>👥 {{ $property->max_guests }} invités max</span>
                        </div>

                        <div class="prose max-w-none">
                            <p class="text-gray-700">{{ $property->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de réservation -->
                <div class="lg:col-span-1">
                    @livewire('booking-form', ['property' => $property])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
