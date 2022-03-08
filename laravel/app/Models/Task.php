<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_status_id',
        'user_id',
        'title',
        'text'
    ];

    protected $table = 'tasks';

    /**
     * usersとのリレーション
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task_status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
