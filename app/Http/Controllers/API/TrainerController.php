<?php

namespace App\Http\Controllers\API;

use App\Trainer;
use App\Utils\CommonUtil;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use App\User;

class TrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('checkIfLogged');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return Trainer::latest()->with('user')->with('company')->paginate(10);

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
        if(isset($request->trainer_id)) {
            error_log('@@ trainer update context');
        } else {
            error_log('@@ trainer store context');
        }

        return Trainer::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        error_log('show Trainer id: '.$id);
        if (\Gate::allows('isUserOrTrainerOrAdmin')) {
            $trainer = Trainer::with('reservations.user')->with('reservations.gym')->with('user')->with('disciplines')->findOrFail($id);
            return $trainer;
        }
        return ['error' => 'Unauthorized access'];
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

        if (\Gate::allows('isTrainerOrAdmin') ) {
            $trainer = Trainer::findOrFail($id);
            $city = CommonUtil::checkIfCityIsValid($request['city']);

            if(!isset($city)) {
                return ['title' => 'Upsss..!','status' => 'warning','message' => 'Podaj poprawną nazwę miasta'];
            }
            if (CommonUtil::checkIfPhoneIsValid($request['phone'])) {
                return ['title' => 'Upsss..!','status' => 'warning','message' => 'Podaj poprawny format telefonu (9 cyfr)'];
            }
            if ($request['instagramProfile'] != null && CommonUtil::checkIfInstagramLinkIsValid($request['instagramProfile'])) {
                return ['title' => 'Upsss..!','status' => 'warning','message' => 'Podaj poprawny format linku do swojego profilu na instagramie'];
            }
            if ($request['facebookProfile'] != null && CommonUtil::checkIfFacebookLinkIsValid($request['facebookProfile'])) {
                return ['title' => 'Upsss..!','status' => 'warning','message' => 'Podaj poprawny format linku do swojego profilu na facebook\'u'];
            }
            if ($request['snapchatProfile'] != null && CommonUtil::checkIfSnapchatLinkIsValid($request['snapchatProfile'])) {
                return ['title' => 'Upsss..!','status' => 'warning','message' => 'Podaj poprawny format linku do swojego profilu na snapchat'];
            }
            if ($request['website'] != null && CommonUtil::checkIfWebsiteLinkIsValid($request['website'])) {
                return ['title' => 'Upsss..!','status' => 'warning','message' => 'Podaj poprawny format linku do swojej strony internetowej'];
            }

            $dateTimeNow = date("Y-m-d_H:i:s");

            if( CommonUtil::checkIfFileFromRequest($request->picture) ){
                $file_extension = explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
                $file_name = '_pict1_' . $id .'_'.$dateTimeNow. '.' . $file_extension;
                \Image::make($request->picture)->save(public_path('img/trainer/') . $file_name);
                $request->merge(['picture' => $file_name]);
                $trainerPicture = public_path('img/trainer/').$trainer->picture;
                error_log('$trainerPicture: '.$trainerPicture);
                if(file_exists($trainerPicture)){
                    error_log('in if');
                    @unlink($trainerPicture);
                }
            }
            if($request->isPictureDelete == 1){
                $trainerPicture = public_path('img/trainer/').$trainer->picture;
                if(file_exists($trainerPicture)){
                    @unlink($trainerPicture);
                }
                $request->merge(['picture' => null]);
            }

            if( CommonUtil::checkIfFileFromRequest($request->picture2) ){
                $file_extension = explode('/', explode(':', substr($request->picture2, 0, strpos($request->picture2, ';')))[1])[1];
                $file_name = '_pict2_' . $id .'_'.$dateTimeNow. '.' . $file_extension;

                \Image::make($request->picture2)->save(public_path('img/trainer/'). $file_name);
                $request->merge(['picture2' => $file_name]);

                $trainerPicture = public_path('img/trainer/').$trainer->picture2;
                if(file_exists($trainerPicture)){
                    @unlink($trainerPicture);
                }
            }

            if($request->isPictureDelete2 == 1){
                $trainerPicture = public_path('img/trainer/').$trainer->picture2;
                if(file_exists($trainerPicture)){
                    @unlink($trainerPicture);
                }
                $request->merge(['picture2' => null]);
            }

            if( CommonUtil::checkIfFileFromRequest($request->picture3) ){
                $file_extension = explode('/', explode(':', substr($request->picture3, 0, strpos($request->picture3, ';')))[1])[1];
                $file_name = '_pict3_' . $id .'_'.$dateTimeNow. '.' . $file_extension;
                \Image::make($request->picture3)->save(public_path('img/trainer/'). $file_name);
                $request->merge(['picture3' => $file_name]);

                $trainerPicture = public_path('img/trainer/').$trainer->picture3;
                if(file_exists($trainerPicture)){
                    @unlink($trainerPicture);
                }
            }

            if($request->isPictureDelete3 == 1){
                $trainerPicture = public_path('img/trainer/').$trainer->picture3;
                if(file_exists($trainerPicture)){
                    @unlink($trainerPicture);
                }
                $request->merge(['picture3' => null]);
            }

            if($trainer->city != $city->name){
                $trainer->cities()->attach($city);
                $trainer->city = $city->name;
                $trainer->voivodeship = $city->voivodeship;
                $user = User::findOrFail($trainer->user_id);
                $user->cities()->attach($city);
            }

            unset($request['name']);
            unset($request['surname']);
            unset($request['email']);


            $trainer->update($request->all());
            //                        swal('Uaktualniono!', 'Profil został zaktualizowany', 'success');

            return ['title' => 'Uaktualniono!','status' => 'success','message' => 'Profil został zaktualizowany'];
        }

        return ['title' => 'Upsss..!','status' => 'error','message' => 'Coś poszło nie tak :( Spróbuj jeszcze raz!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isAdmin')) {
            $this->authorize('isAdmin');
            $trainer = Trainer::findOrFail($id);
            $trainer->delete();
            return ['message' => 'Trainer deleted'];
        }

        return ['message' => 'Trainer can not be deleted'];
    }

    public function search(){
        $search = \Request::get('q');

        if ($search) {

            $trainer = Trainer::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->with('user')->with('company')->with('disciplines')->paginate(10);

        }
        else{
            $trainer = Trainer::latest()->with('user')->with('company')->with('disciplines')->paginate(10);
        }


        return $trainer;

    }

    public function detachDiscipline()
    {
        if (\Gate::allows('isTrainerOrAdmin')) {
            $disciplineId = \Request::get('disciplineId');
            $trainerId = \Request::get('trainerId');
            $trainer = Trainer::with('disciplines')->findOrFail($trainerId);
            $trainer->disciplines()->detach($disciplineId);
        } else {
            return ['error' => 'Unauthorized access'];
        }
    }

    public function attachDiscipline()
    {
        if (\Gate::allows('isTrainerOrAdmin')) {
            $disciplineId = \Request::get('disciplineId');
            $disciplineIds = \Request::get('disciplinesToAttachIds');
            $disciplinesToDetachIds = \Request::get('disciplinesToDetachIds');
            $trainerId = \Request::get('trainerId');
            if(isset($disciplineId)){
                $isEdit= \Request::get('isEdit');
                $price = \Request::get('price');
                $hoursDuration = \Request::get('hoursDuration');
                $trainer = Trainer::whereHas('disciplines', function ($query) use ($disciplineId) {
                    $query->where('disciplines.id', $disciplineId);
                })->where('id', $trainerId)
                    ->first();

                if($isEdit == 'true') {
                    $trainer->disciplines()->sync([$disciplineId => [ 'price' => $price, 'hoursDuration' => $hoursDuration] ], false);
                } else {
                    if(count($trainer)) {
                        return ['message' => 'Pakiet jest już dostępny w Twojej ofercie! Możesz go edytować przyciskiem do edycji w kolumnie zarządzaj'];
                    } else {
                        error_log('## in else');
                        $trainerId = \Request::get('trainerId');
                        $trainer = Trainer::with('disciplines')->findOrFail($trainerId);
                        $trainer->disciplines()->attach($disciplineId,['price' => $price, 'hoursDuration' => $hoursDuration]);
                    }
                }
            } else {
                error_log('in else Disc');
                $trainer = Trainer::with('disciplines')->findOrFail($trainerId);
                $disciplines = json_encode($disciplineIds);
                $disciplinesDetach = json_encode($disciplinesToDetachIds);
                $disciplinesDetach = CommonUtil::convertIdsFromFrontToArray($disciplinesDetach);
                $disciplines = CommonUtil::convertIdsFromFrontToArray($disciplines);
                error_log(print_r($disciplines,true)); //array log
                $trainer->disciplines()->detach($disciplinesDetach);
                $trainer->disciplines()->attach($disciplines);


//                $trainer = Trainer::with('disciplines')->findOrFail($trainerId);

                return ['message' => 'Jest ok'];

            }


        } else {
            return ['error' => 'Unauthorized access'];
        }
    }

    public function retrieveTrainerByUserId() {
        if(\Gate::allows('isUserOrTrainerOrAdmin')) {
            $userId = \Request::get('userId');
            error_log('$userId: '.$userId);
            $trainerId = Trainer::where('user_id',$userId)->get()[0];
            return $this->show($trainerId->id);
        }
    }

    public function calculateOpinionsFields() {
        if(\Gate::allows('isAdmin')) {
            $trainers = Trainer::all();
            $trainers->each(function($trainer) {
                $opinions = $trainer->opinions;
                $opinionRateSum = 0;
                $opinionsSize = count($opinions);
                if($opinionsSize != 0) {
                    foreach ($opinions as $opinion) {
                        if($opinion->approved){
                            $opinionRateSum += $opinion->rating;
                        }
                    }
                    $trainer->opinionsAverage = $opinionRateSum/$opinionsSize;
                    $trainer->opinionsSum = $opinionsSize;
                }
                $trainer->save();
            });
        }
    }

}
