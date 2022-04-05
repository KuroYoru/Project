
@extends('layouts.app')
@section('title','Show Book')
@section('content')
<div class="card" style="width:350px; margin:auto; ">
    @foreach($books as $book)
    <img class="card-img-top" src="https://thumbs.dreamstime.com/b/book-icon-vector-design-library-symbol-web-graphic-jpg-ai-app-logo-object-flat-image-sign-eps-art-picture-stock-79808709.jpg"/>
    <div class="card-body " >
        <div class="card-title">Book Name: {{$book->bookName}}</div>
        <p class="card-text">Book Description: {{$book->bookDesc}}</p>
        <div class="card-title">Book Price (token): {{$book->bookPrice}}</div>
        <div class="card-title">Book Privilege: {{$book->bookPrivilege}}</div>
        @if (auth()->check() && auth()->user()->memberStatus >= 0)
        @csrf
        <a href="{{action('BookController@buy', $book->id)}}" class="btn btn-primary">Buy</a>
        @endif
        <a href="{{action('BookController@index')}}" class="btn btn-warning">Back</a>
    </div>
    @endforeach
</div>

@endsection}
</div>