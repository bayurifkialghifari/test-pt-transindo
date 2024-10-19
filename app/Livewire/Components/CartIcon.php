<?php

namespace App\Livewire\Components;

use App\Enums\Active;
use App\Models\Cart;
use Livewire\Attributes\On;
use BaseComponent;

class CartIcon extends BaseComponent
{
    public $total = 0;

    #[On('add-to-cart')]
    public function add() {
        $this->total++;
    }

    #[On('remove-from-cart')]
    public function remove() {
        $this->count();
    }

    #[On('update-from-cart')]
    public function count() {
        $carts = Cart::where('active', Active::Active)->where('user_id', auth()->user()?->id)->withSum('details', 'quantity')->get();

        $this->total = 0;

        foreach ($carts as $cart) {
            $this->total += $cart->details_sum_quantity;
        }
    }

    public function mount() {
        $this->count();
    }

    public function render()
    {
        return view('livewire.components.cart-icon');
    }
}
