<?php

namespace App\Livewire\Cms;

use App\Enums\Status;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $adminUsers = 0, $adminOrders = 0, $adminMenus = 0, $adminOrdersPaid = 0, $adminOrdersPending = 0;
    public $merchantMenus = 0, $merchantOrders = 0, $merchantOrdersPaid = 0, $merchantOrdersPending = 0;

    public function mount() {
        if(auth()->user()->hasRole('admin')) {
            $this->adminUsers = User::count();
            $this->adminOrders = Checkout::count();
            $this->adminMenus = Product::count();
            $this->adminOrdersPaid = Checkout::where('status', Status::Verified)->sum('total');
            $this->adminOrdersPending = Checkout::where('status', Status::Pending)->sum('total');
        } else if(auth()->user()->hasRole('merchant')) {
            $this->merchantMenus = Product::where('user_id', auth()->user()->id)->count();
            $this->merchantOrders = Checkout::where('merchant_id', auth()->user()->id)->count();
            $this->merchantOrdersPaid = Checkout::where('status', Status::Verified)->where('merchant_id', auth()->user()->id)->sum('total');
            $this->merchantOrdersPending = Checkout::where('status', Status::Pending)->where('merchant_id', auth()->user()->id)->sum('total');
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
