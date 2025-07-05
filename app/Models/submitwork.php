<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submitwork extends Model
{
    /** @use HasFactory<\Database\Factories\SubmitworkFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'message',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
