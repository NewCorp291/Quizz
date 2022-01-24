<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function choics(): HasMany {
        return $this->HasMany(Choice::class);
    }
    use HasFactory;
}
