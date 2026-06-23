<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    public function index()
    {
        $networks = SocialNetwork::orderBy('order')->get();
        return view('admin.social-networks.index', compact('networks'));
    }

    public function create()
    {
        return view('admin.social-networks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'url' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        SocialNetwork::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'url' => $request->url,
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.social-networks.index')
            ->with('success', 'Red social creada correctamente.');
    }

    public function edit(SocialNetwork $socialNetwork)
    {
        return view('admin.social-networks.edit', compact('socialNetwork'));
    }

    public function update(Request $request, SocialNetwork $socialNetwork)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'url' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $socialNetwork->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'url' => $request->url,
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.social-networks.index')
            ->with('success', 'Red social actualizada.');
    }

    public function destroy(SocialNetwork $socialNetwork)
    {
        $socialNetwork->delete();
        return redirect()->route('admin.social-networks.index')
            ->with('success', 'Red social eliminada.');
    }
}