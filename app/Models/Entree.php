<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    protected $table = "entree";
    protected $primaryKey = "code_entree";
    public $incrementing = true; 
    public $timestamps = false;
    use HasFactory;
}
