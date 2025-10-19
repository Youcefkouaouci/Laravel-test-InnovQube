<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyList extends Component
{
    use WithPagination;

    public $search = '';
    public $priceMin = 0;
    public $priceMax = 1000;
    public $location = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'location' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $properties = Property::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->location, function ($query) {
                $query->where('location', 'like', '%' . $this->location . '%');
            })
            ->whereBetween('price_per_night', [$this->priceMin, $this->priceMax])
            ->where('is_available', true)
            ->paginate(9);

        return view('livewire.property-list', compact('properties'));
    }
}
