<?php
/**
 * Created by PhpStorm.
 * User: mbajdek
 * Date: 2019-03-31
 * Time: 12:38
 */

namespace App\SystemInfoWrapper;


interface InfoEntityInterface
{

    public function getType();
    public function getTotal();
    public function getToday();
    public function getLastWeek();
    public function getLastMonth();
    public function getMales();
    public function getFemales();
    public function getObjects();

    public function retrieveData();

}