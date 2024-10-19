<?php

namespace App\Livewire\Cms\Merchant;

use App\Livewire\Forms\Cms\Merchant\FormProduct;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\ProductType;
use App\Models\Product as ProductModel;
use BaseComponent;

class Product extends BaseComponent
{
    use WithFileUploads;

    public FormProduct $form;
    public $title = 'Merchant Menus';

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
        $paginate = 10,
        $orderBy = 'name',
        $order = 'asc';

    public $types = [];

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $image;

    public function mount() {
        $this->types = ProductType::all();
    }

    public function render()
    {
        $get = $this->getDataWithFilter(
            model: ProductModel::with('productType', 'media.model'),
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.merchant.product', compact('get'))->title($this->title);
    }

    public function customSave() {
        $this->form->image = $this->image;

        $this->save();

        $this->image = null;
    }
}
