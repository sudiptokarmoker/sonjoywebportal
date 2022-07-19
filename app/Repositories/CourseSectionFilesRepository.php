<?php
namespace App\Repositories;

use App\Models\Backened\CourseSectionFilesModel;
use App\Models\Backened\CourseSectionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class CourseSectionFilesRepository implements CourseSectionFilesRepositoryInterface
{
    public function getAllCourseFilesBySectionId($section_id)
    {
        return CourseSectionFilesModel::where('section_id', $section_id)
            ->orderBy("id", "asc")
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->id,
                    'course_id' => $row->course_id,
                    'section_id' => $row->section_id,
                    'file_title' => $row->file_title,
                    'file_details' => $row->file_details,
                    'file_name' => $row->file_name && Storage::disk('local')->exists('files/course/' . $row->file_name) ? $row->file_name : null,
                    'files_thumb_name' => $row->files_thumb_name && Storage::disk('local')->exists('images/course/thumb/' . $row->files_thumb_name) ? $row->files_thumb_name : null,
                ];
            });
    }
    public function findById($id)
    {

    }
    public function save(array $data)
    {
        /**
         * Upload new file
         */
        $filesInfo = seoUrl($data['file_title']) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['uploadedFile']->extension());
        //$data['uploadedFile']->storeAs('public/files/course', $filesInfo);
        $data['uploadedFile']->storeAs('files/course', $filesInfo);
        // lets test this
        /**
         * upload thumbnail files
         */
        $thumbFilesInfo = null;
        if (isset($data['uploadedThumbFile'])) {
            $thumbFilesInfo = seoUrl($data['file_title']) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['uploadedThumbFile']->extension());
            //$data['uploadedThumbFile']->storeAs('public/images/course/thumb', $thumbFilesInfo);
            $data['uploadedThumbFile']->storeAs('images/course/thumb', $thumbFilesInfo);
            /**
             *
             * Now just make a thumbnail copy of this item
             */
            $image = $data['uploadedThumbFile'];
            //$destinationSavedPath = storage_path('app/public/images/course/thumb');
            $destinationSavedPath = storage_path('app/images/course/thumb');
            $img = Image::make($image->path());
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationSavedPath . '/' . $thumbFilesInfo);
        }
        /**
         * save data
         */
        CourseSectionFilesModel::create([
            'course_id' => $data['hdn_course_id'],
            'section_id' => $data['section_id'],
            'file_title' => $data['file_title'],
            'file_details' => $data['file_details'],
            'file_name' => $filesInfo,
            'file_type' => $data['uploadedFile']->extension(),
            'files_thumb_name' => $thumbFilesInfo,
        ]);
        return;
    }
    
    public function delete($id)
    {
        $loadFilesEditedModel = CourseSectionFilesModel::findOrFail($id);
        // now delete assets files
        if (Storage::disk('local')->exists('images/course/thumb/' . $loadFilesEditedModel->files_thumb_name)) {
            Storage::disk('local')->delete('images/course/thumb/' . $loadFilesEditedModel->files_thumb_name);
        }
        if (Storage::disk('local')->exists('files/course/' . $loadFilesEditedModel->file_name)) {
            Storage::disk('local')->delete('files/course/' . $loadFilesEditedModel->file_name);
        }
        $loadFilesEditedModel->delete();
        return;
    }

    public function checkCourseSectionIsValidOwnerOrNot($section_id)
    {
        $courseSectionData = CourseSectionModel::where('id', $section_id)
            ->with(['courseModel'])
            ->first();
        if ($courseSectionData && $courseSectionData->courseModel->created_by_user_id == Auth::user()->id) {
            return $courseSectionData->course_id;
        } else {
            return false;
        }
    }
    /**
     * check the course edit request is valid or not
     */
    public function checkCourseEditedOwnerShipIsValidOrNot($course_id)
    {
        // $course id
    }
    /**
     * render files for edit
     */
    public function editRenderFiles($file_id)
    {
        $item = CourseSectionFilesModel::findOrFail($file_id);
        return [
            'id' => $item->id,
            'course_id' => $item->course_id,
            'section_id' => $item->section_id,
            'file_title' => $item->file_title,
            'file_details' => $item->file_details,
            'file_name' => $item->file_name && Storage::disk('local')->exists('files/course/' . $item->file_name) ? $item->file_name : null,
            'files_thumb_name' => $item->files_thumb_name && Storage::disk('local')->exists('images/course/thumb/' . $item->files_thumb_name) ? $item->files_thumb_name : null,
        ];
    }
    /**
     * update
     */
    public function update(array $data)
    {
        $loadFilesEditedModel = CourseSectionFilesModel::findOrFail($data['id']);
        //dd($loadFilesEditedModel);
        // task on thumb files
        if (isset($data['uploadedThumbFile'])) {
            if (Storage::disk('local')->exists('images/course/thumb/' . $loadFilesEditedModel->files_thumb_name)) {
                Storage::disk('local')->delete('images/course/thumb/' . $loadFilesEditedModel->files_thumb_name);
            }
            /**
             * now upload new files
             */
            $thumbFilesInfo = seoUrl($data['file_title']) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['uploadedThumbFile']->extension());
            $data['uploadedThumbFile']->storeAs('images/course/thumb', $thumbFilesInfo);
            /**
             *
             * Now just make a thumbnail copy of this item
             */
            $image = $data['uploadedThumbFile'];
            $destinationSavedPath = storage_path('app/images/course/thumb');
            $img = Image::make($image->path());
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationSavedPath . '/' . $thumbFilesInfo);
            // updated db
            $loadFilesEditedModel->files_thumb_name = $thumbFilesInfo;
        }
        /**
         * end of thumb files
         */
        /**
         * Upload new file if there is new
         */
        if (isset($data['uploadedFile'])) {
            // delete the old files if any there
            if (Storage::disk('local')->exists('files/course/' . $loadFilesEditedModel->file_name)) {
                Storage::disk('local')->delete('files/course/' . $loadFilesEditedModel->file_name);
            }
            $filesInfo = seoUrl($data['file_title']) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['uploadedFile']->extension());
            $data['uploadedFile']->storeAs('files/course', $filesInfo);
            // updated db
            $loadFilesEditedModel->file_name = $filesInfo;
            $loadFilesEditedModel->file_type = $data['uploadedFile']->extension();
        }
        $loadFilesEditedModel->file_title = $data['file_title'];
        $loadFilesEditedModel->file_details = $data['file_details'];
        $loadFilesEditedModel->update();
        // done
        return $loadFilesEditedModel;
    }
}
