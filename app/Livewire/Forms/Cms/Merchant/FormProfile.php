<?php

namespace App\Livewire\Forms\Cms\Merchant;

use App\Models\Merchant;
use App\Traits\WithMediaCollection;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class FormProfile extends Form
{
    use WithMediaCollection;

    #[Validate('required')]
    public $name;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|numeric')]
    public $phone;

    #[Validate('nullable')]
    public $address;

    #[Validate('nullable')]
    public $description;

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $image;

    public $old_data;

    public function getData() {
        $data = Merchant::where('user_id', auth()->user()->id)->first();

        $this->old_data = $data;
        $this->name = $data?->name;
        $this->email = $data?->email;
        $this->phone = $data?->phone;
        $this->address = $data?->address;
        $this->description = $data?->description;
    }

    public function save() {
        $this->validate();

        // Save data
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();

        if(!$merchant) {
            $merchant = Merchant::create([
                'user_id' => auth()->user()->id,
                'name' => 'Merchant',
            ]);
        }

        // Save image
        if($this->image instanceof TemporaryUploadedFile) {
            $this->saveFile(
                model: $merchant,
                file: $this->image,
            );
        }

        $merchant->update($this->only([
            'name',
            'email',
            'phone',
            'address',
            'description',
        ]));

        $this->getData();
    }
}
