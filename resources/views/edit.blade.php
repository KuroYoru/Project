<!DOCTYPE html>
@extends('layout')
@section('title','Edit Book')
@section('content')


<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 style="align-content: ">Edit Book Details</h2><br/>
    <form method="post" action="{{action('BookController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
            <label for="code">Book Code: </label>
            <input class="form-control" type="text" name="code" value="{{$book->bookCode}}">
        </div>
        <div class="form-group">
            <label for="name">Book Name: </label>
            <input class="form-control" type="text" name="name" value="{{$book->bookName}}">
        </div>
        <div class="form-group">
            <label for="name">Book Description: </label>
            <input class="form-control" type="text" name="desc" value="{{$book->bookDesc}}">
        </div>
        <br>
            <button type="submit" class="btn btn-warning" >Update</button>
            <a href="{{action('BookController@index')}}" class="btn btn-danger">Back</a>
    </form>


@endsection