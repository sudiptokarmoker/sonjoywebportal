<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Robindra Nath</title>

    <link href="{{asset('/')}}frontend/assets/css/bootstrap.min.css" rel="stylesheet">
{{--    <link href="bootstrap.css" rel="stylesheet">--}}

    <link href="{{asset('/')}}frontend/assets/css/style.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark ms-auto shadow-lg sticky-top">
    <div class="container">
        <a href="" class="navbar-brand"><h2>BISSHO || KOBI</h2></a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#colapsicon">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="colapsicon">
            <ul class="navbar-nav ms-auto">
                <li><a href="{{route('front.home')}}" class="nav-link active">HOME</a></li>
                <li><a href="{{route('front.artist')}}" class="nav-link">ARTIST</a></li>
                <li><a href="" class="nav-link">CONTACT</a></li>
                <li><a href="" class="nav-link">MY BLOG</a></li>
                <li class="dropdown"><a href="" class="nav-link dropdown-toggle" data-bs-target="#dropdown" data-bs-toggle="dropdown">FOLLOW</a>
                    <ul class="dropdown-menu dropdown-menu-dark bg-dark" id="dropdown">
                        <li><a href="" class="dropdown-item">Facebook</a></li>
                        <li><a href="" class="dropdown-item">Twitter</a></li>
                        <li><a href="" class="dropdown-item">LinkedIN</a></li>
                        <li><a href="" class="dropdown-item">Skype</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">LOGGED-IN </a>
                    <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                        <li><a href="" class="dropdown-item">Logout</a></li>
                    </ul>
                </li>
                <li>
                    <form action="" class="">
                        <input type="text" class="form-control bg-dark text-white" name="search" placeholder="search.."/>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--Hero Area-->
<section class="py-5 shadow">
    <div class="container">
        <div class="row flex-lg-row-reverse align-content-center g-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{asset('/')}}frontend/assets/images/RT4.jpg" alt="" class="hero">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3 text">This Is a left Content </h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur cupiditate dolorem ea esse hic laboriosam minus
                    obcaecati quas sapiente veniam? Consectetur facilis inventore, iste molestias mollitia odio officiis optio tempora!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda cupiditate, \
                    deserunt et eum excepturi fuga illo iusto natus nihil quae quam quis sunt. Aperiam aut molestiae quis quo sequi.</p>
                <button class="btn btn-lg btn-outline-secondary">Read More</button>
            </div>
        </div>
    </div>
</section>

@yield('body')

<section class="bgBody">
    <div class="container">
        <footer class="py-5">
            <div class="row">
                <div class="col-6 col-md-3">
                    <h5>SECTION</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">Home</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">Features</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">FAQs</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">About</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-3">
                    <h5>SECTION</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">Home</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">Features</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">FAQs</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link text-muted">About</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-6">
                    <form action="">
                        <h5>Subscribe To My Site</h5>
                        <p>Subscribe And Give us Your Mail To get More</p>
                        <div class="flex-sm-column flex-column w-100 gap-2">
                            <label for="" class="visually-hidden">Email Address</label>
                            <input type="text" class="form-control mb-3" placeholder="Email Address..">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </footer>
    </div>
</section>
<script src="{{asset('/')}}frontend/assets/js/bootstrap.js"></script>
<!--<script src="bootstrap.min.js"></script>-->
<script src="{{asset('/')}}frontend/assets/js/jquery-3.6.0.js"></script>

</body>
</html>
