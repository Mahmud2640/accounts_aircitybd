<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

}
