<?php
namespace App\Repositories;

interface CourseSectionFilesRepositoryInterface{
    public function getAllCourseFilesBySectionId($section_id);
    public function findById($id);
    public function save(array $data);
    public function delete($id);
    public function checkCourseSectionIsValidOwnerOrNot($section_id);
    //public function checkFilesEditIsValidOwnerOrNot($file_id);
    public function editRenderFiles($file_id);
    public function update(array $data);
}