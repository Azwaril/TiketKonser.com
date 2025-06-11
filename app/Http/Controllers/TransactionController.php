<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Buat transaksi baru saat klik beli tiket
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil data tiket
        $ticket = Ticket::findOrFail($request->ticket_id);

        // Cek stok tiket
        if ($ticket->stock < $request->quantity) {
            return back()->withErrors(['stock' => 'Stok tiket tidak cukup'])->withInput();
        }

        $totalPrice = $ticket->price * $request->quantity;

        DB::beginTransaction();

        try {
            // Buat transaksi
            $transaction = Transaction::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'quantity' => $request->quantity,
                'status' => 'pending',
            ]);

            // Update stok tiket
            $ticket->decrement('stock', $request->quantity);

            DB::commit();

            // Redirect ke halaman detail pembayaran
            return redirect()->route('transactions.show', $transaction->id)
                ->with('success', 'Transaksi berhasil dibuat, lanjutkan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal membuat transaksi: ' . $e->getMessage()])->withInput();
        }
    }
    public function show(Transaction $transaction)
    {
        // Opsional: pastikan user adalah pemilik transaksi
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('transaction.show', compact('transaction'));
    }

}
