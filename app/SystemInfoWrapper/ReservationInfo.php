<?php
/**
 * Created by PhpStorm.
 * User: mbajdek
 * Date: 2019-03-31
 * Time: 12:45
 */

namespace App\SystemInfoWrapper;


use App\Reservation;
use App\SystemInfoWrapper\InfoEntity;
use App\User;
use Carbon\Carbon;

class ReservationInfo extends InfoEntity implements InfoEntityInterface
{

    public function getType()
    {
        return $this->type;
    }

    public function getToday()
    {
        $date = Carbon::today()->subDays(1);
        $this->today = Reservation::where('created_at', '>=', $date)->count();
        return $this->today;
    }

    public function getLastMonth()
    {
        $date = Carbon::today()->subDays(30);
        $this->lastMonth = Reservation::where('created_at', '>=', $date)->count();
        return $this->lastMonth;
    }

    public function getMales()
    {

    }

    public function getFemales()
    {

    }

    public function retrieveData()
    {
        $this->getTotal();
        $this->getToday();
        $this->getLastWeek();
        $this->getLastMonth();
    }

    public function getLastWeek()
    {
        $date = Carbon::today()->subDays(7);
        $this->lastWeek = Reservation::where('created_at', '>=', $date)->count();
        return $this->lastWeek;
    }

    public function getTotal()
    {
        $this->total = Reservation::count();
        return $this->total;
    }

    public function getObjects()
    {
        // TODO: Implement getObjects() method.
    }
}