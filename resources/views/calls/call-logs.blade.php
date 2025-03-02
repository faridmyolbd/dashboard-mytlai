@extends('layouts.app')

@section('content')

    <body class="bg-light">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Call Logs</h5>
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
                                                    <input type="checkbox" class="custom-control-input" id="col-status"
                                                        checked>
                                                    <label class="custom-control-label" for="col-status">Call Status</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="col-type"
                                                        checked>
                                                    <label class="custom-control-label" for="col-type">Call Type</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="col-reason"
                                                        checked>
                                                    <label class="custom-control-label" for="col-reason">Reason</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="col-starttime"
                                                        checked>
                                                    <label class="custom-control-label" for="col-starttime">Start
                                                        Time</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="col-endtime"
                                                        checked>
                                                    <label class="custom-control-label" for="col-endtime">End Time</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="col-conversation" checked>
                                                    <label class="custom-control-label"
                                                        for="col-conversation">Conversation</label>
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
                                <table class="table table-bordered mb-0" id="callLogsTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" id="th-callid">Call ID</th>
                                            <th class="text-center" id="th-agentid">Agent ID</th>
                                            <th class="text-center" id="th-status">Call Status</th>
                                            <th class="text-center" id="th-type">Call Type</th>
                                            <th class="text-center" id="th-reason">Reason</th>
                                            <th class="text-center" id="th-starttime">Start Time</th>
                                            <th class="text-center" id="th-endtime">End Time</th>
                                            <th class="text-center" id="th-conversation">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Call logs will be injected here using JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right-side slide-in window for conversation -->
        <div id="conversationPanel" class="conversation-panel">
            <div class="conversation-content">
                <button class="close-btn" onclick="closeConversation()">Close</button>
                <h4>Conversation between Agent and User</h4>
                <div id="conversationDetails">
                    <!-- Conversation details will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch call logs on page load
            fetchCalls();
        });

        // Add this to your existing script section
        let currentPage = 1;

        function fetchCalls(page = 1, searchTerm = '') {
            const url = `/api/calls?page=${page}&search=${encodeURIComponent(searchTerm)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.calls && Array.isArray(data.calls)) {
                        updateTable(data.calls);
                        updatePagination(data.pagination);
                    } else {
                        document.querySelector('#callLogsTable tbody').innerHTML =
                            '<tr><td colspan="8" class="text-center">No calls found</td></tr>';
                    }
                })
                .catch(error => console.error('Error fetching calls:', error));
        }

        function updateTable(calls) {
            let tableBody = document.querySelector('#callLogsTable tbody');
            tableBody.innerHTML = '';

            calls.forEach(call => {
                let row = document.createElement('tr');
                row.innerHTML = `
                <td class="text-center">${call._id}</td>
                <td class="text-center">${call.ai_agent_id}</td>
                <td class="text-center">${call.call_status}</td>
                <td class="text-center">${call.call_type}</td>
                <td class="text-center">${call.call_finish_reason}</td>
                <td class="text-center">${new Date(call.call_start_time).toLocaleString()}</td>
                <td class="text-center">${new Date(call.call_end_time).toLocaleString()}</td>
                <td class="text-center">
                    <button class="btn btn-info btn-sm" onclick="showConversation('${call._id}')">Show</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteCall('${call._id}')">Delete</button>
                </td>
            `;
                tableBody.appendChild(row);
            });
        }

        function updatePagination(pagination) {
            const paginationContainer = document.getElementById('pagination');
            if (!paginationContainer) {
                // Create pagination container if it doesn't exist
                const container = document.createElement('div');
                container.id = 'pagination';
                container.className = 'mt-3 d-flex justify-content-center';
                document.querySelector('.table-responsive').after(container);
            }

            let paginationHtml = `
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${pagination.current_page - 1})">Previous</a>
                    </li>
        `;

            for (let i = 1; i <= pagination.total_pages; i++) {
                paginationHtml += `
                <li class="page-item ${pagination.current_page === i ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                </li>
            `;
            }

            paginationHtml += `
                    <li class="page-item ${pagination.current_page === pagination.total_pages ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${pagination.current_page + 1})">Next</a>
                    </li>
                </ul>
            </nav>
        `;

            document.getElementById('pagination').innerHTML = paginationHtml;
        }

        function changePage(page) {
            currentPage = page;
            const searchTerm = document.querySelector('input[placeholder="Filter by agent ID..."]').value;
            fetchCalls(page, searchTerm);
        }

        // Add event listener for search input
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[placeholder="Filter by agent ID..."]');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentPage = 1; // Reset to first page when searching
                    fetchCalls(currentPage, this.value);
                }, 300); // Debounce search for 300ms
            });

            // Initial load
            fetchCalls(currentPage, '');
        });

        // Updated showConversation function
        function showConversation(callId) {
            // Make an API request to fetch the conversation data for the given callId
            fetch(`/api/calls/${callId}/conversation`)
                .then(response => response.json()) // Parse the response as JSON
                .then(data => {
                    let conversationDetails = document.getElementById("conversationDetails");

                    // Check if the 'messages' field exists in the response data
                    if (data.messages) {
                        // Map through each message and display it in the conversation details
                        conversationDetails.innerHTML = data.messages.map(message => {
                            let role = message.role === 'agent' ? 'Agent' :
                                'User'; // Determine role of the speaker
                            let timestamp = message.content.match(
                                /\((.*?)\)/); // Extract timestamp from content
                            let formattedTimestamp = timestamp ? timestamp[1] : ''; // Format the timestamp
                            return `<div><strong>${role} (${formattedTimestamp}):</strong> ${message.content.replace(/\(.*?\)/, '')}</div><br>`;
                        }).join(''); // Join all messages into a single string of HTML
                    } else {
                        // If no messages are found, display a placeholder message
                        conversationDetails.innerText = 'No conversation data available.';
                    }
                    // Show the conversation panel
                    document.getElementById("conversationPanel").style.transform = "translateX(0)";
                })
                .catch(error => console.error('Error fetching conversation:', error)); // Handle fetch errors
        }



        function closeConversation() {
            document.getElementById("conversationPanel").style.transform = "translateX(100%)";
        }

        function deleteCall(callId) {
            if (confirm("Are you sure you want to delete the call with Call ID " + callId + "?")) {
                alert("Call ID " + callId + " deleted.");
            }
        }

        function applyChanges() {
            const fields = ["callid", "agentid", "status", "type", "reason", "starttime", "endtime", "conversation"];

            fields.forEach(field => {
                const checkbox = document.getElementById(`col-${field}`);
                const column = document.getElementById(`th-${field}`);
                const cells = document.querySelectorAll(`td:nth-child(${fields.indexOf(field) + 1})`);

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

    <style>
        .conversation-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 1000px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            padding: 20px;
            z-index: 1050;
        }

        .conversation-content {
            margin-top: 20px;
            max-height: calc(100% - 60px);
            /* Adjust for the close button space */
            overflow-y: auto;
            /* Enables scrolling */
            padding-right: 10px;
            /* Optional: add some padding to the right for aesthetics */
            display: flex;
            flex-direction: column;
            /* Align messages vertically */
        }

        .close-btn {
            background-color: #f1f4f7;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .close-btn:hover {
            background-color: #ddd;
        }
    </style>
@endsection
