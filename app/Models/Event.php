<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'date', 'image'];

    protected $casts = [
    'date' => 'datetime',
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function comments() {
    return $this->hasMany(Comment::class)->whereNull('parent_id')->orderBy('created_at', 'desc');

    }
}
