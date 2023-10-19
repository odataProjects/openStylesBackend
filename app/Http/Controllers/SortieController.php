<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sortie;
use Illuminate\Support\Facades\DB;

class SortieController extends Controller
{
    private function errorResponse() {
      return ["flag" => "error"]; 
    }

    private function successResponse() {
      return ["flag" => "success"]; 
    }

    /* create a new output history */ 
    public function create(Request $request) {

      /* getting data from the request */ 
      $code_matiere = $request->input("code_matiere", 0); 
      $quantite = $request->input("quantite", 0); 
        
      /* saving the entry history */ 
      if($code_matiere && $quantite) {
        DB::insert("INSERT INTO sortie (date, quantite, code_matiere) VALUES (curdate(), ?, ?)", [$quantite, $code_matiere]);
        return $this->successResponse(); 
      }
      return $this->errorResponse(); 
    }

    /* get all output data */ 
    public function readAll() {
      /* the tables columns expected are : 
        - matiere.nom 
        - sortie.quantite
        - matiere.unite 
        - sortie.date 
      */ 
      $results = DB::select("SELECT sortie.code_sortie, matiere.nom, sortie.quantite, matiere.unite, sortie.date FROM matiere, sortie WHERE matiere.code_matiere = sortie.code_matiere"); 
      return $results;
    }

    /* search sortie data matching the given keyword */ 
    public function search(Request $request) {
      /* the tables columns expected are : 
        - matiere.nom 
        - sortie.quantite
        - matiere.unite 
        - sortie.date 
      */ 
      $keyword = $request->input("keyword", NULL); 

      /* searching */ 
      if($keyword) {
        $results = DB::select("SELECT sortie.code_sortie, matiere.nom, sortie.quantite, matiere.unite, sortie.date FROM matiere, sortie WHERE matiere.code_matiere = sortie.code_matiere AND matiere.nom LIKE '%" . $keyword . "%'"); 
        return $results;
      }
      return []; 
    }

    /* remove an output history */
    public function delete(Request $request) {
      /* getting the entry id */ 
      $code_sortie = $request->input("code_sortie", 0); 

      /* deleting the entry history */ 
      if($code_sortie) {
        $sortie = Sortie::find($code_sortie); 
        $sortie->delete(); 
        return $this->successResponse(); 
      }
      return $this->errorResponse(); 
    }

      /* search item by date */ 
    public function searchByDate(Request $request) {
      $date = $request->input("date", 0); 
      if($date) {
        $results = DB::select("SELECT sortie.code_sortie, matiere.nom, sortie.quantite, matiere.unite, sortie.date FROM matiere, sortie WHERE matiere.code_matiere = sortie.code_matiere and sortie.date = ?", [$date]); 
        return $results;
      }
      else {
        return $this->readAll(); 
      }
    }

    /* search item by both date and keyword */ 
    public function searchByDateAndKeyword(Request $request) {
      $date = $request->input("date", 0); 
      $keyword = $request->input("keyword", 0); 
      if($date && $keyword) {
        $results = DB::select("SELECT sortie.code_sortie, matiere.nom, sortie.quantite, matiere.unite, sortie.date FROM matiere, sortie WHERE matiere.code_matiere = sortie.code_matiere AND sortie.date = ? AND matiere.nom LIKE '%" . $keyword . "%'", [$date]); 
        return $results;
      }
      else {
        if($date)
          return $this->searchByDate($request); 
        else 
          return $this->search($request); 
      }
    }
}