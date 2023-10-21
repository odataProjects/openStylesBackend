<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    protected $table = "sortie";
    protected $primaryKey = "code_sortie";
    public $incrementing = true; 
    public $timestamps = false;
    use HasFactory;
}
