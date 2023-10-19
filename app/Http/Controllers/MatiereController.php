<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use Illuminate\Support\Facades\DB;

class MatiereController extends Controller
{   

  // basic error response 
  private function errorResponse() {
    return ["flag" => "error"]; 
  }

  // basic success resonse 
  private function successResponse() {
    return ["flag" => "success"]; 
  }

  /* writing the base64 data to an image file */ 
  private function writeIllustrationFile($filename, $base64Data) {
    $filepath = "assets/images/matieres/" . $filename; 
    $decodedData = base64_decode($base64Data);
    file_put_contents($filepath, $decodedData); 
    return $filepath; 
  }

  /* create new item */ 
  public function create(Request $request) {
    $matiere = new Matiere();
    
    /* get data from the request */ 
    $nom = $request->input("nom", 0); 
    $unite = $request->input("unite", 0); 
    $illustration = $request->input("illustration", 0);
    $illustrationPath; 

    /* set the illustaration for the item to be created */  
    if(!$illustration)
      $illustrationPath = "assets/images/matieres/item.svg"; 
    else {
      $illustrationPath = $this->writeIllustrationFile($illustration["filename"], $illustration["data"]);
    }

    /* creating the new item */ 
    if($nom && $unite) {
      $matiere->nom = $nom; 
      $matiere->unite = $unite; 
      $matiere->quantite = 0; 
      $matiere->illustration = $illustrationPath; 
      $matiere->save(); 
      return $this->successResponse(); 
    }
    return $this->errorResponse(); 
  }

  /* read item*/ 
  public function readAll() {
    $items = Matiere::all(); 
    foreach ($items as $element) {
      $element["illustration"] = asset($element["illustration"]);
    }
    return json_encode($items); 
  }

  /* increase the quantity of the item */ 
  public function increaseQuantity(Request $request) {
    /* getting request data */
    $code_matiere = $request->input("code_matiere", 0); 
    $quantite = $request->input("quantite", 0); 

    if($quantite && $code_matiere) {
      $matiere = Matiere::find($code_matiere); 
      $matiere->quantite += $quantite; 
      $matiere->save(); 
      return $this->successResponse(); 
    }
    return $this->errorResponse(); 
  }

  /* increase the quantity of the item */ 
  public function decreaseQuantity(Request $request) {
    /* getting request data */
    $code_matiere = $request->input("code_matiere", -1); 
    $quantite = $request->input("quantite", 0); 

    /* decreasing quantity of the specified item */ 
    if($code_matiere > -1) {
      $matiere = Matiere::find($code_matiere); 
      if($quantite > 0 && $quantite <= $matiere->quantite) { 
        $matiere->quantite -= $quantite; 
        $matiere->save(); 
        return $this->successResponse(); 
      }
    }
    return $this->errorResponse(); 
  }

  /* delete an item */ 
  public function delete(Request $request) {
    $code_matiere = $request->input("code_matiere", 0); 

    /* removing the item */ 
    if($code_matiere) { 
      $matiere = Matiere::find($code_matiere);  
      $matiere->delete();
      return $this->successResponse(); 
    }
    return $this->errorResponse(); 
  }

  /* getting the information an item by specifing its id */ 
  public function get(Request $request) {
    $code_matiere = $request->input("code_matiere", 0); 
    if($code_matiere) {
      $matiere = Matiere::find($code_matiere); 
      $data =  [
        "code_matiere" => $code_matiere, 
        "nom" => $matiere->nom, 
        "quantite" => $matiere->quantite, 
        "unite" => $matiere->unite, 
        "illustration" => $matiere->illustration 
      ]; 
      return json_encode($data); 
    }
    return $this->errorResponse(); 
  }

  /* search an item using the given keyword */
  public function search(Request $request)  {
    $keyword = $request->input("keyword", NULL); 

    /* searching item using the keywor */
    if($keyword) {
      $results = DB::select("SELECT * FROM matiere WHERE matiere.nom LIKE \"%" . $keyword . "%\""); 
      return $results; 
    } 
    return $this->errorResponse(); 
  }
}
