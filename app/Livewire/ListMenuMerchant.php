<?php

namespace App\Livewire;

use App\Enums\Active;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Livewire\Attributes\Url;
use BaseComponent;

class ListMenuMerchant extends BaseComponent
{
    public $title = 'List Menu - ';

    public $merchant;

    #[Url(keep: true)]
    public $type = 'all';
    public $productTypes = [];

    public $searchBy = [
            [
                'name' => 'Type',
                'field' => 'productType.name',
            ],
            [
                'name' => 'Photo',
                'field' => 'media.model.file_name',
            ],
            [
                'name' => 'Name',
                'field' => 'title',
            ],
            [
                'name' => 'Slug',
                'field' => 'slug',
            ],
            [
                'name' => 'Description',
                'field' => 'description',
            ],
            [
                'name' => 'Price',
                'field' => 'price',
            ],
            [
                'name' => 'Status',
                'field' => 'active',
            ],
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 8,
        $orderBy = 'title',
        $order = 'asc';

    public function mount($id) {
        $this->merchant = User::find($id);
        $this->title .= $this->merchant?->merchant?->name ?? $this->merchant?->name;
        $this->productTypes = ProductType::all();
    }

    public function render()
    {
        $get = $this->getDataWithFilter(
            model: Product::with('productType', 'media.model')->where('user_id', $this->merchant->id),
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.list-menu-merchant', compact('get'))->title($this->title);
    }

    public function addToChart($id) {
        if(auth()->user()) {
            $cart = Cart::firstOrCreate([
                'user_id' => auth()->user()->id,
                'merchant_id' => $this->merchant->id,
                'active' => Active::Active->value,
            ]);

            CartDetail::firstOrCreate([
                'cart_id' => $cart->id,
                'product_id' => $id,
            ], [
                'quantity' => 0,
            ])->increment('quantity', 1);

            $this->dispatch('add-to-cart');
        } else {
            $this->redirectRoute('login');
        }
    }
}
