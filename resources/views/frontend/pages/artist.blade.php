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
            <h1 class="display-5">Artists</h1>
            <hr/>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-transparent list-group border-0">
                        @foreach($artists as $artist)
                        <a href="{{route('front.artistList', ['id' =>$artist->id,'name'=>$artist->name_in_bangla])}}" class="list-group-item list-group-item-primary ">{{$artist->name_in_bangla}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr/>
        </div>

    </section>

@endsection
