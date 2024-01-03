<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = ['name','age','born_date'];

    /** @var array<int, string> $dates;*/
    protected array $dates = ['created_at', 'updated_at','born_date'];
}
