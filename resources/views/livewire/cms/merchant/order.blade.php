<x-acc-with-alert>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <x-acc-table>
                    <thead>
                        <tr>
                            <x-acc-loop-th :$searchBy :$orderBy :$order />
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($get as $d)
                            <tr>
                                <td>{{ $d->user->name }}</td>
                                <td>{{ number_format($d->total, 0, ',', '.') }}</td>
                                <td>
                                    <span class="{{ $d->status->class() }}">
                                        {{ $d->status->label() }}
                                    </span>
                                </td>
                                <td>{{ $d->status_delivery }}</td>
                                <td>{{ $d->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" wire:click="verify({{ $d->id }})">
                                        <i class="fa fa-eye"></i>
                                        Verify
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100" class="text-center">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-acc-table>
            </div>
            <div class="float-end">
                {{ $get->links() }}
            </div>
        </div>
    </div>

    {{-- Create / Update Modal --}}
    <x-acc-modal title="{{ $isUpdate ? 'Update' : 'Create' }} {{ $title }}" :isModaOpen="$modals['defaultModal']">
        <x-acc-form submit="customSave">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Total</label>
                    <x-acc-input type="text" model="total" readonly />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    @if(!empty($detail))
                        <img src="{{
                            $detail?->getFirstMediaUrl('images') != ''
                            ? $detail?->getFirstMediaUrl('images')
                            : asset('blank.svg')
                        }}" class="img-fluid" width="500px">
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Detail Order</label>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($detail))
                                @foreach ($detail?->cart?->details as $d)
                                    <tr>
                                        <td>{{ $d->product->title }}</td>
                                        <td>{{ number_format($d->product->price, 0, ',', '.') }}</td>
                                        <td>{{ $d->quantity }}</td>
                                        <td>{{ number_format($d->product->price * $d->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <x-acc-input type="select" model="status">
                        <option value="">--Select Status--</option>
                        @foreach (\App\Enums\Status::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Status Delivery</label>
                        <x-acc-input type="select" model="status_delivery">
                            <option value="">--Select Status--</option>
                            <option value="pending">Pending</option>
                            <option value="arrived">Arrived</option>
                        </x-acc-input>
                    </div>
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</x-acc-with-alert>
