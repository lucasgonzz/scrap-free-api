<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Geocoder\Query\GeocodeQuery;
use Illuminate\Support\Facades\Log;

class GoogleGeocoderController extends Controller
{
    
    function search($query) {

        $httpClient = new \GuzzleHttp\Client();
        $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, env('GOOGLE_GEOCODER_API_KEY'));
        $geocoder = new \Geocoder\StatefulGeocoder($provider, 'es');

        $results = $geocoder->geocodeQuery(GeocodeQuery::create($query.' Argentina'));
        
        $direcciones = [];

        foreach ($results->all() as $result) {
            $direccion = [];
            $direccion['formatted_address'] = $result->getFormattedAddress();
            $direccion['coordinates'] = [
                'latitude'      => $result->getCoordinates()->getLatitude(),
                'longitude'     => $result->getCoordinates()->getLongitude(),
            ];

            $direcciones[] = $direccion;
        }

        return response()->json(['direcciones' => $direcciones], 200);
    }

}
