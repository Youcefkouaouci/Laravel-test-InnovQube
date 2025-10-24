<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">{{ $booking->property->name }}</h3>
                        <span class="inline-block px-3 py-1 text-sm rounded-full
                            @if($booking->status === 'confirmed') bg-green-100 text-green-800
                            @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold text-gray-700">Propriété</h4>
                            <p class="text-gray-600">{{ $booking->property->name }}</p>
                            <p class="text-gray-600">📍 {{ $booking->property->location }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Dates</h4>
                            <p class="text-gray-600">
                                Du {{ $booking->start_date->format('d/m/Y') }}
                                au {{ $booking->end_date->format('d/m/Y') }}
                            </p>
                            <p class="text-gray-600">
                                ({{ $booking->start_date->diffInDays($booking->end_date) }} nuits)
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Prix total</h4>
                            <p class="text-2xl font-bold text-primary-600">
                                {{ number_format($booking->total_price, 2) }}€
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Date de réservation</h4>
                            <p class="text-gray-600">{{ $booking->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('bookings.index') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600">
                            Retour
                        </a>

                        @if($booking->status !== 'cancelled')
                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                            @csrf
                            <button type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                                class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700">
                                Annuler la réservation
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
