@auth
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">Rumah</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link
              <?php if(Request::segment(1) == '') echo "active"; ?>
              " aria-current="page" href="/">Dashborad</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link 
              <?php if(Request::segment(1) == 'kamar' && Request::segment(2) == '1') echo "active"; ?>
              " href="/kamar/1">kamar 1</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link
              <?php if(Request::segment(1) == 'kamar' && Request::segment(2) == '2') echo "active"; ?>
              " href="/kamar/2">kamar 2</a>
            </li>
          </ul>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link class="nav-link" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Logout
                    </x-dropdown-link>
                </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    @else
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container">
              <a class="navbar-brand" href="/">Rumah</a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span> --}}
            </button>
        </div>
    </nav>

@endauth
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div class="container">
        <a class="navbar-brand" href="/">Rumah</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="mr-auto navbar-nav"></ul>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">kamar 1</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">kamar 2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav> -->