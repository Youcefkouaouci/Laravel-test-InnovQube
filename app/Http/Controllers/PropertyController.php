<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('properties.index');
    }

    public function show(Property $property)
    {
        $property->load('bookings');
        return view('properties.show', compact('property'));
    }
}
