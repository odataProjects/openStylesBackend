<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entree;
use Illuminate\Support\Facades\DB;

class EntreeController extends Controller
{
    private function errorResponse() {
      return ["flag" => "error"]; 
    }

    private function successResponse() {
      return ["flag" => "success"]; 
    }

    /* create a new entry history */ 
    public function create(Request $request) {

      /* getting data from the request */ 
      $code_matiere = $request->input("code_matiere", 0); 
      $quantite = $request->input("quantite", 0); 
        
      /* saving the entry history */ 
      if($code_matiere && $quantite) {
        DB::insert("INSERT INTO entree (date, quantite, code_matiere) VALUES (curdate(), ?, ?)", [$quantite, $code_matiere]);
        return $this->successResponse(); 
      }
      return $this->errorResponse(); 
    }

    /* get all entry data */ 
    public function readAll() {
      /* the tables columns expected are : 
        - matiere.nom 
        - entree.quantite
        - matiere.unite 
        - entree.date 
      */ 
      $results = DB::select("SELECT entree.code_entree, matiere.nom, entree.quantite, matiere.unite, entree.date FROM matiere, entree WHERE matiere.code_matiere = entree.code_matiere ORDER BY entree.date DESC"); 
      return $results;
    }

    /* search entree data matching the given keyword */ 
    public function search(Request $request) {
      /* the tables columns expected are : 
        - matiere.nom 
        - entree.quantite
        - matiere.unite 
        - entree.date 
      */ 
      $keyword = $request->input("keyword", NULL); 

      /* searching */ 
      if($keyword) {
        $results = DB::select("SELECT matiere.nom, entree.quantite, matiere.unite, entree.date FROM matiere, entree WHERE matiere.code_matiere = entree.code_matiere AND matiere.nom LIKE '%" . $keyword . "%'"); 
        return $results;
      }
      return []; 
    }

    /* remove an entry history */
    public function delete(Request $request) {
      /* getting the entry id */ 
      $code_entree = $request->input("code_entree", 0); 

      /* deleting the entry history */ 
      if($code_entree) {
        $entree = Entree::find($code_entree); 
        $entree->delete(); 
        return $this->successResponse(); 
      }
      return $this->errorResponse(); 
    }

    /* search item by date */ 
    public function searchByDate(Request $request) {
      $date = $request->input("date", 0); 
      if($date) {
        $results = DB::select("SELECT entree.code_entree, matiere.nom, entree.quantite, matiere.unite, entree.date FROM matiere, entree WHERE matiere.code_matiere = entree.code_matiere and entree.date = ?", [$date]); 
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
        $results = DB::select("SELECT entree.code_entree, matiere.nom, entree.quantite, matiere.unite, entree.date FROM matiere, entree WHERE matiere.code_matiere = entree.code_matiere AND entree.date = ? AND matiere.nom LIKE '%" . $keyword . "%'", [$date]); 
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