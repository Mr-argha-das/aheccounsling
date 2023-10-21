<?php

namespace App\Helpers;



class Design {



    public static $dmStart="";

    public static $dmClose="";

    public static $count=0;

    public static $instance=0;

    public static $filterStart="";

    public static $filterClose="";

    public static $filterCloseExcel="";

    public static function inti(){

        self::$dmStart='<div class="dropmenu"><div class="dropmenu-container"><span class="dropmenu-clicker"><i class="fas fa-ellipsis-v"></i></span><div class="dropmenu-list">';

        self::$dmClose='</div></div></div>';

        self::$instance++;

        self::$filterStart=self::sectionStart('Filter').'<div class="pb-3">

    <form method="GET" action="'.url()->current().'" accept-charset="UTF-8">

        <div class="row">

        ';

        self::$filterClose='

       <div class="col-md-12">

                <input class="btn btn-info" type="submit" value="Submit">

                <a class="btn btn-secondary ml-2" href="'.url()->current().'">Reset</a>

            </div>

        </div>

        </form></div>'.self::sectionClose();

        self::$filterCloseExcel='

       <div class="col-md-12">

                <input class="btn btn-info" type="submit" value="Submit">

                <a class="btn btn-secondary ml-2" href="'.url()->current().'">Reset</a>

                <input class="btn btn-success" type="submit" name="excel" value="export submit">

            </div>

        </div>

        </form></div>'.self::sectionClose();

    }

    public function __construct($count = 0){

        self::inti();

    }



    static function generate($length = 8) {

        return $length;

    }



    static function sectionStart($title=NULL)

    {

        return '<div class="block">

    <div class="block-header">

        <h3 class="block-title">'.$title.'

            <!--<small>Find Records</small>-->

        </h3>

        <div class="block-options">

            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>

            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">

                <i class="si si-pin"></i>

            </button>

            <!-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">

<i class="si si-refresh"></i>

</button>-->

            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>

            <!--  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">

<i class="si si-close"></i>

</button>-->

        </div>

    </div>



    <div class="block-content p-md-4 p-2 pb-3">';

    }

    static function sectionClose()

    {

        return '</div></div>';

    }

    static function tableSectionStart($title=NULL)

    {

        return '<div class="table-responsive" id="tbl">'.self::sectionStart($title);

    }

    static function tableSectionClose()

    {

        return '</div>'.self::sectionClose();

    }

    public static function excelExport($url=NULL) {

          return '<div class="col-md-12">
                <input class="btn btn-info" type="submit" value="Submit">
                <a class="btn btn-secondary ml-2" href="'.url()->current().'">Reset</a>
                <A href="'.$url.'" class="btn btn-sm btn-success">Export Excel</a> 
                </div> 
                </div>
              </form></div>'.self::sectionClose();

    }

}

