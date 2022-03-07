<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_id',
        'community_id',
        'message'
    ];

    const UPDATED_AT = null;
    protected $table = 'messages';
    public $timestamps = false;

    public function sender()
    {
        return $this->belongsTo(User::class, null, 'sender_id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
