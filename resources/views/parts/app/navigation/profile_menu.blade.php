<!-- User dropdown -->
<li class="nav-item dropdown ml-1 ml-md-3">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
        <img src="{{ asset('template/assets/images/people/50/guy-6.jpg') }}" alt="Avatar"
        class="rounded-circle" width="40"></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="instructor-account-edit.html">
            <i class="material-icons">edit</i> Edit Account
        </a>
        <a class="dropdown-item" href="instructor-profile.html">
            <i class="material-icons">person</i> Public Profile
        </a>
    {{-- @todo logout method --}}
    <form method="POST" action="{{ url('/logout')}}">
        {{ csrf_field() }}
        <button class="dropdown-item" type="submit">
            <i class="material-icons">lock</i> Logout
        </button>
    </form>
    </div>
</li>
<!-- // END User dropdown -->
