<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use AlphaVantage\Api;
use Validator,Redirect,Response;

class ApiHandlerController extends Controller
{
    public function getPosts(Request $request) {

        $searchvalue = $request->session()->get('company');
        if($searchvalue!=""){
            $string = file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=".$searchvalue."&interval=5min&apikey=LY4Q54W6B5494F80");
            $arr = json_decode($string, true);

            // check if the array key exists
            if ( ! empty( $arr['Time Series (5min)'])) {
                // loop over the contents of Time Series
                $data=  $arr['Time Series (5min)'];
                return view('Dashboard', compact('data'));
            }
        }


    }
    public function showPosts(Request $request) {

        $data = request()->validate([
            'employee_search' => 'required'
        ]);
         $search = $request->employee_search;
         $companysymbol=explode("-",$search);
        $request->session()->put('company', $companysymbol[0] );

        $string = file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=".$companysymbol[0]."&interval=5min&apikey=LY4Q54W6B5494F80");
        $arr = json_decode($string, true);


        // check if the array key exists
        if ( ! empty( $arr['Time Series (5min)'])) {
            // loop over the contents of Time Series
            $data=  $arr['Time Series (5min)'];
            return view('Dashboard', compact('data'));


        }

    }

    /*
   AJAX request
   */
    public function getCompanies(Request $request){

        $search = $request->search;
        $response = array();
        if($search !='') {

            $companies = file_get_contents("https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=" . $search . "&apikey=LY4Q54W6B5494F80");
            $arr = json_decode($companies, true);

            if ( ! empty( $arr['bestMatches'])) {
                // loop over the contents of bestMatches

                foreach( $arr['bestMatches'] AS $date => $results ) {
                    // loop over the results for each bestMatches
                    foreach( $results AS $key => $value ) {
                        if($key==1) {

                            $response[] = array("label" => $value."-". $arr['bestMatches'] [$date]["2. name"]);

                        }
                       /* if($key==2) {

                            $response[] = array("value" => $value);
                        }*/
                    }
                }
            }


        }
        return response()->json($response);
    }
}
