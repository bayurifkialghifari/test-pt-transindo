<x-acc-with-alert>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-header :$originRoute />
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
                                <td>{{ $d->productType->name }}</td>
                                <td>
                                    <img
                                        src="{{ $d->getFirstMediaUrl('images') != '' ? $d->getFirstMediaUrl('images') : asset('blank.svg')  }}"
                                        alt="{{ $d->title }}"
                                        class="img-fluid rounded"
                                        width="64">
                                </td>
                                <td>{{ $d->title }}</td>
                                <td>{{ $d->slug }}</td>
                                <td>{{ $d->description }}</td>
                                <td>
                                    {{ number_format($d->price, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="{{ $d->active->class() }}">
                                        {{ $d->active->label() }}
                                    </span>
                                </td>
                                <x-acc-update-delete :id="$d->id" :$originRoute />
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
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <x-acc-input type="select" model="form.product_type_id">
                        <option value="">--Select Type--</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <x-acc-input type="text" model="form.title" placeholder="Name" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <x-acc-image-preview :$image
                        width="200px"
                        :form_image="
                            $form->old_data?->getFirstMediaUrl('images') != ''
                            ? $form->old_data?->getFirstMediaUrl('images')
                            : asset('blank.svg')
                        "
                    />
                    <x-acc-input type="file" model="image" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <x-acc-input type="text" model="form.description" placeholder="Description" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <x-acc-input type="text" model="form.price" placeholder="Price"  x-mask:dynamic="$money($input, ',')" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <x-acc-input type="select" model="form.active">
                        <option value="">--Select Status--</option>
                        @foreach (\App\Enums\Active::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</x-acc-with-alert>
