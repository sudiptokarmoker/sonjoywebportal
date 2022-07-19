<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class UserTypeRoleUserCountCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * get user count
     */
    public function getUserCountByUserRoleCount(){
        return User::role('user')->count();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-type-role-user-count-card', [
            'all_users_with_user_role' => $this->getUserCountByUserRoleCount()
        ]);
    }
}
