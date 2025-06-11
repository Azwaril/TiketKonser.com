<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil transaksi yang sudah 'paid' saja
        $transactions = $user->transactions()->with('ticket.event')
                        ->where('status', 'paid')
                        ->get();

        return view('tickets.index', compact('transactions'));
    }

}
