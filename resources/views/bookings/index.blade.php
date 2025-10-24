<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Réservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if($bookings->count() > 0)
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                        <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-2">
                                        {{ $booking->property->name }}
                                    </h3>
                                    <p class="text-gray-600 mb-2">
                                        📍 {{ $booking->property->location }}
                                    </p>
                                    <p class="text-gray-600">
                                        📅 {{ $booking->start_date->format('d/m/Y') }} -
                                        {{ $booking->end_date->format('d/m/Y') }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p class="text-lg font-bold text-primary-600">
                                        {{ number_format($booking->total_price, 2) }}€
                                    </p>
                                    <span class="inline-block px-3 py-1 text-sm rounded-full
                                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                                @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('bookings.show', $booking) }}"
                                    class="text-primary-600 hover:text-primary-800">
                                    Voir les détails
                                </a>

                                @if($booking->status !== 'cancelled')
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                                        class="text-red-600 hover:text-red-800">
                                        Annuler
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>
                    @else
                    <p class="text-gray-600">Vous n'avez pas encore de réservations.</p>
                    <a href="{{ route('properties.index') }}" class="text-primary-600 hover:text-primary-800">
                        Parcourir les propriétés disponibles
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
