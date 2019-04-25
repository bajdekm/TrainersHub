<?php
/**
 * Created by PhpStorm.
 * User: mbajdek
 * Date: 2019-03-31
 * Time: 12:43
 */

namespace App\SystemInfoWrapper;


use App\SystemInfoWrapper\InfoEntity;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class UserInfo extends InfoEntity implements InfoEntityInterface
{

    public function getType()
    {
        return $this->type;
    }

    public function getToday()
    {
        $date = Carbon::today()->subDays(1);
        $this->today = User::whereHas('roles', function ($query) {
            $query->where('roles.name', 'user');
        })->where('created_at', '>=', $date)
            ->count();
        return $this->today;
    }

    public function getLastMonth()
    {
        $date = Carbon::today()->subDays(30);
        $this->lastMonth = User::whereHas('roles', function ($query) {
            $query->where('roles.name', 'user');
        })->where('created_at', '>=', $date)
            ->count();
        return $this->lastMonth;
    }

    public function getMales()
    {
        $this->males = User::whereHas('roles', function ($query) {
            $query->where('roles.name', 'user');
        })->where('sex','m')
            ->count();
        return $this->males;
    }

    public function getFemales()
    {
        $this->females = User::whereHas('roles', function ($query) {
            $query->where('roles.name', 'user');
        })->where('sex','f')
            ->count();
        return $this->females;
    }

    public function retrieveData()
    {
        $this->getTotal();
        $this->getToday();
        $this->getLastWeek();
        $this->getLastMonth();
        $this->getMales();
        $this->getFemales();



    }

    public function getLastWeek()
    {
        $date = Carbon::today()->subDays(7);
        $this->lastWeek = User::whereHas('roles', function ($query) {
            $query->where('roles.name', 'user');
        })->where('created_at', '>=', $date)
            ->count();

        return $this->lastWeek;
    }

    public function getTotal()
    {
        $this->total = User::whereHas('roles', function ($query) {
            $query->where('roles.name', 'user');
        })
        ->count();

        return $this->total;
    }

    public function getObjects()
    {
        // TODO: Implement getObjects() method.
    }
}