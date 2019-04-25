<?php

namespace App\Http\Controllers\API;

use App\Cities;
use App\Discipline;
use App\Trainer;
use App\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function disciplines()
    {
        return Discipline::all();
    }

    public function cities()
    {
//        $distinctCities = Trainer::distinct('city')->pluck('city');
//        $cities = $distinctCities->toArray();
        $cities = Cities::all()->toArray();
        return $cities;
    }

    public function searchTrainer()
    {
        $disciplinesFromRequest = \Request::get('disciplines');
        $disciplines = json_encode($disciplinesFromRequest);
        $city = \Request::get('city');
        error_log('city: '.$city);
        $voivodeship = \Request::get('voivodeship');
        error_log('voivodeship: '.$voivodeship);
        if(isset($disciplinesFromRequest) && isset($city)) {
            error_log('1');
            $disciplines = $this->convertIdsFromFrontToArray($disciplines);
            $disciplinesArr = implode(",", $disciplines);
            $queryString = '*, (select count(id) from `discipline_trainer` where `trainers`.`id` = `discipline_trainer`.`trainer_id` and `discipline_id` in ('.$disciplinesArr.') ) as cc';
            $havingPart = 'cc >= '.sizeof($disciplines);
            $trainers = Trainer::selectRaw($queryString)->whereHas('disciplines', function ($query) use ($disciplines) {
                $query->whereIn('disciplines.id', $disciplines);
            })->where('city',$city)->havingRaw($havingPart)->simplePaginate(9);
            return $trainers;
        }else if(isset($disciplinesFromRequest) && !isset($city) && isset($voivodeship)) {
            error_log('1.1');
            $disciplines = $this->convertIdsFromFrontToArray($disciplines);
            $disciplinesArr = implode(",", $disciplines);
            $queryString = '*, (select count(id) from `discipline_trainer` where `trainers`.`id` = `discipline_trainer`.`trainer_id` and `discipline_id` in ('.$disciplinesArr.') ) as cc';
            $havingPart = 'cc >= '.sizeof($disciplines);
            $trainers = Trainer::selectRaw($queryString)->whereHas('disciplines', function ($query) use ($disciplines) {
                $query->whereIn('disciplines.id', $disciplines);
            })->where('voivodeship',$voivodeship)->havingRaw($havingPart)->simplePaginate(9);
            return $trainers;
        } else if(isset($disciplinesFromRequest)) {
            error_log('2');
            $disciplines = $this->convertIdsFromFrontToArray($disciplines);
            $disciplinesArr = implode(",", $disciplines);
            $queryString = '*, (select count(id) from `discipline_trainer` where `trainers`.`id` = `discipline_trainer`.`trainer_id` and `discipline_id` in ('.$disciplinesArr.') ) as cc';
            $havingPart = 'cc >= '.sizeof($disciplines);
/*            return Trainer::selectRaw($queryString)
                ->whereHas('disciplines', function ($query) use ($disciplines) {
                    $query->whereIn('disciplines.id', $disciplines);
                })->havingRaw($havingPart)->log("        *****  Intermediate query log")->simplePaginate(9);*/
            return Trainer::selectRaw($queryString)
                ->whereHas('disciplines', function ($query) use ($disciplines) {
                    $query->whereIn('disciplines.id', $disciplines);
                })->havingRaw($havingPart)->simplePaginate(9);
        } else if(!isset($disciplinesFromRequest) && !isset($city) && isset($voivodeship)) {
            error_log('2.1');
            return Trainer::where('voivodeship',$voivodeship)->paginate(9);
        } else if(isset($city)) {
            error_log('3');
            return Trainer::where('city',$city)->paginate(9);
        } else {
            error_log('4');
            return Trainer::latest()->paginate(9);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewTrainer()
    {
        error_log('Viewww: ');
        $trainerRequest = \Request::get('trainer');
        error_log('req: '.$trainerRequest);
        $trainer = Trainer::with('disciplines')->with('opinions.user')->findOrFail($trainerRequest);
        return $trainer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function sendContactEmail(Request $request)
    {
        Mail::raw($request['content'], function ($message) use ($request) {
            $message->to($request['email']);
        });

        return ['message' => 'ok'];
    }

    private function convertIdsFromFrontToArray($IdsInString) {
        preg_match_all('!\d+!', $IdsInString, $matches); // convert string ["1","2"] to "1,2"
        $newString = implode(',', $matches[0]);
        $integerArray = explode(",",$newString); // convert "1,2" to integer array
        foreach ($integerArray AS $index => $value)
            $integerArray[$index] = (int)$value;

        return $integerArray;
    }

    public function retrieveDisciplinesByCategory(){
        error_log('in welcome ret');
        if ($search = \Request::get('category')) {
            $discipline = Discipline::where(function($query) use ($search){
                $query->where('category','LIKE',"%$search%");
            })->paginate(100);
        } else {
            return null;
        }
        return $discipline;
    }

    public function sendPublicEmail(Request $request){

        if( 'lg' == $request['type'] ){
            $id = $request['id'];
            $user = User::findOrFail($id);

            $name = $user->name;
            $email = $user->email;
            $date = $request['date'];
            $startTime = $request['startTime'];
            $stopTime = $request['stopTime'];
            $message = $request['message'];

            $concatenated = 'Użytkownik ' .$name . ' o mailu ' .$email . ' pyta o rezerwacje w dniu : ' .$date . ' o godzinie '
                .$startTime . ' koniec o ' .$stopTime . ' -> wiadomość ' . $message;

            Mail::raw($concatenated, function ($message) use ($email) {
                $message->to($email);
            });
        }
        else if ('nlg' == $request['type']) {
            $name = $request['name'];
            $email = $request['email'];
            $date = $request['date'];
            $startTime = $request['startTime'];
            $stopTime = $request['stopTime'];
            $message = $request['message'];

            $concatenated = 'Użytkownik ' .$name . ' o mailu ' .$email . ' pyta o rezerwacje w dniu : ' .$date . ' o godzinie '
            .$startTime . ' koniec o ' .$stopTime . ' -> wiadomość ' . $message;

            Mail::raw($concatenated, function ($message) use ($email) {
                $message->to($email);
            });
        }




    }

}
