<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
  /* name of the the table */ 
  protected $table = "Appartement"; 
  protected $primaryKey = "numApp"; 
  public    $incrementing = true; 
  protected $fillable = ["design", "loyer"]; 
  public    $timestamps = false; 
  use HasFactory;
}
