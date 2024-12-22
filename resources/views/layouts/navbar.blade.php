<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="{{ asset('assets/images/awan.png') }}" style="margin-top: 12px;" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    {{-- <div class="search-input">
                      <form id="search" action="#">
                        <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                        <i class="fa fa-search"></i>
                      </form>
                    </div> --}}
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('dashboard') }}" class="active">Beranda</a></li>
                        <li><a href="{{ route('produk') }}">Produk</a></li>
                        <li><a href="{{ route('pesanan.index') }}">Status Pesanan</a></li>
                        <li><a href="#">Bantuan</a></li>
                        {{-- <li><a href="profile.html">Profil</li> --}}
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
