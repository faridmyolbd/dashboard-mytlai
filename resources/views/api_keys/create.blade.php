@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create API Key</h1>

    <form method="POST" action="{{ route('api-keys.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Permissions</label>
            <input type="text" class="form-control" id="permissions" name="permissions" placeholder="e.g., permissions, authentication">
        </div>
        <button type="submit" class="btn btn-primary">Create API Key</button>
    </form>
</div>
@endsection
