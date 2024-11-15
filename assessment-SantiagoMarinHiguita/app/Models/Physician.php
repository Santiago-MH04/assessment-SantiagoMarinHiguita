<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physician extends Model
{
    use HasFactory;

        //Physician features
    protected $table = 'physicians';
    protected $fillable = [
        'name',
        'specialisation',
        'shift_start',
        'shift_end'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'shift_start' => 'time',
            'shift_end' => 'time',
        ];
    }
}
