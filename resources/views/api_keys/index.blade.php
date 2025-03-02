@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">API Keys</h1>

    <div class="mb-3">
        <a href="{{ route('api-keys.create') }}" class="btn btn-success">Add New API Key</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($error ?? false)
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    <div class="table-responsive">
        @if (!empty($apiKeys) && count($apiKeys) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Expires At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apiKeys as $apiKey)
                        <tr>
                            <td>{{ $apiKey['name'] ?? 'N/A' }}</td>
                            <td>
                                @if (!empty($apiKey['permissions']))
                                    @foreach ($apiKey['permissions'] as $permission)
                                        <span class="badge bg-secondary">{{ $permission }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No Permissions</span>
                                @endif
                            </td>
                            <td class="{{ $apiKey['revoked'] ? 'text-danger' : 'text-success' }}">
                                {{ $apiKey['revoked'] ? 'Revoked' : 'Active' }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($apiKey['created_at'])->format('d M, Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($apiKey['expiration_date'])->format('d M, Y H:i') }}</td>
                            <td>
                                <a href="{{ route('api-keys.show', $apiKey['_id']) }}" class="btn btn-primary btn-sm">View</a>
                                @if (!$apiKey['revoked'])
                                    <form method="POST" action="{{ route('api-keys.revoke', $apiKey['_id']) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to revoke this API Key?')">Revoke</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-muted">No API Keys available.</p>
        @endif
    </div>
</div>
@endsection
