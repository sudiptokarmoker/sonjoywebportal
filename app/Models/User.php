<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPermissionsGroupListData()
    {
        //$permission_group_lists = DB::table('permissions_group')->select('*')->orderBy('group_name', 'asc')->get();
        $permission_group_lists = DB::table('permissions_group')->select('*')->orderBy('id', 'asc')->get();
        return $permission_group_lists;
    }

    public static function getPermissionsGroupNameById($group_id)
    {
        return DB::table('permissions')
            ->where('group_id', $group_id)
            ->select('id', 'name', 'group_id')
            ->get();
    }
    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }
    public static function rolePermissionNameListInArray($user)
    {
        $data_array = [];
        $roles = $user->getRoleNames();

        foreach ($roles as $role) {
            $loadRole = \Spatie\Permission\Models\Role::findByName($role);

            $collection = DB::table('role_has_permissions')
                ->where('role_id', $loadRole->id)
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->select('role_has_permissions.*', 'permissions.*')
                ->get();
            if (count($collection) > 0) {
                foreach ($collection as $data) {
                    $data_array[] = $data->name;
                }
            }
        }
        return (count($data_array) > 0 ? array_unique($data_array) : false);
    }
}
