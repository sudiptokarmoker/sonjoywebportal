@extends('master.front.master')

@section('body')

    <section>
        <div class="container">
            <ul class="breadcrumb">
            </ul>
        </div>
    </section>
    <section class="bgFooter">

        <div class="container">
            <h1 class="display-5">{{$name}}</h1>
            <hr/>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-transparent list-group border-0">
                        @foreach($posts as $post)
                            <a href="{{route('front.artistDetail', ['id' =>$post->artists_id])}}" class="list-group-item list-group-item-primary ">{{$post->title}}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-transparent">
                        <div class="card bg-transparent list-group">
                            <a href="#" class="list-group-item list-group-item-primary ">Robibndro tagore</a>
                            <a href="#" class="list-group-item list-group-item-secondary">nazrul</a>
                            <a href="#" class="list-group-item list-group-item-info">srikanto</a>
                            <a href="#" class="list-group-item list-group-item-success">sumon</a>
                            <a href="#" class="list-group-item list-group-item-warning">kishore</a>
                            <a href="#" class="list-group-item list-group-item-light">bahuballav</a>
                            <a href="#" class="list-group-item list-group-item-danger">mankar </a>
                            <a href="#" class="list-group-item list-group-item-dark">chippa vchapi</a>
                            <a href="#" class="list-group-item list-group-item-info">chippa vchapi</a>
                            <a href="#" class="list-group-item list-group-item-success">chippa vchapi</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card bg-transparent">
                        <div class="card bg-transparent list-group">
                            <a href="#" class="list-group-item list-group-item-primary ">Robibndro tagore</a>
                            <a href="#" class="list-group-item list-group-item-secondary">nazrul</a>
                            <a href="#" class="list-group-item list-group-item-info">srikanto</a>
                            <a href="#" class="list-group-item list-group-item-success">sumon</a>
                            <a href="#" class="list-group-item list-group-item-warning">kishore</a>
                            <a href="#" class="list-group-item list-group-item-light">bahuballav</a>
                            <a href="#" class="list-group-item list-group-item-danger">mankar </a>
                            <a href="#" class="list-group-item list-group-item-dark">chippa vchapi</a>
                            <a href="#" class="list-group-item list-group-item-info">chippa vchapi</a>
                            <a href="#" class="list-group-item list-group-item-success">chippa vchapi</a>
                        </div>
                    </div>
                </div>

            </div>
            <hr/>
        </div>

    </section>

@endsection
