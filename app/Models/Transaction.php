<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    use HasFactory;

    protected $fillable = [
    'user_id',
    'ticket_id',
    'total_price',
    'quantity',
    'status',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }


    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
