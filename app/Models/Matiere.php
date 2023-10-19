<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{   
    protected $table = "matiere";
    protected $primaryKey = "code_matiere";
    public $incrementing = true; 
    public $timestamps = false;
    use HasFactory;
}
