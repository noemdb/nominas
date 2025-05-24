<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerBehaviorHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_behavior_id',
        'user_id',
        'action',
        'old_values',
        'new_values',
        'comments'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array'
    ];

    public function behavior()
    {
        return $this->belongsTo(WorkerBehavior::class, 'worker_behavior_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
