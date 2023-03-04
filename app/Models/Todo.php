<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the tasks for the to-do list.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the user of that to-do list.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
