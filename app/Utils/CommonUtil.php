<?php
/**
 * Created by PhpStorm.
 * User: mbajdek
 * Date: 18/10/2018
 * Time: 20:07
 */

namespace App\Utils;


use App\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CommonUtil
{

    public static function getUserDirectory($usrName){
        return public_path('images' . DIRECTORY_SEPARATOR . 'users' .DIRECTORY_SEPARATOR . $usrName);
    }

    public static function getUserAsset($usr){
        return $usr->name . DIRECTORY_SEPARATOR . $usr->picture;
    }

    public static function storeUserAvatar($usrName,Request $req){
        $file = $req->file('picture');
        $name = $usrName . '_avatar' . '.' .$req->picture->getClientOriginalExtension();
        $file->move( CommonUtil::getUserDirectory($usrName) , $name );
        return $name;
    }

    public static function createUserDirectory( $usrName ){

        $defaultStorage = public_path('images' . DIRECTORY_SEPARATOR . 'users' .DIRECTORY_SEPARATOR . $usrName);

        if( !File::exists($defaultStorage) ){
            File::makeDirectory($defaultStorage);
        }
    }

    public static function destroyUserDirectory( $usrName ){

        $defaultStorage = public_path('images' . DIRECTORY_SEPARATOR . 'users' .DIRECTORY_SEPARATOR . $usrName);

        if( File::exists($defaultStorage) ){
            File::deleteDirectory($defaultStorage);
        }
    }

    public static function get_server_memory_usage(){


        return round(memory_get_usage() / 1048576 , 2 );
    }

    public static function get_server_cpu_usage(){

        $load = sys_getloadavg();
        return round($load[0],2);

    }

    public static function get_space_free(){

        return round(disk_free_space("/") / 1073741824,2);

    }

    public static function systemLoadInPercent(){
        $load = sys_getloadavg();
        return $load[0];
    }

    public static function checkIfFileFromRequest($requestFile){
        if( $requestFile != null && substr($requestFile, 5, 5) == 'image' ){
            error_log('@@>> ret true');
            return true;
        }
        else{
            error_log('@@>> ret false ' . substr($requestFile, 5, 5));
            return false;
        }
    }

    public static function convertIdsFromFrontToArray($IdsInString) {
        preg_match_all('!\d+!', $IdsInString, $matches); // convert string ["1","2"] to "1,2"
        $newString = implode(',', $matches[0]);
        $integerArray = explode(",",$newString); // convert "1,2" to integer array
        foreach ($integerArray AS $index => $value)
            $integerArray[$index] = (int)$value;

        return $integerArray;
    }

    public static function checkUserEligibility( $requestId ){

        if( $requestId != null && ($requestId == Auth::user()->id) ){
            error_log('@@>> user eligible');
            return true;
        } else{
            error_log('@@>> user not eligible');
            return false;
        }

    }

    public static function checkIfCityIsValid($city){
        error_log('checkIfCityIsValid');
        error_log('checkIfCityIsValid: '.$city);
        $queredCity = Cities::where('name',$city)->first();
        error_log('$queredCity: '.$queredCity);
        return $queredCity;
    }
    public static function checkIfPhoneIsValid($phone){
        return !preg_match('/^[0-9]{9}$/', $phone);
    }
    public static function checkIfInstagramLinkIsValid($link){
        return !preg_match('/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/([A-Za-z0-9-_\.]+)/', $link);
    }
    public static function checkIfFacebookLinkIsValid($link){
        return !preg_match('/(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/', $link);
    }
    public static function checkIfSnapchatLinkIsValid($link){
        return !preg_match('/^[a-zA-Z][\w-_.]{1,13}[\w]$/', $link);
    }
    public static function checkIfWebsiteLinkIsValid($link){
        return !preg_match('/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/', $link);
    }


}
