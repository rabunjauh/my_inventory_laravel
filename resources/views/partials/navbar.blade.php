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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Master Data Employee
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item {{ Request::is('employee') ? 'active' : '' }}" href="/employee">Employee</a></li>
              <li><a class="dropdown-item {{ Request::is('department') ? 'active' : '' }}" href="/department">Department</a></li>
              <li><a class="dropdown-item {{ Request::is('hardwareModel') ? 'active' : '' }}" href="/hardwareModel">Hardware Model</a></li>
              <li><a class="dropdown-item {{ Request::is('hardwareType') ? 'active' : '' }}" href="/hardwareType">Hardware Type</a></li>
              <li><a class="dropdown-item {{ Request::is('manufacturer') ? 'active' : '' }}" href="/manufacturer">Manufacturer</a></li>
              <li><a class="dropdown-item {{ Request::is('memory') ? 'active' : '' }}" href="/memory">Memory</a></li>
              <li><a class="dropdown-item {{ Request::is('processor') ? 'active' : '' }}" href="/processor">Processor</a></li>
              <li><a class="dropdown-item {{ Request::is('storage') ? 'active' : '' }}" href="/storage">Storage</a></li>
              <li><a class="dropdown-item {{ Request::is('project') ? 'active' : '' }}" href="/project">Project</a></li>
              <li><a class="dropdown-item {{ Request::is('softwareCategory') ? 'active' : '' }}" href="/softwareCategory">Software Category</a></li>
              <li><a class="dropdown-item {{ Request::is('supplier') ? 'active' : '' }}" href="/supplier">Supplier</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Master Data Hardware
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item {{ Request::is('graphicCard') ? 'active' : '' }}" href="/graphicCard">Graphic Card</a></li>
              <li><a class="dropdown-item {{ Request::is('/') ? 'active' : '' }}" href="/">Hardware</a></li>
              <li><a class="dropdown-item {{ Request::is('hardwareCategory') ? 'active' : '' }}" href="/hardwareCategory">Hardware Category</a></li>
              <li><a class="dropdown-item {{ Request::is('hardwareModel') ? 'active' : '' }}" href="/hardwareModel">Hardware Model</a></li>
              <li><a class="dropdown-item {{ Request::is('hardwareType') ? 'active' : '' }}" href="/hardwareType">Hardware Type</a></li>
              <li><a class="dropdown-item {{ Request::is('manufacturer') ? 'active' : '' }}" href="/manufacturer">Manufacturer</a></li>
              <li><a class="dropdown-item {{ Request::is('memory') ? 'active' : '' }}" href="/memory">Memory</a></li>
              <li><a class="dropdown-item {{ Request::is('processor') ? 'active' : '' }}" href="/processor">Processor</a></li>
              <li><a class="dropdown-item {{ Request::is('storage') ? 'active' : '' }}" href="/storage">Storage</a></li>
              <li><a class="dropdown-item {{ Request::is('project') ? 'active' : '' }}" href="/project">Project</a></li>
              <li><a class="dropdown-item {{ Request::is('softwareCategory') ? 'active' : '' }}" href="/softwareCategory">Software Category</a></li>
              <li><a class="dropdown-item {{ Request::is('supplier') ? 'active' : '' }}" href="/supplier">Supplier</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Transaction
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item {{ Request::is('inventory') ? 'active' : '' }}" href="/inventory">Inventory</a></li>
              <li><a class="dropdown-item {{ Request::is('/') ? 'active' : '' }}" href="/hardware">Hardware</a></li>
              <li><a class="dropdown-item {{ Request::is('itemStock') ? 'active' : '' }}" href="/itemStock">Item Stock</a></li>
              <li><a class="dropdown-item {{ Request::is('hardwareModel') ? 'active' : '' }}" href="/hardwareModel">Hardware Model</a></li>
              <li><a class="dropdown-item {{ Request::is('hardwareType') ? 'active' : '' }}" href="/hardwareType">Hardware Type</a></li>
              <li><a class="dropdown-item {{ Request::is('manufacturer') ? 'active' : '' }}" href="/manufacturer">Manufacturer</a></li>
              <li><a class="dropdown-item {{ Request::is('memory') ? 'active' : '' }}" href="/memory">Memory</a></li>
              <li><a class="dropdown-item {{ Request::is('processor') ? 'active' : '' }}" href="/processor">Processor</a></li>
              <li><a class="dropdown-item {{ Request::is('storage') ? 'active' : '' }}" href="/storage">Storage</a></li>
              <li><a class="dropdown-item {{ Request::is('project') ? 'active' : '' }}" href="/project">Project</a></li>
              <li><a class="dropdown-item {{ Request::is('softwareCategory') ? 'active' : '' }}" href="/softwareCategory">Software Category</a></li>
              <li><a class="dropdown-item {{ Request::is('supplier') ? 'active' : '' }}" href="/supplier">Supplier</a></li>
            </ul>
          </li>
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