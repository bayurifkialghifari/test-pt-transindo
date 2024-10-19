<div>
    <x-acc-back route="history" />
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <div class="card-body text-center">
                        <div class="alert alert-{{ $old_data?->status->value == '1' ? 'success' : 'warning' }}" role="alert">
                            Payment {{ $old_data?->status->label() ?? 'Pending' }}.
                            <h4 class="mb-3">
                                @if($old_data?->status->value == '1')
                                    Delivery Status : {{ $old_data?->status_delivery }}
                                @endif
                            </h4>
                        </div>
                        <img src="{{
                            $get?->merchant?->merchant?->getFirstMediaUrl('images') != ''
                            ? $get?->merchant?->merchant?->getFirstMediaUrl('images')
                            : asset('blank.svg')
                        }}" alt="{{ $get->title }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                        <h5 class="card-title mb-0">{{ $get->merchant?->merchant?->name ?? $get->merchant?->name }}</h5>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <h5 class="h6 card-title">Detail</h5>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($get->details as $detail)
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{
                                        $detail?->product?->getFirstMediaUrl('images') != ''
                                        ? $detail?->product?->getFirstMediaUrl('images')
                                        : asset('blank.svg')
                                    }}" alt="{{ $get->title }}" class="img-fluid rounded-circle mb-2" width="64">
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
                                </div>
                            </div>
                            <hr class="my-0">
                        @endforeach
                        <h4>Total : {{ number_format($total, 0, ',', '.')  }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-muted">
                                    How to pay :
                                    <ol>
                                        <li>Pay with Bank Transfer</li>
                                        <li>Upload Receipt</li>
                                        <li>Submit</li>
                                        <li>Wait for confirmation</li>
                                        <li>If confirmed, Food will be delivered</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1 class="h3 mb-3 mt-3">
                                    Upload Receipt
                                </h1>
                                <x-acc-image-preview :$image
                                    width="200px"
                                    :form_image="
                                        $old_data?->getFirstMediaUrl('images') != ''
                                        ? $old_data?->getFirstMediaUrl('images')
                                        : asset('blank.svg')
                                    "
                                />
                                <label class="form-label">Delivery Date</label>
                                <x-acc-input type="date" model="delivery_date" />
                                @if($old_data?->status->value == '0' || !$old_data)
                                    <x-acc-input type="file" model="image" />

                                    <button wire:click="customSave" class="btn btn-primary mt-2">
                                        <i class="fa fa-dollar"></i>
                                        Submit
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
