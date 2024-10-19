<?php

namespace App\Livewire\Forms\Cms\Product;

use App\Livewire\Contracts\FormCrudInterface;
use App\Models\ProductType;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormType extends Form implements FormCrudInterface
{
    #[Validate('nullable|numeric')]
    public $id;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $description;

    #[Validate('required')]
    public $active;

    // Get the data
    public function getDetail($id) {
        $data = ProductType::find($id);

        $this->id = $id;
        $this->name = $data->name;
        $this->description = $data->description;
        $this->active = $data->active;
    }

    // Save the data
    public function save() {
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
        ProductType::create($this->only([
            'name',
            'description',
            'active',
        ]));
    }

    // Update data
    public function update() {
        ProductType::find($this->id)->update($this->all());
    }

    // Delete data
    public function delete($id) {
        ProductType::find($id)->delete();
    }
}
