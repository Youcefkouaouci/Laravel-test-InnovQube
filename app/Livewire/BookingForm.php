<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingForm extends Component
{
    public Property $property;
    public $startDate;
    public $endDate;
    public $notes;
    public $totalPrice = 0;
    public $isAvailable = true;
    public $errorMessage = '';

    protected $rules = [
        'startDate' => 'required|date|after_or_equal:today',
        'endDate' => 'required|date|after:startDate',
        'notes' => 'nullable|string|max:500',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
    }

    public function updatedStartDate()
    {
        $this->checkAvailability();
    }

    public function updatedEndDate()
    {
        $this->checkAvailability();
    }

    private function checkAvailability()
    {
        $this->errorMessage = '';
        $this->isAvailable = true;
        $this->totalPrice = 0;

        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate);
            $end = Carbon::parse($this->endDate);

            if ($start->gte($end)) {
                $this->errorMessage = 'La date de fin doit être après la date de début.';
                $this->isAvailable = false;
                return;
            }

            $this->isAvailable = $this->property->isAvailableForDates($this->startDate, $this->endDate);

            if (!$this->isAvailable) {
                $this->errorMessage = 'Cette propriété n\'est pas disponible pour ces dates.';
            } else {
                $days = $start->diffInDays($end);
                $this->totalPrice = $days * $this->property->price_per_night;
            }
        }
    }

    public function submit()
    {
        $this->validate();

        if (!$this->isAvailable) {
            session()->flash('error', 'Cette propriété n\'est pas disponible pour ces dates.');
            return;
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $this->property->id,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_price' => $this->totalPrice,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Votre réservation a été créée avec succès!');
        return redirect()->route('bookings.show', $booking);
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}
