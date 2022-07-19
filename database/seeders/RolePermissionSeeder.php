<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Modified with web guard
         */
        $roleSuperAdmin = Role::create(['guard_name' => 'web', 'name' => 'superadmin']);
        /**
         * Create admin role
         */
        $roleAdmin = Role::create(['guard_name' => 'web', 'name' => 'admin']);
        /**
         * Create a blank role for frontend user
         */
        Role::create(['guard_name' => 'web', 'name' => 'user']);
        /**
         * End of create role for frontend user
         */
        DB::table('permissions_group')->insert([
            ['group_name' => 'dashboard'],
            ['group_name' => 'users'],
            ['group_name' => 'roles'],
            ['group_name' => 'group'],
            ['group_name' => 'permission'],
            ['group_name' => 'posts_category'],
            ['group_name' => 'posts_category_all_general'],
            ['group_name' => 'artists'],
            ['group_name' => 'composer'],
            ['group_name' => 'songs'], // 10
            ['group_name' => 'songs_category'], //11

            ['group_name' => 'verses'], //12
            ['group_name' => 'verses_category'], //13

            ['group_name' => 'novels'], //14
        ]);

        $permissions = [
            [
                'group_id' => 1,
                'permissions' => [
                    'dashboard.view',
                ],
            ],
            [
                'group_id' => 2,
                'permissions' => [
                    'users.list',
                    'users.create.form',
                    'users.save',
                    'users.edit.form.view',
                    'users.update',
                    'users.delete',
                    'users.destroyByHardDelete',
                    'users.restore',
                    'users.restoreUserProcessing',
                ],
            ],
            [
                'group_id' => 3,
                'permissions' => [
                    'roles.list',
                    'roles.create.form.view',
                    'roles.save',
                    'roles.edit.form.view',
                    'roles.update',
                    'roles.delete',
                    'multiple.roles.permission.update',
                ],
            ],
            [
                'group_id' => 4,
                'permissions' => [
                    'group.list',
                    'group.create.form.view',
                    'group.save',
                    'group.edit.form.view',
                    'group.update',
                    'group.delete',
                ],
            ],
            [
                'group_id' => 5,
                'permissions' => [
                    'permission.list',
                    'permission.create.form.view',
                    'permission.save',
                    'permission.edit.form.view',
                    'permission.update',
                    'permission.delete',
                ],
            ],
            [
                'group_id' => 6,
                'permissions' => [
                    'posts_category.list',
                    'posts_category.create.form.view',
                    'posts_category.save',
                    'posts_category.edit.form.view',
                    'posts_category.update',
                    'posts_category.delete',
                ],
            ],
            [
                'group_id' => 7,
                'permissions' => [
                    'posts_category_all_general.list',
                    'posts_category_all_general.create.form.view',
                    'posts_category_all_general.save',
                    'posts_category_all_general.edit.form.view',
                    'posts_category_all_general.update',
                    'posts_category_all_general.delete',
                ],
            ],
            [
                'group_id' => 8,
                'permissions' => [
                    'artists.list',
                    'artists.create.form.view',
                    'artists.save',
                    'artists.edit.form.view',
                    'artists.update',
                    'artists.delete',
                ],
            ],
            [
                'group_id' => 9,
                'permissions' => [
                    'composer.list',
                    'composer.create.form.view',
                    'composer.save',
                    'composer.edit.form.view',
                    'composer.update',
                    'composer.delete',
                ],
            ],
            [
                'group_id' => 10,
                'permissions' => [
                    'songs.list',
                    'songs.create.form.view',
                    'songs.save',
                    'songs.edit.form.view',
                    'songs.update',
                    'songs.delete',
                ],
            ],
            [
                'group_id' => 11,
                'permissions' => [
                    'songs_category.list',
                    'songs_category.create.form.view',
                    'songs_category.save',
                    'songs_category.edit.form.view',
                    'songs_category.update',
                    'songs_category.delete',
                ],
            ],
            // verses category and versas
            [
                'group_id' => 12,
                'permissions' => [
                    'verses.list',
                    'verses.create.form.view',
                    'verses.save',
                    'verses.edit.form.view',
                    'verses.update',
                    'verses.delete',
                ],
            ],
            [
                'group_id' => 13,
                'permissions' => [
                    'verses_category.list',
                    'verses_category.create.form.view',
                    'verses_category.save',
                    'verses_category.edit.form.view',
                    'verses_category.update',
                    'verses_category.delete',
                ],
            ],
            // novels
            [
                'group_id' => 14,
                'permissions' => [
                    'novels.list',
                    'novels.create.form.view',
                    'novels.save',
                    'novels.edit.form.view',
                    'novels.update',
                    'novels.delete',
                ],
            ],
        ];
        /**
         * create group
         */
        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_id'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_id' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                // assiging role for admin user
                if ($permissionGroup == 3 && $permissions[$i]['permissions'][$j] == 'roles.list') {
                    $roleAdmin->givePermissionTo($permission);
                }
                if ($permissionGroup != 3 && $permissionGroup != 4 && $permissionGroup != 5) { // this means we are stopping acces permission group role from admin access auto on all seeder call
                    $roleAdmin->givePermissionTo($permission);
                }
            }
        }
    }
}
