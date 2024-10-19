<?php

namespace App\Livewire\Cms\Product;

use App\Livewire\Forms\Cms\Product\FormType;
use App\Models\ProductType;
use BaseComponent;

class Type extends BaseComponent
{
    public FormType $form;
    public $title = 'Product Type';

    public $searchBy = [
            [
                'name' => 'Name',
                'field' => 'name',
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
                'name' => 'Status',
                'field' => 'active',
            ],
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'name',
        $order = 'asc';

    public function render()
    {
        $get = $this->getDataWithFilter(
            model: new ProductType,
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.product.type', compact('get'))->title($this->title);
    }
}
