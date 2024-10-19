<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center mt-3 mb-2">
                <div class="col-auto">
                    <nav class="nav btn-group" role="tablist" x-data="{
                        tab: $wire.entangle('productType').live,
                        changeTab(tab) {
                            this.tab = tab
                            $wire.set('productType', tab)
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
                    <img class="card-img-top"
                        src="{{ $d->getFirstMediaUrl('images') != '' ? $d->getFirstMediaUrl('images') : asset('blank.svg') }}"
                        alt="{{ $d->title }}">
                    <div class="card-header px-4 pt-4">
                        <h5 class="card-title mb-0">{{ $d->title }}</h5>
                        <div class="badge bg-success my-2">
                            Rp {{ number_format($d->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="card-body px-4 pt-2">
                        <p>{{ Str::limit($d->description, 50, preserveWords: true) }}</p>
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
