<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Backened\PostsCategoryModel;

class PostsCategoryRootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_data = User::where('email', 'sudiptocsi@gmail.com')->first();
        if ($user_data) {
            $param = array(
                [
                    'category_name' => 'verses',
                    'category_name_bangla' => 'কবিতা সমগ্র',
                    'category_slug' => 'verses',
                    'category_slug_bangla' => 'কবিতা সমগ্র',
                    'parent_id' => 0,
                    'created_by_user_id' => $user_data['id'],
                ],
                [
                    'category_name' => 'songs',
                    'category_name_bangla' => 'গান',
                    'category_slug' => 'songs',
                    'category_slug_bangla' => 'গান',
                    'parent_id' => 0,
                    'created_by_user_id' => $user_data['id'],
                ],
                [
                    'category_name' => 'novels',
                    'category_name_bangla' => 'উপন্যাস',
                    'category_slug' => 'novels',
                    'category_slug_bangla' => 'উপন্যাস',
                    'parent_id' => 0,
                    'created_by_user_id' => $user_data['id'],
                ],
                [
                    'category_name' => 'stories',
                    'category_name_bangla' => 'গল্পসমূহ',
                    'category_slug' => 'verses',
                    'category_slug_bangla' => 'গল্পসমূহ',
                    'parent_id' => 0,
                    'created_by_user_id' => $user_data['id'],
                ],
                [
                    'category_name' => 'plays',
                    'category_name_bangla' => 'নাটক',
                    'category_slug' => 'plays',
                    'category_slug_bangla' => 'নাটক',
                    'parent_id' => 0,
                    'created_by_user_id' => $user_data['id'],
                ],
                [
                    'category_name' => 'essays',
                    'category_name_bangla' => 'প্রবন্ধ',
                    'category_slug' => 'essays',
                    'category_slug_bangla' => 'প্রবন্ধ',
                    'parent_id' => 0,
                    'created_by_user_id' => $user_data['id'],
                ],
            );
            foreach($param as $row){
                PostsCategoryModel::create([
                    'category_name' => $row['category_name'],
                    'category_name_bangla' => $row['category_name_bangla'],
                    'category_slug' => $row['category_name'],
                    'category_slug_bangla' => $row['category_name_bangla'],
                    'created_by_user_id' => $row['created_by_user_id']
                ]);
            }
        }
    }
}
