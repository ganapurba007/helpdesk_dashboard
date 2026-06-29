<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'color'
    ];

    // Relationships
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function oldStatusHistories()
    {
        return $this->hasMany(Ticket_history::class, 'old_status_id');
    }

    public function newStatusHistories()
    {
        return $this->hasMany(Ticket_history::class, 'new_status_id');
    }
}
