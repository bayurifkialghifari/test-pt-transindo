<div>
    <div class="row">
        @if(auth()->user()->hasRole('admin'))
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total User</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($adminUsers, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Menu</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($adminMenus, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Order</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($adminOrders, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Order Paid</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($adminOrdersPaid, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Order Pending</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($adminOrdersPending, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
        @endif
        @if(auth()->user()->hasRole('merchant'))
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Menu</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($merchantMenus, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Order</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($merchantOrders, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Order Paid</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($merchantOrdersPaid, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Order Pending</h5>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ number_format($merchantOrdersPending, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
