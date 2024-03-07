<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function getDescriptionAttribute($value)
    {
        return nl2br($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
