<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        // Validación y creación
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'inscription_fee' => 'nullable|numeric',
        ]);

        Plan::create($request->all());
        return redirect()->route('admin.plans.index')->with('success', 'Plan creado.');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $plan->update($request->all());
        return redirect()->route('admin.plans.index')->with('success', 'Plan actualizado.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan eliminado.');
    }
}