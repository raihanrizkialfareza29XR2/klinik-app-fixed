<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ url('front/images/mpk.png') }}" alt="mpk" style="width: 50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="mdi mdi-menu"> </i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="d-lg-none d-flex justify-content-between px-4 py-3 align-items-center">
                <img src="{{ url('front/images/mpk.png') }}" class="logo-mobile-menu d-block mx-auto" alt="logo">
                <a href="javascript:;" class="close-menu"><i class="mdi mdi-close"></i></a>
            </div>
            <ul class="navbar-nav ml-auto align-items-center">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Panduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Prosedur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#projects">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimonial">Quotes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#plans">Direct</a>
                </li>
                @if (session()->get('username'))
                <li class="nav-item">
                    <a class="nav-link btn btn-success" href="{{ route('logoutuser') }}">Logout</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link btn btn-success" href="{{ route('userlogin') }}">Login</a>
                </li>
                @endif --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#home">Chart</a>
                </li>
                @if (session()->get('svoting'))
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary" href="{{ route('logoutuser') }}">Logout</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary" href="{{ route('userlogin') }}">Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>