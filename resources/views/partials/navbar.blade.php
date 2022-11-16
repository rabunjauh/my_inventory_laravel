<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    {{-- @auth --}}
    {{-- <a class="navbar-brand" href="#"><i class="bi bi-person-circle"> --}}
      {{-- {{ auth()->user()->name }}</i> --}}
    {{-- </a> --}}
    {{-- @else  --}}
      {{-- {{ 'Extension' }} --}}
    {{-- @endauth --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        {{-- @auth --}}
          <a class="nav-link {{ Request::is('assign') ? 'active' : '' }}" href="/assign">Employee Extension</a>
          <a class="nav-link {{ Request::is('extension') ? 'active' : '' }}" href="/extension">Extension</a>
          <a class="nav-link {{ Request::is('employee') ? 'active' : '' }}" href="/employee">Employee</a>
          <a class="nav-link {{ Request::is('department') ? 'active' : '' }}" href="/department">Department</a>
          <a class="nav-link {{ Request::is('position') ? 'active' : '' }}" href="/position">Position</a>
          <a class="nav-link {{ Request::is('office') ? 'active' : '' }}" href="/office">Office</a>
          <a class="nav-link {{ Request::is('group') ? 'active' : '' }}" href="/group">Group</a>
          <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="/user">User</a>
        {{-- @endauth --}}
      </div>
      {{-- @auth --}}
        <div class="navbar-nav ms-right">
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn">
              <i class="bi bi-box-arrow-right"></i>
            Logout</button>
          </form>
        </div>
       {{-- @endauth --}}
      <div class="navbar-nav ms-auto">
        
      </div>
    </div>
  </div>
</nav>