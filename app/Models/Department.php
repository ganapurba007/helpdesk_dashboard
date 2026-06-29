<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['department_name', 'description'];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
