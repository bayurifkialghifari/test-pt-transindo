<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        {{-- Search Bar --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">Search Merchant Or Menu</h5>
                    </div>
                    <div class="container">
                        <div class="mb-3">
                            <x-acc-input type="text" model="search" placeholder="Search..." :live="true" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Merchant --}}
        @foreach ($get as $d)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h5 class="card-title">{{ $d->merchant?->name ?? $d->name }}</h5>
                            <div class="card-body text-center">
                                <img src="{{
                                    $d->merchant?->getFirstMediaUrl('images') != ''
                                    ? $d->merchant?->getFirstMediaUrl('images')
                                    : asset('blank.svg')
                                }}" alt="{{ $d->merchant?->name ?? $d->name }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                                <h5 class="card-title mb-0">{{ $d->merchant?->name ?? $d->name }}</h5>
                                <div class="text-muted mb-2">
                                    {{ $d->merchant?->description ?? '#' }}
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <h5 class="h6 card-title">Detail</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-1">
                                        <i class="fa fa-phone"></i> {{ $d->merchant?->phone ?? '#' }}</a>
                                    </li>
                                    <li class="mb-1">
                                        <i class="fa fa-envelope"></i> {{ $d->merchant?->email ?? '#' }}</a>
                                    </li>
                                    <li class="mb-1">
                                        <i class="fa fa-location"></i> {{ $d->merchant?->address ?? '#' }}</a>
                                    </li>
                                </ul>
                                <a class="btn btn-primary" href="{{ route('menu-merchant', $d->id) }}" wire:navigate>
                                    <i class="fa fa-arrow-right"></i>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="col-12">
            {{ $get->links() }}
        </div>
    </div>
</div>
