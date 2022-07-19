<?php
namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        /*
        $data = [
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 1,
        6 => 1,
        7 => 2,
        8 => 4,
        9 => 1,
        10 => 1,
        11 => 6,
        12 => 8,
        ];*/
        $data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $parentIdColumnData = [0, 0, 0, 0, 2, 4, 1, 1, 3, 1, 2, 1];
        $newResult = [];

        for($i = 0; $i < count($data); $i++){
            for($j = 0; $j < count($parentIdColumnData); $j++){
                if($parentIdColumnData[$j] == $data[$i]){
                    $newResult[$data[$i]] = $parentIdColumnData[$j];
                }
            }
        }
        dd();
        $data = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 1,
            6 => 1,
            7 => 2,
            8 => 4,
            9 => 1,
            10 => 1,
            11 => 6,
            12 => 8,
        ];
        $result = [];
        foreach($data as $key => $value){
            // for($j = 0; $j < count($parentIdColumnData); $j++){
            //     if($parentIdColumnData[$j] == $data[$i]){

            //     }
            // }
        }
        dd();
    }
    //$parentIdColumnData = [0, 0, 0, 0, 2, 4, 1, 1, 3, 1, 2, 1];
    public function getChildDataResult($parentItemArray, $currentValue)
    {
        $resultChildArray = [];
        if (count($parentItemArray) > 0) {
            for ($i = 0; $i < count($parentItemArray); $i++) {
                if ($currentValue == $parentItemArray[$i]) {
                    //$resultChildArray[$currentValue]
                }
            }
        }
    }
}
