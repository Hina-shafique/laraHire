<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Client;

class freelancer extends Model
{
    /** @use HasFactory<\Database\Factories\FreelancerFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'description',
        'skills',
        'languages',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->hasMany(Client::class);
    }
}
