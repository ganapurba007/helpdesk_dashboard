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

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function replies()
    {
        return $this->hasMany(Ticket_reply::class);
    }

    public function histories()
    {
        return $this->hasMany(Ticket_history::class);
    }
}
