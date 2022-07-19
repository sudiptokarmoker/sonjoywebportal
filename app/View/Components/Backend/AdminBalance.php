<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;
use App\Models\Backened\VendorAccountTransactionModel;

class AdminBalance extends Component
{
    public $totalBalance;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->totalBalance = VendorAccountTransactionModel::adminBalance();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.admin-balance');
    }
}
