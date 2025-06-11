<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentController extends Controller
{
    // Tampilkan halaman pembayaran
    public function show(Transaction $transaction)
    {
        return view('payment.show', compact('transaction'));
    }

    // Proses pembayaran oleh user (status tetap 'pending')
    public function process(Request $request, Transaction $transaction)
    {
        // Set status ke 'pending' dulu, admin nanti yang mengubah ke 'paid'
        $transaction->status = 'pending';
        $transaction->save();

        if ($request->method === 'manual') {
            return redirect()->route('payment.manual', $transaction->id);
        }

        return redirect()->route('payment.show', $transaction->id)
                         ->with('success', 'Pembayaran sedang diproses dan menunggu konfirmasi admin.');
    }

    // Tampilkan halaman petunjuk pembayaran manual (jika ada)
    public function manual(Transaction $transaction)
    {
        return view('payment.manual', compact('transaction'));
    }
}
