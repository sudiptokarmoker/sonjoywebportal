<?php
namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        $data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $parentIdColumnData = [0, 0, 0, 0, 2, 4, 1, 1, 3, 1, 2, 1];
        $newResult = [];
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        echo '<pre>';
        print_r($parentIdColumnData);
        echo '</pre>';
        for ($i = 0; $i < count($data); $i++) {
            $counter = 0;
            $subArray = [];
            for ($j = 0; $j < count($parentIdColumnData); $j++) {
                if ($data[$i] == $parentIdColumnData[$j]) {
                    //$newResult[$data[$i]] = $parentIdColumnData[$j];
                    //$newResult[$data[$i]] = $j;
                    $subArray[] = $j;
                    $counter++;
                }
            }
            if(count($subArray) == 0){
                $newResult[$data[$i]] = null;
            } else {
                $newResult[$data[$i]] = $subArray;
            }
        }
        dd($newResult);
        dd("end");
        
        $data = [
            [1 => 0],
            [2 => 0],
            [3 => 0],
            [4 => 0],
            [5 => 2],
            [6 => 2],
            [7 => 1],
            [8 => 1],
            [9 => 0],
            [10 => 0],
            [11 => 0],
            [12 => 0],
        ];

        echo '<pre>';
        foreach($data as $key => $item){
            for($i = $key; $i < count($data); $i++){
                
            }
        }
        echo '</pre>';
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
        $resultNew = [];
        while(1){
            foreach($data as $key => $item){
                
            }
        }
        foreach($data as $key => $item){

        }
        dd();
        $data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $parentIdColumnData = [0, 0, 0, 0, 2, 4, 1, 1, 3, 1, 2, 1];
        $newResult = [];

        for ($i = 0; $i < count($data); $i++) {
            $counter = 0;
            // $this->getChildDataResult($parentIdColumnData, $data[$i]);
            for ($j = 0; $j < count($parentIdColumnData); $j++) {
                if ($data[$i] == $parentIdColumnData[$j]) {
                    //$newResult[$data[$i]] = $parentIdColumnData[$j];
                    $newResult[$data[$i]] = $j;
                    $counter++;
                }
            }
            if($counter == 0){
                $newResult[$data[$i]] = null;
            }
        }
        dd($newResult);
    }
    //$parentIdColumnData = [0, 0, 0, 0, 2, 4, 1, 1, 3, 1, 2, 1];
    public function getChildDataResult($parentItemArray, $currentValue)
    {
        $resultChildArray = [];
        for ($i = 0; $i < count($parentItemArray); $i++) {
            if ($currentValue == $parentItemArray[$i]) {
                $resultChildArray[$currentValue] = $parentItemArray[$i];
                return $this->getChildDataResult();
            }
        }
    }
}
