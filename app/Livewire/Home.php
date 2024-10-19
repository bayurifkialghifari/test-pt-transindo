<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Url;
use BaseComponent;

class Home extends BaseComponent
{
    public $title = 'Marketplace';

    #[Url()]
    public $search = '';

    public function render()
    {
        $get = User::with('merchant', 'merchant.media.model')
            ->whereHas('roles', function ($query) { $query->where('name', 'Merchant'); })
            ->where(function ($query) {
                $query->when($this->search != null, function ($query) {
                    $query->orWhere('name', 'like', '%' . $this->search . '%');
                    $query->orWhere('email', 'like', '%' . $this->search . '%');
                    $query->orWhereHas('merchant', fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'));
                    $query->orWhereHas('merchant', fn ($query) => $query->where('email', 'like', '%' . $this->search . '%'));
                    $query->orWhereHas('merchant', fn ($query) => $query->where('phone', 'like', '%' . $this->search . '%'));
                    $query->orWhereHas('merchant', fn ($query) => $query->where('address', 'like', '%' . $this->search . '%'));
                    $query->orWhereHas('merchant', fn ($query) => $query->where('description', 'like', '%' . $this->search . '%'));
                    $query->orWhereHas('products', fn ($query) => $query->where('title', 'like', '%' . $this->search . '%'));
                });
            })->paginate(8);

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.home', compact('get'))->title($this->title);
    }
}
