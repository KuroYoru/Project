<!DOCTYPE html>
@extends('layouts.app')
@section('title','Buy Book')
@section('content')


<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 style="align-content: ">Buy Book</h2><br/>
    <form method="get" action="{{action('BookController@bought')}}">
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
            <input class="form-control" type="hidden" name="bookID" value="{{$book->id}}">
        </div>
        <div class="form-group">
            <input class="form-control" type="hidden" name="userID" value="{{Auth::user()->id}}">
        </div>
        <div class="form-group">
            <input class="form-control" type="hidden" name="userTokens" value="{{Auth::user()->tokens}}">
        </div>
        <div class="card-title" name="bookName">Book Name: {{$book->bookName}}</div>
        <p class="card-text">Book Description: {{$book->bookDesc}}</p>
         <div class="form-group">
            <input class="form-control" type="hidden" name="price" value="{{$book->bookPrice}}">
        </div>
        @if(auth()->user()->tokens < $book->bookPrice)
        <p class="card-text">Not enough tokens!! top up first</p>
        @else
        <button type="submit" class="btn btn-warning" >Buy</button>
        @endif
        <a href="{{action('BookController@index')}}" class="btn btn-danger">Back</a>
    </form>

@endsection
