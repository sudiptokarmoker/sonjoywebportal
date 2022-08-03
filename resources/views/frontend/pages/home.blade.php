@extends('master.front.master')

@section('body')
    <section class="py-5 bgFooter">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card bg-transparent">
                        <div class="row">
                            <div class="col-sm-9">
                                <a href="{{route('front.artistDetail', ['id' =>$post->artists_id])}}" class="text-decoration-none text-dark">
                                    {{$post->title}}
                                </a>
                            </div>

                                <div class="col-sm-3 text-xxl-end text-uppercase ">
                                    @foreach($categories as $category)
                                        @if($category->id == $post->root_category_id)
                                            <a href="#" class="text-decoration-none text-danger">{{$category->category_name}}</a>
                                        @endif
                                    @endforeach
                                </div>

                        </div>
                            <hr/>
                            @foreach($artists as $artist)
                                @if($post->artists_id == $artist->id)
                                    <a href="{{route('front.artistList', ['id' =>$artist->id,'name'=>$artist->name_in_bangla])}}" class="text-decoration-none font-weight-bold"><p class="card-title ">{{$artist->name_in_bangla}}</p></a>
                                @endif
                            @endforeach
                            <hr/>
                            <div class="card-body">
                                <a href="{{route('front.artistDetail', ['id' =>$post->artists_id])}}" class="text-decoration-none"><h3 class="text-success">{{$post->content}}</h3></a>
                            </div>
                            <div class="card-footer"><a href="" class=""></a></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
