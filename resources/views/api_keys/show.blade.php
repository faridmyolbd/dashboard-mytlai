@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">API Key Details</h1>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <td>{{ $apiKey['name'] }}</td>
        </tr>
        <tr>
            <th>Permissions</th>
            <td>
                @foreach ($apiKey['permissions'] as $permission)
                    <span class="badge bg-secondary">{{ $permission }}</span>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td class="{{ $apiKey['status'] == 'Revoked' ? 'text-danger' : 'text-success' }}">
                {{ $apiKey['status'] }}
            </td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $apiKey['created_at'] }}</td>
        </tr>
        <tr>
            <th>Expires At</th>
            <td>{{ $apiKey['expires_at'] }}</td>
        </tr>
    </table>

    <div class="mt-3">
        @if ($apiKey['status'] != 'Revoked')
            <form method="POST" action="{{ route('api-keys.revoke', $apiKey['id']) }}">
                @csrf
                <button type="submit" class="btn btn-danger">Revoke API Key</button>
            </form>
        @endif
        <a href="{{ route('api-keys.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
