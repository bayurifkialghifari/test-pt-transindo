<x-acc-with-alert>
    <x-acc-back route="home" />

    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merchant</th>
                            <th>Total</th>
                            <th>Status Payment</th>
                            <th>Status Delivert</th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse($get as $d)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $d->merchant->name }}</td>
                                <td>{{ $d->total }}</td>
                                <td>
                                    <span class="{{ $d->status->class() }}">
                                        {{ $d->status->label() }}
                                    </span>
                                </td>
                                <td>{{ $d->status_delivery }}</td>
                                <td>
                                    <a href="{{ route('checkout', $d->cart_id) }}" class="btn btn-primary">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="100" class="text-center">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-acc-with-alert>
