@extends('layouts.app')

@section('content')

    <body class="bg-light">

        <!-- Right-side customize field -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h1 class="card-title mb-0">Agents List</h1>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    id="dropdownCustomize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Customize Fields
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCustomize">
                                    <div class="px-3 py-2">
                                        @foreach(['aiagentid' => 'Agent Id','agentname' => 'Agent Name', 'languagecode' => 'Language Code',
                                                  'modelname' => 'Model Name', 'provider' => 'Provider', 'temperature' => 'Temperature'] as $field => $label)
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="col-{{ $field }}" checked>
                                                <label class="custom-control-label" for="col-{{ $field }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="px-3 py-2">
                                        <button class="btn btn-sm btn-primary w-100" onclick="applyChanges()">Apply Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th id="th-aiagentid" class="text-center">Agent Id</th>
                                            <th id="th-agentname" class="text-center">Agent Name</th>
                                            <th id="th-languagecode" class="text-center">Language Code</th>
                                            <th id="th-modelname" class="text-center">Model Name</th>
                                            <th id="th-provider" class="text-center">Provider</th>
                                            <th id="th-temperature" class="text-center">Temperature</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agents as $agent)
                                            <tr>
                                                <td class="text-center">{{$agent['ai_agent_id']}}</td>
                                                <td class="text-center">{{ $agent['agent_name'] }}</td>
                                                <td class="text-center">{{ $agent['language_code'] }}</td>
                                                <td class="text-center">{{ $agent['llm']['model_name'] }}</td>
                                                <td class="text-center">{{ $agent['llm']['model_provider'] }}</td>
                                                <td class="text-center">{{ $agent['llm']['model_temperature'] }}</td>
                                            </tr>
                                        @endforeach
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
            const fields = ["aiagentid", "agentname", "languagecode", "modelname", "provider", "temperature"];

            fields.forEach((field, index) => {
                const checkbox = document.getElementById(`col-${field}`);
                const columnHeader = document.getElementById(`th-${field}`);
                const cells = document.querySelectorAll(`td:nth-child(${index + 1})`);

                // Toggle visibility based on checkbox state
                if (checkbox.checked) {
                    columnHeader.style.display = "";
                    cells.forEach(cell => cell.style.display = "");
                } else {
                    columnHeader.style.display = "none";
                    cells.forEach(cell => cell.style.display = "none");
                }
            });
        }
    </script>

    <style>
        /* Styling adjustments for table */
        table th, table td {
            vertical-align: middle;
            padding: 12px 15px;
        }

        /* Optional: add some hover effect for rows */
        table tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Optional: adjust card shadow for better emphasis */
        .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Customize button style */
        .dropdown-menu {
            min-width: 250px;
        }
    </style>

@endsection
