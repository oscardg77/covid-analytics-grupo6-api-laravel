<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Entry;
use App\Models\Region;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
     public function getCountries() {
         $countries = Country::all();
         return ['countries' =>$countries];
     }

    public function getEntries() { 
        $entries = Entry::all();
        return ['entries' =>$entries];
    }
    
    public function getRegions() {
        $regions = Region::all();
        return ['regions' =>$regions];
    }

    public function getRegion($id, $nombre) {
     $region = Region::where('id', '=', $id)->where('ContinentExp', '=', $nombre)->get();
     return ['region' => $region];
    }


     public function getEntriesPorFecha($fecha) {

         $fechaArray = explode('-', $fecha);

         $entries = Entry::with('country')
                             ->where('day', '=', $fechaArray[0])
                             ->where('month', '=', $fechaArray[1])
                             ->where('year', '=', $fechaArray[2])
                             ->get();

         return ['data' => $entries];
     }


     public function getEntriesPorFechayCountries($fechaycountries) {

         $fechaArray = explode('-', $fecha);
        
         $entries = Entry::with('country')
                           ->where('day', '=', $day)
                           ->where('month', '=', $month)
                           ->where('year', '=', $year)
                           ->where('countriesAndTerritories', '=', $countriesAndTerrtories)
                           ->get();
           return ['data' => $entries];               
     }


   public function getSumDatos () {
        $cases = Entries::select('country_id', Entries::raw('SUM(cases) AS cases'))
        ->groupBy('country_id')
        ->get();
        $deaths =  Entries::select('country_id', Entries::raw('SUM(deaths) AS deaths'))
        ->groupBy('country_id')
        ->get();
        $acumulativo =  Entries::select('country_id', Entries::raw('SUM(Acumulative_number_for_14_days_of_covid'))
        ->groupBy('country_id')
        ->get();
        return ["Casos" => $cases, "Muertes" => $deaths, "Acumulativo" => $acumulativo];
   }


 
    public function getSumDatosPaís ($país) {
      $countries = Countries::where('countriesAndTerritories', "-", $pais)->get();  
      $cases = Entries::select('country_id', Entries::raw('SUM(cases) AS cases'))
      ->where('country_id', "-", $countries[0]->id)
      ->groupBy('country_id')
      ->get();
      $countries = Countries::where('countriesAndTerritories', "-", $pais)->get();
      $deaths =  Entries::select('country_id', Entries::raw('SUM(deaths) AS deaths'))
      ->where('country_id', "-", $countries[0]->id)
      ->groupBy('country_id')
      ->get();
      $countries = Countries::where('countriesAndTerritories', "-", $pais)->get();
      $acumulativo =  Entries::select('country_id', Entries::raw('SUM(Acumulative_number_for_14_days_of_covid'))
      ->where('country_id', "-", $countries[0]->id)
      ->groupBy('country_id')
      ->get();

      return ["Casos" => $cases, "Muertes" => $deaths, "Acumulativo" => $acumulativo];
 }


  
}
