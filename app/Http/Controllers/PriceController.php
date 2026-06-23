<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::orderBy('order')->get();
        return view('admin.prices.index', compact('prices'));
    }

    public function create()
    {
        return view('admin.prices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        Price::create([
            'name' => $request->name,
            'price' => $request->price,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.prices.index')->with('success', 'Precio creado correctamente.');
    }

    public function edit(Price $price)
    {
        return view('admin.prices.edit', compact('price'));
    }

    public function update(Request $request, Price $price)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $price->update([
            'name' => $request->name,
            'price' => $request->price,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.prices.index')->with('success', 'Precio actualizado.');
    }

    public function destroy(Price $price)
    {
        $price->delete();
        return redirect()->route('admin.prices.index')->with('success', 'Precio eliminado.');
    }
}