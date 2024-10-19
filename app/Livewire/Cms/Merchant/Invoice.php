<?php

namespace App\Livewire\Cms\Merchant;

use App\Models\Checkout;
use BaseComponent;

class Invoice extends BaseComponent
{
    public $title = 'Invoice';
    public $data;

    public function mount($id) {
        $this->data = Checkout::with('user', 'cart', 'cart.details')->find($id);
    }

    public function render()
    {
        return view('livewire.cms.merchant.invoice')->title($this->title);
    }
}
