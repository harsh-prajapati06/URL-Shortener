@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Invite User</h4>
                </div>
                <div class="card-body">
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
                        <h5 class="mb-3">Invite User</h5>

                        <form method="POST" action="{{ route('invite.user') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            id="name"
                                            class="form-control @error('name') is-invalid @enderror" 
                                            value="{{ old('name') }}"
                                            placeholder="Enter full name"
                                            
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            id="email"
                                            class="form-control @error('email') is-invalid @enderror" 
                                            value="{{ old('email') }}"
                                            placeholder="Enter email address"
                                            
                                        >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Company -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                                        <select 
                                            name="company_id" 
                                            id="company_id"
                                            class="form-select @error('company_id') is-invalid @enderror"
                                        >
                                            <option value="">-- Select Company --</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Role -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                        <select 
                                            name="role" 
                                            id="role"
                                            class="form-select @error('role') is-invalid @enderror"
                                        >
                                            <option value="">-- Select Role --</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}"
                                                    {{ old('role') == $role ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">
                                            Password 
                                            @if(isset($user))
                                                <span class="text-muted">(Leave blank to keep current)</span>
                                            @else
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter password"
                                        >
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">
                                            Confirm Password
                                            @if(!isset($user))
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            id="password_confirmation"
                                            class="form-control"
                                            placeholder="Confirm password"
                                        >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Invite
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h5 class="mb-3">User List</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Generated Url's</th>
                                        <th>Company</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->urls->count() }}</td>
                                            <td>{{ $u->company->name ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $u->role == 'Admin' ? 'danger' : 'primary' }}">
                                                    {{ $u->role }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">
                                                <i class="bi bi-inbox"></i> No users found. Invite your first user above.
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
    </div>
@endsection