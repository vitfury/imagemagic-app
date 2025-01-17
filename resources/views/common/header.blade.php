<nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
    <div class="container headerlogos">
        <a class="logostylesdesktop" href="/"><img class="logostylesdesktop" src="img/logo.png" alt="logo"></a>
        <div class="logo-mobile">
            <a class="Logo-mobile-fox-item" href="/"><img class="logostylemobilefox" src="img/fox.png" alt="logo"></a>
            <a class="" href="index.html"><img class="logostylemobilesign" src="img/sign.png" alt="logo"></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
        <div class="collapse navbar-collapse navbar-collapse__position" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-lg-5 text-center">
                <li class="nav-item"><a class="nav-link" href="/">Home </a></li>
                <li class="nav-item"><a class="nav-link" href="gallery">Sticker gallery </a></li>
                <li class="nav-item"><a class="nav-link" href="contacts">Contacts </a></li>
                <li class="nav-item"><a class="nav-link" href="index.html">About us </a></li>
                <li class="nav-item"><a class="nav-link" href="faq">faq </a></li>
            </ul>
                @auth
                    <a class="btn-teal btn rounded-pill px-4 ml-lg-4 navbar-loginbutton__center" href="/account">{{$user->email}} <i class="fas fa-arrow-right ml-1"></i></a>
                @endauth
                @guest
                    <a class="btn-teal btn rounded-pill px-4 ml-lg-4 navbar-loginbutton__center" href="login">Sign in / Sign up<i class="fas fa-arrow-right ml-1"></i></a>
                @endguest
        </div>
    </div>
</nav>
