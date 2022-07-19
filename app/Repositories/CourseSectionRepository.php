<?php
namespace App\Repositories;
use App\Models\Backened\CourseSectionModel;

class CourseSectionRepository implements CourseSectionRepositoryInterface{
    public function delete($id){
        CourseSectionModel::findOrFail($id)->delete();
        return;   
    }
}