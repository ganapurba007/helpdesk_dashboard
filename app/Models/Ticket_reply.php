<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ticket_reply extends Model
{
    /** @use HasFactory<\Database\Factories\TicketReplyFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'message',
    ];

    // Relationships
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
