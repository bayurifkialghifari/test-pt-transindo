<?php

namespace App\Livewire;

use App\Enums\Active;
use App\Enums\Alert;
use App\Models\Cart;
use App\Models\Checkout as ModelsCheckout;
use App\Traits\WithMediaCollection;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use BaseComponent;

class Checkout extends BaseComponent
{
    use WithFileUploads, WithMediaCollection;

    public $title = 'Checkout';

    public $id;
    public $get;
    public $old_data;
    public $total;

    #[Validate('required|image:jpeg,png,jpg,svg|max:2048')]
    public $image;

    public function mount($id) {
        if(!auth()->user()) {
            return $this->redirectRoute('login');
        }

        $this->id = $id;
        $this->old_data = ModelsCheckout::where('cart_id', $id)->first();
        $this->get = Cart::where('user_id', auth()->user()?->id)
            ->where('id', $this->id)
            ->with('merchant', 'details')
            ->withSum('details', 'quantity')
            ->first();

        // Total
        foreach ($this->get->details as $detail) {
            $this->total += $detail->product->price * $detail->quantity;
        }
    }

    public function render()
    {
        return view('livewire.checkout')->title($this->title);
    }

    public function customSave() {
        $this->validate();

        if(!$this->old_data) {
            $this->old_data = ModelsCheckout::create([
                'user_id' => auth()->user()->id,
                'merchant_id' => $this->get->merchant_id,
                'cart_id' => $this->id,
                'total' => $this->total,
                'status' => Active::Inactive,
            ]);
            Cart::find($this->id)->update([
                'active' => Active::Inactive,
            ]);
        }

        // Save image
        if($this->image instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $this->old_data,
                file: $this->image,
            );
        }

        $this->image = null;
        $this->old_data = ModelsCheckout::where('cart_id', $this->id)->first();

        $this->dispatch('alert', type: Alert::success->value, message: 'Data saved successfully');
    }
}
