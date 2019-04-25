<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Utils\RedisManager;
use App\InfoEntity;
use App\SystemInfoWrapper\InfoEntityInterface;
use App\SystemInfoWrapper\MessageInfo;
use App\SystemInfoWrapper\ReservationInfo;
use App\SystemInfoWrapper\TrainerInfo;
use App\SystemInfoWrapper\UserInfo;
use App\SystemInfoWrapper\UsersOnlineInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemInfoController extends Controller
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
        //
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
    public function show($id)
    {
        //
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

    public function sendServerInfo(){
        $returnData = [];


        $usersInfo = new UserInfo('user');
        $usersInfo->retrieveData();
        array_push( $returnData , $usersInfo);

        $trainersInfo = new TrainerInfo( 'trainer' );
        $trainersInfo->retrieveData();
        array_push($returnData , $trainersInfo);

        $reservationsInfo = new ReservationInfo( 'reservation' );
        $reservationsInfo->retrieveData();
        array_push($returnData , $reservationsInfo);

        $messagesInfo = new MessageInfo( 'message' );
        $messagesInfo->retrieveData();
        array_push($returnData , $messagesInfo);

        return $returnData;
    }

}
