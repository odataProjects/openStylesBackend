<?php

namespace App\Http\Controllers;

use App\Models\Appartement; 
use Illuminate\Http\Request;

class AppartementController extends Controller
{
  /* getting all appartement record */ 
  public function all() {
    return json_encode([
      "data" => Appartement::all()
    ]); 
  }

  /* creating new apartment */ 
  public function create(Request $request) {
    $apartment = new Appartement; 
    $design = $request->input("design", 0); 
    $loyer = $request->input("loyer", 0); 

    /* creating new apartment */ 
    if($design && $loyer) {
      $apartment->design = $design; 
      $apartment->loyer = $loyer; 
      $apartment->save(); 
      return json_encode([
        "flag" => "success", 
        "data" => [
          "numApp" => $apartment->numApp,
          "design" => $apartment->design,
          "loyer" => $apartment->loyer
        ]
      ]); 
    }
    /* no creation */ 
    else {
      return json_encode([
        "flag" => "failure", 
        "data" => []
        ]  
      );
    }
  }

  /* updating apartment */ 
  public function update(Request $request) {
    $primaryKey = $request->input("numApp", 0); 
    /* making update */ 
    if($primaryKey) {
      $apartment = Appartement::find($primaryKey); 
      $design = $request->input("design", 0); 
      $loyer = $request->input("loyer", 0); 

      if($design)
        $apartment->design = $design; 
      if($loyer)
        $apartment->loyer = $loyer; 

      /* commit change */
      $apartment->save(); 
      return json_encode([
          "flag" => "success", 
          "data" => [
            "numApp" => $apartment->numApp, 
            "design" => $apartment->design, 
            "loyer" => $apartment->loyer
          ]
        ]
      ); 
    }
    /* no primary key so there will be no update */ 
    else 
      return json_encode(["flag" => "failure", "data" => []]); 
  }

  /* deleting an apartment */ 
  public function delete(Request $request) {
    $primaryKey = $request->input("numApp", 0); 
    if($primaryKey) {
      $apartment = Appartement::find($primaryKey); 
      $apartment->delete(); 
      return json_encode(["flag" => "success"]); 
    }
    /* no primary key so there will be no deletion */ 
    else 
      return json_encode(["flag" => "failure"]); 
  }

  /* get the sum of the field loyer */ 
  public function total(Request $request) {
    $total = Appartement::all()->sum("loyer"); 
    return $total; 
  }

  /* get the min of the field loyer */ 
  public function minimum(Request $request) {
    $minimum = Appartement::all()->min("loyer"); 
    return $minimum; 
  }
  
  /* get the sum of the field loyer */ 
  public function maximum(Request $request) {
    $maximum = Appartement::all()->max("loyer"); 
    return $maximum; 
  }
}