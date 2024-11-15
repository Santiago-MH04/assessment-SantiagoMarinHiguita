<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

        //Appointment features
    protected $table = 'appointments';
    protected $fillable = [
        'date',
        'time',

        'comments',
        'physician_id',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'is_active',
    ];

    public function physician()
    {
        return $this->belongsTo(Physician::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
