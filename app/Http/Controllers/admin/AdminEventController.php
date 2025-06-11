<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AdminEventController extends Controller
{
    // Tampilkan daftar event (halaman admin)
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    // Tampilkan form tambah event
    public function create()
    {
        return view('admin.events.create');
    }

    // Simpan event baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'date'        => 'required|date',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar
        $imageName = time() . '_' . Str::slug($request->title) . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'date'        => $request->date,
            'image'       => $imageName,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    // Tampilkan form edit event
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    // Update data event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'date'        => 'required|date',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if (file_exists(public_path('images/' . $event->image))) {
                unlink(public_path('images/' . $event->image));
            }

            $imageName = time() . '_' . Str::slug($request->title) . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $event->image = $imageName;
        }

        $event->title       = $request->title;
        $event->description = $request->description;
        $event->location    = $request->location;
        $event->date        = $request->date;
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    // Hapus event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image && file_exists(public_path('images/' . $event->image))) {
            unlink(public_path('images/' . $event->image));
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }

}
