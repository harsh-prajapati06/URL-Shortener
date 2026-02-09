<!-- Sidebar -->
<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar border-end">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li> 
            @if(auth()->user()->role == "Super Admin")  
            <li class="nav-item">
                <a class="nav-link" href="{{ route('companies.view') }}">
                    <i class="bi bi-file-earmark"></i> Companies
                </a>
            </li> 
            @endif

            @if(auth()->user()->role != "Member") 
            <li class="nav-item">
                <a class="nav-link" href="{{ route('invite.user') }}">
                    <i class="bi bi-file-earmark"></i> Invite User
                </a>
            </li>
            @endif   
            <li class="nav-item">
                <a class="nav-link" href="{{ route('urls.index') }}">
                    <i class="bi bi-file-earmark"></i> Short Url's
                </a>
            </li>    
        </ul>
    </div>
</nav>