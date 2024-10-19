<?php

namespace App\Livewire\Cms\Merchant;

use App\Livewire\Forms\Cms\Merchant\FormProfile;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use BaseComponent;

class Profile extends BaseComponent
{
    use WithFileUploads;

    public FormProfile $form;
    public $title = 'Merchant Profile';

    #[Validate('nullable|image:jpeg,png,jpg,svg|max:2048')]
    public $image;

    public $isUpdate = true;

    public function mount() {
        $this->form->getData();
    }

    public function render()
    {
        return view('livewire.cms.merchant.profile')->title($this->title);
    }

    public function customSave() {
        $this->form->image = $this->image;

        $this->save();

        $this->image = null;
    }
}
