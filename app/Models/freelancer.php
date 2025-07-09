<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\proposal;

class freelancer extends Model
{
    /** @use HasFactory<\Database\Factories\FreelancerFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'description',
        'skills',
        'language',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->hasMany(proposal::class);
    }

    protected $casts = [
        'language' => 'array', // ✅ Add this line
    ];


}
