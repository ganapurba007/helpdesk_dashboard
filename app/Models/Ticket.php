<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ticket_number',
        'user_id',
        'assigned_to',
        'priority_id',
        'status_id',
        'category_id',
        'subject',
        'description',
        'img',
        'resolved_at',
        'closed_at',
    ];

    protected $dates = [
        'resolved_at',
        'closed_at',
    ];
}
