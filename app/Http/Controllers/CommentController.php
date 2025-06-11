<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($eventId)
    {
        $event = Event::with(['comments' => function ($query) {
            $query->whereNull('parent_id') // Ambil komentar utama saja
                ->with('replies')       // Beserta balasannya
                ->orderBy('created_at', 'desc');
        }])->findOrFail($eventId);

        return view('concerts.show', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $event = Event::findOrFail($eventId);

        Comment::create([
            'event_id' => $event->id,
            'parent_id' => $request->parent_id,
            'user_name' => $request->user_name,
            'comment' => $request->comment,
        ]);

        return redirect()->route('concerts.show', $event->id)->with('success', 'Komentar berhasil dikirim!');
    }

}

