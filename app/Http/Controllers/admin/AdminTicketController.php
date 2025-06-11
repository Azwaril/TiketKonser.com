<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index() {
        $tickets = Ticket::with('event')->latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create() {
        $events = Event::all();
        return view('admin.tickets.create', compact('events'));
    }

    public function store(Request $request) {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        Ticket::create($request->all());

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function edit(Ticket $ticket) {
        $events = Event::all();
        return view('admin.tickets.edit', compact('ticket', 'events'));
    }

    public function update(Request $request, Ticket $ticket) {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $ticket->update($request->all());

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket) {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
