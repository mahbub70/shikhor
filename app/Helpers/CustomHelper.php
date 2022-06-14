<?php 
namespace App\Helpers;

use Illuminate\Support\Arr;

class CustomHelper {

    public static function get_class_type($int) {
        $types = [0=>"Free Class",1=>"Class Video",2=>"Live Video"];

        if(!is_numeric($int)) {
            return "Bad Argument";
        }else {
            $slice = Arr::pull($types, $int);
            if(strlen($slice) >= 0) {
                return $slice;
            }else {
                return 'Null';
            }
        }
    }


}