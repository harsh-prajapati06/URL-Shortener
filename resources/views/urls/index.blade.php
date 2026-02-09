@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Short URLs</h4>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

            @if(auth()->user()->role != "Super Admin")
                <div class="mb-4">
                    <h5>{{ $url ? 'Edit URL' : 'Create URL' }}</h5>

                    <form method="POST" action="{{ route('urls.save', $url?->id) }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Original URL</label>
                                <input
                                    type="text"
                                    name="url"
                                    class="form-control"
                                    value="{{ old('url', $url->url ?? '') }}"
                                    placeholder="https://example.com"
                                >
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ $url ? 'Update' : 'Generate Short URL' }}
                                </button>

                                @if($url)
                                    <a href="{{ route('urls.index') }}" class="btn btn-secondary">Cancel</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
            @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Company</th>
                                <th>Original URL</th>
                                <th>Short URL</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($urls as $index => $u)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $u->user->name ?? '-' }}</td>
                                    <td>{{ $u->company->name ?? '-' }}</td>
                                    <td>{{ $u->url }}</td>
                                    <td>
                                        <a href="{{ url('redirect/'.$u->short_url) }}" target="_blank">
                                            {{ $u->short_url }}
                                        </a>
                                    </td>
                                    <td>
                                        @if(auth()->user()->role != "Super Admin")
                                        <a href="{{ route('urls.index', $u->id) }}" class="btn btn-sm btn-primary">
                                            Edit
                                        </a>

                                        <form action="{{ route('urls.delete', $u->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        No URLs found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
