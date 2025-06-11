<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(6)->get(); // ambil 6 event terbaru
        return view('home', compact('events'));
    }
}
