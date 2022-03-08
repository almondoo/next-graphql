<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_name',
    ];

    protected $table = 'communities';

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
