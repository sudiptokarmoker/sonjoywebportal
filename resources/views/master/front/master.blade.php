<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sonjoyweb Portal</title>

    <link href="{{asset('/')}}public/frontend/assets/css/bootstrap.min.css" rel="stylesheet">
{{--    <link href="bootstrap.css" rel="stylesheet">--}}

    <link href="{{asset('/')}}public/frontend/assets/css/style.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-success ms-auto shadow-lg sticky-top">
    <div class="container">
        <a href="" class="navbar-brand"><h2>sonjoy-web</h2></a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#colapsicon">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="colapsicon">
            <ul class="navbar-nav ms-auto main-navmenu">
                <li><a href="{{route('front.home')}}" class="nav-link active">HOME</a></li>
                {{-- <li><a href="{{route('front.artist')}}" class="nav-link">ARTIST</a></li>
                <li><a href="#" class="nav-link">Verses</a></li>
                <li><a href="#" class="nav-link">Songs</a></li>
                <li><a href="#" class="nav-link">Novels</a></li>
                <li><a href="#" class="nav-link">Stories</a></li>
                <li><a href="#" class="nav-link">Plays</a></li>
                <li><a href="#" class="nav-link">Essays</a></li> --}}
                {{-- <li class="dropdown">
                    <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">LOGGED-IN </a>
                    <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                        <li><a href="" class="dropdown-item">Logout</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>

<!--Hero Area-->
<section class="py-5 shadow">
    <div class="container">
        <div class="row flex-lg-row-reverse align-content-center g-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{asset('/')}}public/frontend/assets/images/sonjoy-chakraborty.jpg" alt="" class="hero">
            </div>
            <div class="col-lg-6">
                <h2 class="text">আমার ওয়েব পোর্টাল আপনাকে স্বাগতম </h2>
                <p>রবীন্দ্রনাথের কাব্যসাহিত্যের বৈশিষ্ট্য ভাবগভীরতা, গীতিধর্মিতা চিত্ররূপময়তা, অধ্যাত্মচেতনা, ঐতিহ্যপ্রীতি, প্রকৃতিপ্রেম, মানবপ্রেম, স্বদেশপ্রেম, বিশ্বপ্রেম, রোম্যান্টিক সৌন্দর্যচেতনা, ভাব, ভাষা, ছন্দ ও আঙ্গিকের বৈচিত্র্য, বাস্তবচেতনা ও প্রগতিচেতনা। রবীন্দ্রনাথের গদ্যভাষাও কাব্যিক। ভারতের ধ্রুপদি ও লৌকিক সংস্কৃতি এবং পাশ্চাত্য বিজ্ঞানচেতনা ও শিল্পদর্শন তার রচনায় গভীর প্রভাব বিস্তার করেছিল। কথাসাহিত্য ও প্রবন্ধের মাধ্যমে তিনি সমাজ, রাজনীতি ও রাষ্ট্রনীতি সম্পর্কে নিজ মতামত প্রকাশ করেছিলেন। সমাজকল্যাণের উপায় হিসেবে তিনি গ্রামোন্নয়ন ও গ্রামের দরিদ্র মানুষ কে শিক্ষিত করে তোলার পক্ষে মতপ্রকাশ করেন।এর পাশাপাশি সামাজিক ভেদাভেদ, অস্পৃশ্যতা, ধর্মীয় গোঁড়ামি ও ধর্মান্ধতার বিরুদ্ধেও তিনি তীব্র প্রতিবাদ জানিয়েছিলেন। রবীন্দ্রনাথের দর্শনচেতনায় ঈশ্বরের মূল হিসেবে মানব সংসারকেই নির্দিষ্ট করা হয়েছে</p>
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
