<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminConcertController extends Controller
{
    public function index()
    {
        $finishedEvents = Event::where('date', '<', now())->orderByDesc('date')->get();
        return view('admin.concerts.index', compact('finishedEvents'));
    }

    public function create()
    {
        return view('admin.concerts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required|date|before_or_equal:today',
        ]);

        Event::create($request->all());

        return redirect()->route('admin.concerts.index')->with('success', 'Konser berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.concerts.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required|date|before_or_equal:today',
        ]);

        $event->update($request->all());

        return redirect()->route('admin.concerts.index')->with('success', 'Konser berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if (method_exists($event, 'forceDelete')) {
            $event->forceDelete();
        } else {
            $event->delete();
        }
        
        return redirect()->route('admin.concerts.index')->with('success', 'Konser berhasil dihapus.');
    }


}

