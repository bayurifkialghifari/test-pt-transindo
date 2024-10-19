<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductType;
use BaseComponent;

class Home extends BaseComponent
{
    public $title = 'Marketplace';
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
        $paginate = 8,
        $orderBy = 'title',
        $order = 'asc';

    public $productType = 'all';
    public $productTypes = [];

    public function mount() {
        $this->productTypes = ProductType::all();
    }

    public function render()
    {
        $model = Product::with('productType', 'media.model');

        if ($this->productType != 'all') {
            $model = $model->where('product_type_id', $this->productType);
        }

        $get = $this->getDataWithFilter(
            model: $model,
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.home', compact('get'))->title($this->title);
    }
}
