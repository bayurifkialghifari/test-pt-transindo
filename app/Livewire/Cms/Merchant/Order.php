<?php

namespace App\Livewire\Cms\Merchant;

use App\Enums\Alert;
use App\Livewire\Forms\Cms\Product\FormType;
use App\Models\Checkout;
use BaseComponent;

class Order extends BaseComponent
{
    public FormType $form;
    public $title = 'Order';

    public $searchBy = [
            [
                'name' => 'User',
                'field' => 'user.name',
            ],
            [
                'name' => 'Total',
                'field' => 'total',
            ],
            [
                'name' => 'Status Payment',
                'field' => 'status',
            ],
            [
                'name' => 'Delivery Date',
                'field' => 'delivery_date',
            ],
            [
                'name' => 'Status Delivery',
                'field' => 'status_delivery',
            ],
            [
                'name' => 'Created at',
                'field' => 'created_at',
            ],
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'created_at',
        $order = 'desc';

    public function render()
    {
        $get = $this->getDataWithFilter(
            model: Checkout::with('user', 'cart', 'cart.details'),
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.merchant.order', compact('get'))->title($this->title);
    }

    public $total;
    public $detail;
    public $status;
    public $status_delivery;

    public function verify($id) {
        $this->openModal();

        // Detail
        $data = Checkout::with('user', 'cart', 'cart.details')->find($id);
        $this->total = number_format($data->total, 0, ',', '.');
        $this->detail = $data;
        $this->status = $data->status;
        $this->status_delivery = $data->status_delivery;
    }

    public function customSave() {
        Checkout::find($this->detail->id)->update([
            'status' => $this->status,
            'status_delivery' => $this->status_delivery,
        ]);

        $this->closeModal();
        $this->dispatch('alert', type: Alert::success->value, message: 'Data saved successfully');
    }
}
