<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function row()
    {
        return $this->belongsTo(Row::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
