<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('id', 'desc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'keyword' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'keyword' => $request->keyword,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'Pregunta frecuente creada correctamente.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'keyword' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'keyword' => $request->keyword,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'Pregunta frecuente actualizada.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')
            ->with('success', 'Pregunta frecuente eliminada.');
    }
}