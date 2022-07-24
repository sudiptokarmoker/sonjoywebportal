@extends('master.front.master')

@section('body')

    <section>
        <div class="container">
            <ul class="breadcrumb">
            </ul>
        </div>
    </section>

    <section class="py-5 bgFooter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card bg-transparent">
                        @foreach($artist as $artist)
                        <h2>{{$artist->name_in_bangla}}</h2>
                        @endforeach
                        <hr/>
                        <video width="320" height="240" controls>
                            <source src="movie.mp4" type="video/mp4">
                            <source src="movie.ogg" type="video/ogg">
                        </video>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card bg-transparent">
                        @foreach($posts as $post)
                        <h3>{{$post->title}}</h3>

                        <hr/>
                        <p>{{$post->content}}</p>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
