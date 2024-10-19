<div>
    <x-acc-back route="home" />
    <div class="row">
        {{-- Carts --}}
        @forelse ($get as $d)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="card-body text-center">
                                <img src="{{
                                    $d?->merchant?->merchant?->getFirstMediaUrl('images') != ''
                                    ? $d?->merchant?->merchant?->getFirstMediaUrl('images')
                                    : asset('blank.svg')
                                }}" alt="{{ $d->title }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                                <h5 class="card-title mb-0">{{ $d->merchant?->merchant?->name ?? $d->merchant?->name }}</h5>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <h5 class="h6 card-title">Detail</h5>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($d->details as $detail)
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="{{
                                                $detail?->product?->getFirstMediaUrl('images') != ''
                                                ? $detail?->product?->getFirstMediaUrl('images')
                                                : asset('blank.svg')
                                            }}" alt="{{ $d->title }}" class="img-fluid rounded-circle mb-2" width="64">
                                        </div>
                                        <div class="col-10">
                                            <h5 class="card-title mb-0">{{ $detail->product->title }}</h5>
                                            <div class="text-muted mb-2">
                                                @php
                                                    $total += $detail->product->price * $detail->quantity;
                                                @endphp
                                                {{ number_format($detail->product->price, 0, ',', '.') }}
                                                x {{ $detail->quantity }} =
                                                {{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}
                                            </div>
                                            <button class="btn btn-success btn-sm" wire:click="editDetail({{ $detail->id }})">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" wire:click="confirmDeleteDetail({{ $detail->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                @endforeach
                                <h4>Total : {{ number_format($total, 0, ',', '.')  }}</h4>
                                <a href="{{ route('checkout', $d->id) }}" class="btn btn-primary" wire:navigate>
                                    <i class="fa fa-dollar"></i>
                                    Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h1>No Carts</h1>
                    </div>
                </div>
            </div>
        @endforelse
        <x-acc-modal title="Update Quantity" :isModaOpen="$modals['defaultModal']">
            <x-acc-form submit="updateDetail">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <x-acc-input type="text" model="name" placeholder="Name" readonly />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <x-acc-input type="number" model="quantity" placeholder="Quantity" />
                    </div>
                </div>
            </x-acc-form>
        </x-acc-modal>
    </div>
</div>
