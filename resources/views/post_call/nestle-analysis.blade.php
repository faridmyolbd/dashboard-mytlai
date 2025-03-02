@extends('layouts.app')

@section('content')

    <body class="bg-light">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Post Call Analysis Nestle</h5>
                            </div>
                            <div class="row">
                                <!-- Left side filters -->
                                <div class="col-md-8">
                                    <div class="d-flex gap-3">
                                        <div class="input-group mr-3" style="width: 250px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white">Agent ID</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Filter by agent ID...">
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
                                                    <input type="checkbox" class="custom-control-input" id="col-callid"
                                                        checked>
                                                    <label class="custom-control-label" for="col-callid">Call ID</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="col-agentid"
                                                        checked>
                                                    <label class="custom-control-label" for="col-agentid">Agent ID</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="col-orderconfirmation" checked>
                                                    <label class="custom-control-label" for="col-orderconfirmation">Order
                                                        Confirmation</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="col-customertype" checked>
                                                    <label class="custom-control-label" for="col-customertype">Customer
                                                        Type</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="col-phonenumber"
                                                        checked>
                                                    <label class="custom-control-label" for="col-phonenumber">Phone
                                                        Number</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="col-address"
                                                        checked>
                                                    <label class="custom-control-label" for="col-address">Address</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="col-customername" checked>
                                                    <label class="custom-control-label" for="col-customername">Customer
                                                        Name</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="col-ordercount"
                                                        checked>
                                                    <label class="custom-control-label" for="col-ordercount">Order
                                                        Count</label>
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
                                <table class="table table-bordered mb-0" id="postCallAnalysisTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" id="th-callid">Call ID</th>
                                            <th class="text-center" id="th-agentid">Agent ID</th>
                                            <th class="text-center" id="th-orderconfirmation">Order Confirmation</th>
                                            <th class="text-center" id="th-customertype">Customer Type</th>
                                            <th class="text-center" id="th-phonenumber">Phone Number</th>
                                            <th class="text-center" id="th-address">Address</th>
                                            <th class="text-center" id="th-customername">Customer Name</th>
                                            <th class="text-center" id="th-ordercount">Order Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">{{ $call_id }}</td>
                                            <td class="text-center">{{ $ai_agent_id }}</td>
                                            <td class="text-center">
                                                @foreach ($items as $item)
                                                    @if ($item['name'] == 'order_confirmation')
                                                        {{ $item['result'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach ($items as $item)
                                                    @if ($item['name'] == 'customer_type')
                                                        {{ $item['result'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach ($items as $item)
                                                    @if ($item['name'] == 'customer_phone_number')
                                                        {{ $item['result'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach ($items as $item)
                                                    @if ($item['name'] == 'customer_address')
                                                        {{ $item['result'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach ($items as $item)
                                                    @if ($item['name'] == 'customer_name')
                                                        {{ $item['result'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach ($items as $item)
                                                    @if ($item['name'] == 'order_count')
                                                        {{ $item['result'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    <script>
        function applyChanges() {
            const fields = ["callid", "agentid", "orderconfirmation", "customertype", "phonenumber", "address",
                "customername", "ordercount"
            ];

            fields.forEach(field => {
                const checkbox = document.getElementById(`col-${field}`);
                const column = document.getElementById(`th-${field}`);
                const cells = document.querySelectorAll(
                    `#postCallAnalysisTable td:nth-child(${fields.indexOf(field) + 1})`);

                // Toggle visibility based on checkbox state
                if (checkbox.checked) {
                    column.style.display = "";
                    cells.forEach(cell => cell.style.display = "");
                } else {
                    column.style.display = "none";
                    cells.forEach(cell => cell.style.display = "none");
                }
            });
        }
    </script>
@endsection
