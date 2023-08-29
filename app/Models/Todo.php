<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        "task",
        "completed",
        "user_id",
        "parent_id"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
