@extends('layouts.app')

@section('content')

<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Order Dashboard</h5>
                        </div>
                        <div class="row">
                            <!-- Left side filters -->
                            <div class="col-md-8">
                                <div class="d-flex gap-3">
                                    <div class="input-group mr-3" style="width: 250px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">Customer ID</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Filter by Customer ID...">
                                    </div>
                                    <div class="input-group mr-3" style="width: 200px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">From</span>
                                        </div>
                                        <input type="date" class="form-control">
                                    </div>
                                    <div class="input-group" style="width: 200px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white">To</span>
                                        </div>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Right side customize field -->
                            <div class="col-md-4 text-right">
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-toggle="dropdown">
                                        Customize Fields
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="px-3 py-2">
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="col-orderid"
                                                    checked>
                                                <label class="custom-control-label" for="col-orderid">Order ID</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="col-customerid"
                                                    checked>
                                                <label class="custom-control-label" for="col-customerid">Customer ID</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="col-status"
                                                    checked>
                                                <label class="custom-control-label" for="col-status">Order Status</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="col-totalamount"
                                                    checked>
                                                <label class="custom-control-label" for="col-totalamount">Total Amount</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="col-orderdate"
                                                    checked>
                                                <label class="custom-control-label" for="col-orderdate">Order Date</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="col-paymentstatus"
                                                    checked>
                                                <label class="custom-control-label" for="col-paymentstatus">Payment Status</label>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="px-3 py-2">
                                            <button class="btn btn-sm btn-primary w-100" onclick="applyChanges()">Apply
                                                Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="orderTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" id="th-orderid">Order ID</th>
                                        <th class="text-center" id="th-customerid">Customer ID</th>
                                        <th class="text-center" id="th-status">Order Status</th>
                                        <th class="text-center" id="th-totalamount">Total Amount</th>
                                        <th class="text-center" id="th-orderdate">Order Date</th>
                                        <th class="text-center" id="th-paymentstatus">Payment Status</th>
                                        <th class="text-center" id="th-action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Order logs will be injected here using JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right-side slide-in window for order details -->
    <div id="orderDetailPanel" class="order-detail-panel">
        <div class="order-detail-content">
            <button class="close-btn" onclick="closeOrderDetail()">Close</button>
            <h4>Order Details</h4>
            <div id="orderDetails">
                <!-- Order details will be dynamically loaded here -->
            </div>
        </div>
    </div>
</body>
@endsection
