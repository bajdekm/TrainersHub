<?php
/**
 * Created by PhpStorm.
 * User: mbajdek
 * Date: 2019-03-31
 * Time: 12:32
 */

namespace App\SystemInfoWrapper;


class InfoEntity
{
    public $type;
    public $total;
    public $today;
    public $lastWeek;
    public $lastMonth;
    public $males;
    public $females;
    public $objects;


    function __construct( $type )
    {
        $this->type = $type;
    }

}