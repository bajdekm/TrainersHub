<?php

namespace App\Http\Controllers\API;

use App\Reservation;
use App\Trainer;
use App\Utils\CommonUtil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        if (\Gate::allows('isAdmin') || \Gate::allows('isTrainer')) {

            return Reservation::latest()
                ->with('user')
                ->with('disciplineTrainer')
                ->with('gym')
                ->with('trainer')
                ->with('discipline')
                ->paginate(10);
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
        return Reservation::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Gate::allows('isUserOrTrainerOrAdmin')) {
            error_log('@@ show: '.$id);
//            return Reservation::with('gym')->where('user.id',$id);
            return Reservation::with('gym')->where('user.id',$id);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTrainerReservations()
    {
        error_log('@@ showUserReservations: ');
        if(\Gate::allows('isUserOrTrainerOrAdmin')) {
            $userId = \Request::get('userId');
            $trainer = Trainer::where('user_id',$userId)->pluck('id');
            return Reservation::latest()
                ->with('user')
                ->with('gym')
                ->with('trainer')
                ->with('disciplineTrainer.discipline')
                ->where('trainer_id',$trainer)
                ->paginate(9);
        }
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
        if (\Gate::allows('isAdmin')) {
            $reservation = Reservation::findOrFail($id);
            $reservation->update($request->all());
            return ['message' => 'Updated the reservation info'];
        }

        return ['message' => 'Reservation can not be updated'];
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
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            return ['message' => 'Reservation deleted'];

        }

        return ['message' => 'Reservation can not be deleted'];
    }

    public function search(){
        $from = \Request::get('from');
        $to = \Request::get('to');
        $search = \Request::get('q');
        if ($search && $from && $to) {
            $reservation = Reservation::where(function ($queryMain) use ($search){
                $queryMain->whereHas('user', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('trainer', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('gym', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('discipline', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                });
            })->where('trainingStart','>',"$from")->where('trainingStart','<',$to)
                ->with('user')
                ->with('disciplineTrainer')
                ->with('gym')
                ->with('trainer')
                ->with('discipline')
                ->paginate(10);
            return $reservation;

        } else if($search && $from) {
            $reservation = Reservation::where(function ($queryMain) use ($search){
                $queryMain->whereHas('user', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('trainer', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('gym', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('discipline', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                });
            })->where('trainingStart','>',"$from")
                ->with('user')
                ->with('disciplineTrainer')
                ->with('gym')
                ->with('trainer')
                ->with('discipline')
                ->paginate(10);
            return $reservation;
        } else if($search && $to) {
            error_log('To:2 '.$to);
            $reservation = Reservation::where(function ($queryMain) use ($search){
                $queryMain->whereHas('user', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('trainer', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('gym', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })->orWhereHas('discipline', function($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                });
            })->where('trainingStart','<',"$to")
                ->with('user')
                ->with('disciplineTrainer')
                ->with('gym')
                ->with('trainer')
                ->with('discipline')
                ->paginate(10);
            return $reservation;
        } else if ($search) {
            error_log('$search:2 '.$search);
            $reservation = Reservation::whereHas('user', function($query) use ($search) {
                $query->where('name','LIKE',"%$search%");
            })->orWhereHas('trainer', function($query) use ($search) {
                $query->where('name','LIKE',"%$search%");
            })->orWhereHas('gym', function($query) use ($search) {
                $query->where('name','LIKE',"%$search%");
            })->orWhereHas('discipline', function($query) use ($search) {
                $query->where('name','LIKE',"%$search%");
            })->with('user')
                ->with('disciplineTrainer')
                ->with('gym')
                ->with('trainer')
                ->with('discipline')
                ->paginate(10);
            return $reservation;
        } else {
            return Reservation::latest()
                ->with('user')
                ->with('disciplineTrainer')
                ->with('gym')
                ->with('trainer')
                ->with('discipline')
                ->paginate(10);
        }
    }
}
