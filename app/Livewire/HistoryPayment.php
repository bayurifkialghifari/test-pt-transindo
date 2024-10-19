<?php

namespace App\Livewire;

use App\Models\Checkout;
use BaseComponent;

class HistoryPayment extends BaseComponent
{
    public $title = 'History Payment';

    public function mount() {
        if(!auth()->user()) {
            return $this->redirectRoute('login');
        }
    }

    public function render()
    {
        $get = Checkout::where('user_id', auth()->user()?->id)
            ->with('merchant')
            ->get();

        return view('livewire.history-payment', compact('get'))->title($this->title);
    }
}
