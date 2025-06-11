<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminPaymentController extends Controller
{
    // Tampilkan semua transaksi pembayaran (misal untuk admin)

    public function index(Request $request)
    {
        $query = Transaction::with('user')->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                ->orWhereHas('user', function ($qUser) use ($search) {
                    $qUser->where('name', 'like', "%{$search}%");
                });
            });
        }

        $payments = $query->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }



    // Konfirmasi pembayaran oleh admin
    public function confirm(Transaction $payment)
    {
        $payment->status = 'paid';
        $payment->save();

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }


    public function destroy(Transaction $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

}
