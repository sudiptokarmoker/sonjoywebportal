<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class CounsellorTypeRoleUserCountCard extends Component
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
        return view('components.counsellor-type-role-user-count-card', [
            'all_users_with_counsellor_role' => $this->getCounsellorCountByUserRoleCount()
        ]);
    }
}
