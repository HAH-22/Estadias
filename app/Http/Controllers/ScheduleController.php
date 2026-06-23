<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function index()
    {
        $schedules = Schedule::orderBy('id')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|string|max:255',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_closed' => 'nullable|boolean',
        ]);

        Schedule::create([
            'day' => $request->day,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'is_closed' => $request->has('is_closed'),
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Horario creado correctamente.');
    }

    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'day' => 'required|string|max:255',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_closed' => 'nullable|boolean',
        ]);

        $schedule->update([
            'day' => $request->day,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'is_closed' => $request->has('is_closed'),
        ]);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Horario actualizado.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')
            ->with('success', 'Horario eliminado.');
    }
}