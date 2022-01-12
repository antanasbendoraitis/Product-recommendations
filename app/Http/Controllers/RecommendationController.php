<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Models\Product;
use App\Models\Weather;

class RecommendationController extends Controller
{
    /**
     * Method that get city forecast and display aggregated specific city 3 days forecast
     * including recommended 2 product (for every day)
     *s
     * @return \Illuminate\Http\Response
     */
    public function index($city)
    {
        if(!preg_match('/\\p{L}+/', $city)){
            return response()->json(['message' => 'City name must contain only letters'], 404);
        }

        $response = Http::get("https://api.meteo.lt/v1/places/{$city}/forecasts/long-term");

        if($response->status() != 200){
            return response()->json(['message' => 'City forecast not found'], 404);
        }

        $recommendations = RecommendationController::getRecommendations($response);
        $recommendate = [
            'links' => [
                'weatherForecastDataSource' => "https://api.meteo.lt/"
            ],
            'city' => $city,
            'recommendations' => $recommendations
        ];

        return $recommendate;
    }

    /**
     * Method that selects product recommendations by city forecast
     * @param  collection      $response
     * @return collection
     */
    public function getRecommendations($response)
    {
        $forecasts = $response->json()['forecastTimestamps'];
        $date = substr($forecasts[0]['forecastTimeUtc'], 0, 10);
        $conditionNames = [];
        $recommendations = collect();
        $days = 0; //the forecast of following days

        for ($i=0; $i < 69; $i++) {

            if($date != substr($forecasts[$i]['forecastTimeUtc'], 0, 10)){

                $days++;
                $condition = RecommendationController::mostPossibleWeatherCondition($conditionNames);
                $conditionNames = [];
                $recommendations = RecommendationController::formateRecommendations(
                                    $condition,
                                    $date,
                                    $recommendations
                                );

                if($days == 3){
                    break;
                }

                $date = substr($forecasts[$i]['forecastTimeUtc'], 0, 10);
            }

            if(array_key_exists($forecasts[$i]['conditionCode'], $conditionNames)){
                $conditionNames[$forecasts[$i]['conditionCode']]++;
            }else{
                $conditionNames[$forecasts[$i]['conditionCode']] = 0;
            }
        }

        return $recommendations;
    }

    /**
     * Method that selects most possible day condition name
     * @param  array  $conditionNames
     * @return string
     */
    public function mostPossibleWeatherCondition($conditionNames)
    {
        $condition = '';
        $number = 0;
        foreach ($conditionNames as $key => $value){
            if($number < $value){
                $number = $value;
                $condition = $key;
            }
        }

        return $condition;
    }

    /**
     * Method that gets products by air condition
     * @param  string      $condition
     * @param  string      $date
     * @param  collection  $recommendations
     * @return collection
     */
    public function formateRecommendations($condition, $date, $recommendations)
    {
        $weather_id = Weather::where('weather', $condition)->get(['id'])[0]['id'];
        $products = Product::where('weather_id', $weather_id)
            ->take(2)->get(['sku', 'name', 'price']);

        $recommendations->push([
            'weatherForecast' => $condition,
            'date' => $date,
            'products' => $products
        ]);

        return $recommendations;
    }
}
