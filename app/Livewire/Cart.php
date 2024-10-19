<?php

namespace App\Livewire;

use App\Enums\Active;
use App\Enums\Alert;
use App\Models\Cart as ModelsCart;
use App\Models\CartDetail;
use Livewire\Attributes\On;
use BaseComponent;

class Cart extends BaseComponent
{
    public $title = 'Cart';

    public function mount() {
        if(!auth()->user()) {
            return $this->redirectRoute('login');
        }
    }

    public function render()
    {
        $get = ModelsCart::where('active', Active::Active)
            ->where('user_id', auth()->user()?->id)
            ->with('merchant', 'details')
            ->withSum('details', 'quantity')
            ->get();

        return view('livewire.cart', compact('get'))->title($this->title);
    }

    public function confirmDeleteDetail($id) {
        $this->dispatch('confirm', function: 'delete-detail', id: $id);
    }

    #[On('delete-detail')]
    public function deleteDetail($id) {
        CartDetail::find($id)->delete();

        $this->dispatch('remove-from-cart');
        $this->dispatch('alert', type: Alert::success->value, message: 'Data deleted successfully');
    }

    public $detail_id;
    public $name;
    public $quantity;

    public function editDetail($id) {
        $this->openModal();

        $data = CartDetail::find($id);

        $this->detail_id = $id;
        $this->name = $data->product?->title;
        $this->quantity = $data->quantity;
    }

    public function updateDetail() {
        $data = CartDetail::find($this->detail_id);

        $data->update([
            'quantity' => $this->quantity,
        ]);

        $this->dispatch('alert', type: Alert::success->value, message: 'Data updated successfully');
        $this->dispatch('update-from-cart');
        $this->closeModal();
    }
}
