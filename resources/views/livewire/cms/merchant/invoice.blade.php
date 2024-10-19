<div>
    <x-acc-back route="history" />
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <div class="card-body text-center">
                        <div class="alert alert-{{ $data?->status->value == '1' ? 'success' : 'warning' }}" role="alert">
                            Payment {{ $data?->status->label() }}.
                        </div>
                        <img src="{{
                            $data?->merchant?->merchant?->getFirstMediaUrl('images') != ''
                            ? $data?->merchant?->merchant?->getFirstMediaUrl('images')
                            : asset('blank.svg')
                        }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                        <h5 class="card-title mb-0">{{ $data->merchant?->merchant?->name ?? $data->merchant?->name }}</h5>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <h5 class="h6 card-title">Detail</h5>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($data->cart->details as $detail)
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{
                                        $detail?->product?->getFirstMediaUrl('images') != ''
                                        ? $detail?->product?->getFirstMediaUrl('images')
                                        : asset('blank.svg')
                                    }}" class="img-fluid rounded-circle mb-2" width="64">
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
                            <div class="col-md-12">
                                <h4 class="mb-3">
                                    Delivery Date : {{ $data?->delivery_date?->format('Y-m-d') }}
                                </h4>
                                <h4 class="mb-3">
                                    Delivery Status : {{ $data?->status_delivery }}
                                </h4>
                                <h1 class="mb-3 mt-3">
                                    Receipt
                                </h1>
                                <x-acc-image-preview :image="null"
                                    width="50%"
                                    :form_image="
                                        $data?->getFirstMediaUrl('images') != ''
                                        ? $data?->getFirstMediaUrl('images')
                                        : asset('blank.svg')
                                    "
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
