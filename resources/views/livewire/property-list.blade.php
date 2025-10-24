<main class="container mx-auto p-6">

    <!-- Filtres de recherche -->
    <section aria-label="Filtres de recherche" class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4" role="search">

            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                <input id="search" wire:model.debounce.300ms="search" type="text"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                    placeholder="Nom ou description...">
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Localisation</label>
                <input id="location" wire:model.debounce.300ms="location" type="text"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                    placeholder="Ville, région...">
            </div>

            <div>
                <label for="priceMin" class="block text-sm font-medium text-gray-700 mb-1">Prix min (€/nuit)</label>
                <input id="priceMin" wire:model.lazy="priceMin" type="number" min="0"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div>
                <label for="priceMax" class="block text-sm font-medium text-gray-700 mb-1">Prix max (€/nuit)</label>
                <input id="priceMax" wire:model.lazy="priceMax" type="number" max="1000"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

        </form>
    </section>

    <!-- Liste des propriétés -->
    <section aria-label="Liste des propriétés" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($properties as $property)
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">

            <!-- Image de la propriété -->
            @if($property->image)
            <img src="{{ Storage::url($property->image) }}" alt="{{ $property->name }}"
                class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center" aria-label="Image non disponible">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            @endif

            <!-- Détails de la propriété -->
            <div class="p-6">
                <header>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $property->name }}</h3>
                </header>

                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($property->description, 100) }}</p>

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $property->location ?? 'Non spécifiée' }}
                    </div>
                    <div class="text-primary-600 font-bold">
                        {{ number_format($property->price_per_night, 2) }}€/nuit
                    </div>
                </div>

                <ul class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                    <li>🛏️ {{ $property->bedrooms }} ch.</li>
                    <li>🚿 {{ $property->bathrooms }} sdb</li>
                    <li>👥 {{ $property->max_guests }} pers.</li>
                </ul>

                <a href="{{ route('properties.show', $property) }}"
                    class="block w-full text-center bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 transition-colors">
                    Voir les détails
                </a>
            </div>
        </article>
        @endforeach
    </section>

    <!-- Pagination -->
    <nav aria-label="Pagination" class="mt-8">
        {{ $properties->links() }}
    </nav>

</main>
