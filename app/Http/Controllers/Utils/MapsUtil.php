<?php
/**
 * Created by PhpStorm.
 * User: mbajdek
 * Date: 19/11/2018
 * Time: 21:17
 */

namespace App\Http\Controllers\Utils;

use App\APICall;
use App\Gym;
use GuzzleHttp\Client;


class MapsUtil
{

    public static function getGeocodeData($address, $service) {


        if( $address <> null && $service <> null){
            if( $service == 'here' ){
                error_log('$$$$$ before call here service');
                return self::getGeocodeHEREData($address);
            }
            else if ( $service == 'gm' ){
                return self::getGeocodeGMData( $address );
            }


        }

    }

    private static function getGeocodeHEREData($address){
        $address = urlencode($address);
        $googleMapUrl = "https://geocoder.api.here.com/6.2/geocode.json?app_id=" .CommonConstans::$HERE_APPID."&app_code="
            .CommonConstans::$HERE_APPCODE ."&searchtext={$address}";
        error_log('$$$ endpoint concatenated ');
        $geocodeResponseData = file_get_contents($googleMapUrl);
        $responseData = json_decode($geocodeResponseData, true);
        $longitude = $responseData["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Longitude"];
        $latitude = $responseData["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Latitude"];
        $formattedAddress = $responseData["Response"]["View"][0]["Result"][0]["Location"]["Address"]["Label"];
        $street = $responseData["Response"]["View"][0]["Result"][0]["Location"]["Address"]["Street"];
        $city = $responseData["Response"]["View"][0]["Result"][0]["Location"]["Address"]["City"];
        $postalCode = $responseData["Response"]["View"][0]["Result"][0]["Location"]["Address"]["PostalCode"];

        if($latitude && $longitude && $formattedAddress && $street && $city && $postalCode) {

            return [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'faddress' => $formattedAddress,
                'street' => $street,
                'postalCode' => $postalCode,
                'city' => $city
            ];
        }


    }


    private static function getGeocodeGMData($address)
    {
        $address = urlencode($address);
        $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=" . CommonConstans::$GM_GEOCODE_KEY;
        $geocodeResponseData = file_get_contents($googleMapUrl);
        $responseData = json_decode($geocodeResponseData, true);
        if ($responseData['status'] == 'OK') {
            $latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
            $longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
            $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";

            if ($latitude && $longitude && $formattedAddress) {

                error_log('inside nullcheck condition');

                return [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'faddress' => $formattedAddress
                ];
            }
        }
    }



}
