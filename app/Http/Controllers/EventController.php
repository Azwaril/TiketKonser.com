<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Beranda: Menampilkan semua event
     */
    public function index()
    {
        $events = Event::all();
        return view('home', compact('events'));
    }

    /**
     * Menampilkan detail event beserta tiket dan review
     */
    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        return view('events.show', compact('event'));
    }
    
    public function showTicketsByEvent($eventId)
    {
        $event = Event::findOrFail($eventId);
        $tickets = Ticket::where('event_id', $eventId)->get();

        return view('events.ticket', compact('event', 'tickets'));
    }

    /**
     * Menampilkan daftar semua event aktif
     */
    public function listEvents(Request $request)
    {
        $query = Event::where('date', '>=', Carbon::now());

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(location) LIKE ?', ["%{$search}%"]);
            });
        }

        $events = $query->orderBy('date')->paginate(6);

        return view('events.index', compact('events'));
    }

    /**
     * Menampilkan halaman admin: daftar event
     */
    public function adminIndex()
    {
        $events = Event::paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Menampilkan form tambah event (admin)
     */
    public function create()
    {
        return view('admin.add_event');
    }

    /**
     * Menyimpan event dan tiket baru (admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required',
            'description'     => 'required',
            'location'        => 'required',
            'date'            => 'required|date',
            'image'           => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'ticket_category' => 'required',
            'ticket_price'    => 'required|numeric',
            'ticket_stock'    => 'required|integer',
        ]);

        // Upload gambar event
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Simpan event
        $event = Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'date'        => $request->date,
            'image'       => $imageName,
        ]);

        // Simpan tiket default
        Ticket::create([
            'event_id' => $event->id,
            'category' => $request->ticket_category,
            'price'    => $request->ticket_price,
            'stock'    => $request->ticket_stock,
        ]);

        return redirect()->route('events.index')->with('success', 'Event dan Tiket berhasil ditambahkan!');
    }

    /**
     * Menampilkan konser yang sudah selesai
     */
    public function finishedEvents()
    {
        $events = Event::where('date', '<', Carbon::now())->orderBy('date', 'desc')->get();
        return view('concerts.finished', compact('events'));
    }
    public function storeComment(Request $request, $concertId)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'comment'   => 'required|string',
        ]);

        $concert = Concert::findOrFail($concertId);

        $concert->comments()->create([
            'user_name' => $request->user_name,
            'comment'   => $request->content,
        ]);

        return redirect()->route('concerts.show', $concertId)->with('success', 'Komentar berhasil ditambahkan!');
    }
}
