<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    //public $all_users_with_user_role;
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
     * get user count
     */
    public function getCounsellorCountByUserRoleCount(){
        return User::role('counsellor')->count();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-card', [
            'all_users_with_user_role' => $this->getUserCountByUserRoleCount(),
            'all_users_with_counsellor_role' => $this->getCounsellorCountByUserRoleCount()
        ]);
    }
}
