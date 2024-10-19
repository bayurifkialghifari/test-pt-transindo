<?php

namespace App\Livewire\Forms\Cms\Merchant;

use App\Livewire\Contracts\FormCrudInterface;
use App\Models\Product;
use App\Traits\WithMediaCollection;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class FormProduct extends Form implements FormCrudInterface
{
    use WithMediaCollection;

    #[Validate('nullable|numeric')]
    public $id;

    #[Validate('required')]
    public $title;

    #[Validate('required|exists:users,id')]
    public $user_id;

    #[Validate('required|exists:product_types,id')]
    public $product_type_id;

    #[Validate('required')]
    public $description;

    #[Validate('required|numeric')]
    public $price;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $image;

    #[Validate('required')]
    public $active;

    public $old_data;

    // Get the data
    public function getDetail($id) {
        $data = Product::find($id);

        $this->id = $id;
        $this->old_data = $data;
        $this->user_id = $data->user_id;
        $this->product_type_id = $data->product_type_id;
        $this->title = $data->title;
        $this->description = $data->description;
        $this->price = $data->price;
        $this->active = $data->active;
    }

    // Save the data
    public function save() {
        $this->user_id = auth()->user()->id;
        $this->price = str_replace('.', '', $this->price);

        $this->validate();

        if ($this->id) {
            $this->update();
        } else {
            $this->store();
        }

        $this->reset();
    }

    // Store data
    public function store() {
        $data = Product::create($this->only([
            'user_id',
            'product_type_id',
            'title',
            'description',
            'price',
            'active',
        ]));

        // Save image
        if($this->image instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $data,
                file: $this->image,
            );
        }
    }

    // Update data
    public function update() {
        $data = Product::find($this->id);

        // Save image
        if($this->image instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $data,
                file: $this->image,
            );
        }

        $data->update($this->only([
            'user_id',
            'product_type_id',
            'title',
            'description',
            'price',
            'active',
        ]));
    }

    // Delete data
    public function delete($id) {
        Product::find($id)->delete();
    }
}
