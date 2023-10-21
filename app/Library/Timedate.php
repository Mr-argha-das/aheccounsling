<?php
namespace App\Library;
#use Carbon\Carbon;
#use Carbon\CarbonPeriod;
class Timedate {

    public static $intlStatus = false;

    public static function inti(){
        self::$intlStatus = true;
    }

    public function __construct()
    {
        if(empty(self::$intlStatus))
        {
            self::inti();
        }
    }

    public function dateFormat($date,$type="NULL")
    {
        $type=($type==NULL)?$type='in':$type;

        if($date=="0000-00-00" || $date=="00-00-0000" || empty($date))
        {
            if($type=='out' || $type=='monthOut' || $type ='timestampOut'){
                return false;
            }else{
                return "0000-00-00";
            }

        }

        if(date_create($date)){/*check date is correct or not*/
            $dt= new \DateTime($date);
            if($type=='in')
            {
                $newDate=$dt->format('Y-m-d');
            }
            if($type=='monthOut')
            {
                $newDate=$dt->format('M / Y');
            }
            if($type=='yearOut')
            {
                $newDate=$dt->format('Y');
            }
            if($type=='out'){
                $newDate=$dt->format('d-M-Y');
            }
            if($type=='dayOut'){
                $newDate=$dt->format('D , d-M-Y');
            }
            if($type=='timestampOut')
            {
                $newDate=$dt->format('j F, Y, g:i a');
            }
            if($type=='timestampIn')
            {
                $newDate=$dt->format('Y-m-d H:i:s');
            }
            if(empty($newDate))
            {
                $newDate = $dt->format($type);
            }
            return $newDate;
        }
        else {return "Error in Date (".$newDate.",".$type.")";}
    }


}