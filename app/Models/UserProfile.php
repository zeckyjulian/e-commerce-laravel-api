<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'phone', 'shipping_address', 'gender', 'date_of_birth', 'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
