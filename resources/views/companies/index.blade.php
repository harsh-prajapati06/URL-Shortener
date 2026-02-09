@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Companies</h4>
                </div>
                <div class="card-body">
                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <!-- Error Alert -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <!-- Form Section -->
                    <div class="mb-4">
                        <h5 class="mb-3">{{ $company ? 'Edit Company' : 'Add Company' }}</h5>

                        <form method="POST" action="{{ route('companies.save', $company?->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            id="name"
                                            class="form-control @error('name') is-invalid @enderror" 
                                            value="{{ old('name', $company->name ?? '') }}"
                                            placeholder="Enter company name"
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-{{ $company ? 'pencil-square' : 'plus-circle' }} me-1"></i>
                                        {{ $company ? 'Update Company' : 'Create Company' }}
                                    </button>
                                    @if($company)
                                        <a href="{{ route('companies.view') }}" class="btn btn-secondary">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Cancel
                                        </a>
                                    @endif
                                </div>
                            </div>                    
                        </form>
                    </div>

                    <hr>

                    <!-- Table Section -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Generated Url's</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $index => $c)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->urls->count() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('companies.view', $c->id) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            <i class="bi bi-inbox"></i> No companies found. Create your first company above.
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