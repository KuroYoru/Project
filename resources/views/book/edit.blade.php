<!DOCTYPE html>
@extends('layouts.app')
@section('title','Edit Book')
@section('content')


<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 style="align-content: ">Edit Book Details</h2><br/>
    <form method="post" action="{{action('BookController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        
        <div class="form-group">
            <label for="name">Book Name: </label>
            <input class="form-control" type="text" name="name" value="{{$book->bookName}}">
        </div>
        <div class="form-group">
            <label for="name">Book Description: </label>
            <input class="form-control" type="text" name="desc" value="{{$book->bookDesc}}">
        </div>
        <div class="form-group">
            <label for="price">Book Price: </label>
            <input class="form-control" type="text" name="price" value="{{$book->bookPrice}}">
        </div>
        <div>
                <label for="bookPrivilege">Book Privilege : </label><br>
                <input type="radio" id="priv0" class="radio-control" name="priv" value="0" required>
                <label for="priv0">0</label>
                
               
                <input type="radio" id="priv1" class="radio-control" name="priv" value="1" required>
                <label for="priv1">1</label>
                
                
                <input type="radio" id="priv2" class="radio-control" name="priv" value="2" required>
                <label for="priv2">2</label>
            </div>
        <br>
            <button type="submit" class="btn btn-warning" >Update</button>
            <a href="{{action('BookController@index')}}" class="btn btn-danger">Back</a>
    </form>


@endsection