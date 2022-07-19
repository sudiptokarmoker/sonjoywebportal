<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_param = array(
            array('email' => 'sudiptocsi@gmail.com', 'first_name' => 'sudipto', 'last_name' => 'karmoker' ,'password' => 'admin1234'),
        );
        foreach ($user_param as $row) {
            $user_data = User::where('email', $row['email'])->first();
            if (is_null($user_data)) {
                $userModel = new User();
                $userModel->first_name = $row['first_name'];
                $userModel->last_name = $row['last_name'];
                $userModel->email = $row['email'];
                $userModel->password = Hash::make($row['password']);
                $userModel->isAdmin = true;
                $userModel->verified = 1;
                $userModel->uid = (string) Str::uuid();
                $userModel->save();
                //assigning superadmin roles to this user by default
                $userModel->assignRole('superadmin');
            }
        }
        /**
         * Seeker user seeder
         */
        $admin_user_param = array(
            array('email' => 'sudiptocsi+2@gmail.com', 'first_name' => 'sudipto', 'password' => 'password'),
        );
        foreach ($admin_user_param as $row) {
            $user_data = User::where('email', $row['email'])->first();
            if (is_null($user_data)) {
                $userModel = new User();
                $userModel->first_name = $row['first_name'];
                $userModel->email = $row['email'];
                $userModel->password = Hash::make($row['password']);
                $userModel->isAdmin = true;
                $userModel->verified = 1;
                $userModel->uid = (string) Str::uuid();
                $userModel->save();
                //assigning superadmin roles to this user by default
                $userModel->assignRole('admin');
            }
        } 
        /**
         * End of creatign counsellor type user
         */
    }
}
