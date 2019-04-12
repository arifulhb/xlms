<!-- User dropdown -->
<li class="nav-item dropdown ml-1 ml-md-3">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
        <img src="{{ asset('template/assets/images/people/50/guy-6.jpg') }}" alt="Avatar"
        class="rounded-circle" width="40"></a>
    <div class="dropdown-menu dropdown-menu-right">
        <p class="dropdown-item text-info mb-1" data-toggle="dropdown">
                <i class="material-icons">person</i> {{ Auth::user()->name }}</p>
        <p style="border-bottom: 1px solid #eee;" class="pl-3 pb-3 mb-2">
            @foreach(Auth::user()->roles as $role)
                <span class="badge">{{ $role->name }}</span>
            @endforeach
        </p>
        <a class="dropdown-item" href="{{ route('profile.show') }}">
            <i class="material-icons">edit</i> Edit Account
        </a>
        {{-- <a class="dropdown-item" href="instructor-profile.html">
            <i class="material-icons">person</i> Public Profile
        </a> --}}
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
