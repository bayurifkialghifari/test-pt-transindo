<x-acc-with-alert>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">{{ $title ?? '' }} Data</h5>
                    </div>
                    <x-acc-form submit="customSave">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Merchant name</label>
                                <x-acc-input type="text" model="form.name" placeholder="Merchant name" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <x-acc-image-preview :$image :form_image="$form->old_data?->getFirstMediaUrl('images') ?? ''" width="200px"  />
                                <x-acc-input type="file" model="image" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <x-acc-input type="email" model="form.email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <x-acc-input type="number" model="form.phone" placeholder="Phone" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <x-acc-input type="textarea" model="form.address" placeholder="Address" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <x-acc-input type="textarea" model="form.description" placeholder="Description" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">Preview</h5>
                        <div class="card-body text-center">
                            <img src="{{
                                $form->old_data?->getFirstMediaUrl('images') != ''
                                ? $form->old_data?->getFirstMediaUrl('images')
                                : asset('blank.svg')
                            }}" alt="{{ $form->name }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                            <h5 class="card-title mb-0">{{ $form->name ?? auth()->user()->name }}</h5>
                            <div class="text-muted mb-2">
                                {{ $form->description ?? 'Description' }}
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <h5 class="h6 card-title">Detail</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1">
                                    <i class="fa fa-phone"></i> {{ $form->phone ?? '08123' }}</a>
                                </li>
                                <li class="mb-1">
                                    <i class="fa fa-envelope"></i> {{ $form->email ?? 'blank@example.com' }}</a>
                                </li>
                                <li class="mb-1">
                                    <i class="fa fa-location"></i> {{ $form->address ?? 'Address' }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-acc-with-alert>
