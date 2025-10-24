<section class="bg-white rounded-lg shadow-lg p-6" aria-labelledby="booking-title">
    <header>
        <h3 id="booking-title" class="text-xl font-semibold mb-4">
            Réserver cette propriété
        </h3>
    </header>

    <form wire:submit.prevent="submit" novalidate>
        <fieldset class="space-y-4">
            <!-- Date d'arrivée -->
            <div>
                <label for="startDate" class="block text-sm font-medium text-gray-700 mb-2">
                    Date d'arrivée
                </label>
                <input
                    wire:model="startDate"
                    id="startDate"
                    type="date"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                    min="{{ date('Y-m-d') }}"
                    required>
                @error('startDate')
                <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date de départ -->
            <div>
                <label for="endDate" class="block text-sm font-medium text-gray-700 mb-2">
                    Date de départ
                </label>
                <input
                    wire:model="endDate"
                    id="endDate"
                    type="date"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                    required>
                @error('endDate')
                <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notes (optionnel)
                </label>
                <textarea
                    wire:model="notes"
                    id="notes"
                    rows="3"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                    placeholder="Demandes spéciales, informations supplémentaires..."></textarea>
                @error('notes')
                <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                @enderror
            </div>
        </fieldset>

        <!-- Message d’erreur global -->
        @if($errorMessage)
        <div role="alert" class="mb-4 p-3 bg-red-50 border border-red-200 rounded-md text-red-700 text-sm">
            {{ $errorMessage }}
        </div>
        @endif

        <!-- Résumé du prix -->
        @if($totalPrice > 0 && $isAvailable)
        <aside class="mb-4 p-4 bg-gray-50 rounded-md" aria-label="Résumé de la réservation">
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt>Prix par nuit</dt>
                    <dd>{{ number_format($property->price_per_night, 2) }}€</dd>
                </div>
                <div class="flex justify-between">
                    <dt>Nombre de nuits</dt>
                    <dd>{{ \Carbon\Carbon::parse($startDate)->diffInDays($endDate) }}</dd>
                </div>
                <div class="border-t pt-2 mt-2 flex justify-between font-semibold">
                    <dt>Total</dt>
                    <dd class="text-primary-600">{{ number_format($totalPrice, 2) }}€</dd>
                </div>
            </dl>
        </aside>
        @endif

        <!-- Bouton de soumission -->
        <button
            type="submit"
            @if(!$isAvailable || !$startDate || !$endDate) disabled @endif
            class="w-full bg-primary-600 text-white py-3 px-4 rounded-md hover:bg-primary-700 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed">
            @if(!$startDate || !$endDate)
            Sélectionnez vos dates
            @elseif(!$isAvailable)
            Non disponible
            @else
            Réserver pour {{ number_format($totalPrice, 2) }}€
            @endif
        </button>
    </form>
</section>
