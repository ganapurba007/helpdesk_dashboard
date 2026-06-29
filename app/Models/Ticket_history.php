<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket_history extends Model
{
    /** @use HasFactory<\Database\Factories\TicketHistoryFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'ticket_id',
        'user_id',
        'old_status_id',
        'new_status_id',
        'note',
    ];
}
