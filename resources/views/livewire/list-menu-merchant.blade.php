<div>
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center mt-3 mb-2">
                <div class="col-auto">
                    <nav class="nav btn-group" role="tablist" x-data="{
                        tab: $wire.entangle('type').live,
                        changeTab(tab) {
                            this.tab = tab
                            $wire.set('type', tab)
                        }
                    }">
                        <button class="btn btn-outline-primary"
                            :class="tab === 'all' ? 'active' : ''"
                            x-on:click="changeTab('all')"
                            data-bs-toggle="tab"
                            aria-selected="true"
                            role="tab">
                            All
                        </button>
                        @foreach ($productTypes as $type)
                            <button class="btn btn-outline-primary"
                                :class="tab === '{{ $type->id }}' ? 'active' : ''"
                                x-on:click="changeTab('{{ $type->id }}')"
                                data-bs-toggle="tab"
                                aria-selected="false"
                                role="tab"
                                tabindex="-1">
                                {{ $type->name }}
                            </button>
                        @endforeach
                    </nav>
                </div>
            </div>
        </div>

        {{-- Products --}}
        @foreach ($get as $d)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h5 class="card-title">{{ $d->merchant?->name ?? $d->name }}</h5>
                            <div class="card-body text-center">
                                <img src="{{
                                    $d?->getFirstMediaUrl('images') != ''
                                    ? $d?->getFirstMediaUrl('images')
                                    : asset('blank.svg')
                                }}" alt="{{ $d->title }}" class="card-img-top">
                                <div class="badge bg-success my-2">
                                    Rp {{ number_format($d->price, 0, ',', '.') }}
                                </div>
                                <h5 class="card-title mb-0">{{ $d->title }}</h5>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <h5 class="h6 card-title">Detail</h5>
                                <div class="text-muted mb-2">
                                    {{ Str::limit($d->description, 50) }}
                                </div>
                                <button class="btn btn-success btn-sm" wire:click="addToChart({{ $d->id }})">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to chart
                                </button>
                                <button class="btn btn-primary btn-sm" wire:click="addToChart({{ $d->id }})">
                                    <i class="fa fa-shopping-cart"></i>
                                    Checkout
                                </button>
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
