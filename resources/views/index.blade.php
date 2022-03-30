<!DOCTYPE html>
@extends('layouts.app')
@section('title','Home')
@section('content')

<div class="container">
    <br />
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h1>New Arrivals</h1>
        </div>
        <div class ="col-md-4">
            <form action="/search" method="get">
                <div class="input-group" >
                    <input type="search" class="form-control" name="search">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="col-md-2 text-right">
            <a href="{{action('BookController@create')}}" class="btn btn-primary">Add New Book</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Book Code</th>
                <th>Book Name</th>
                <th>Book Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->bookCode}}</td>
                <td>{{$book->bookName}}</td>
                <td>{{$book->bookDesc}}</td>
                <td> 
                    <form action="{{action('BookController@destroy',$book->id)}}" method="post">
                        <a href="{{action('BookController@show', $book->id)}}" class="btn btn-info">Show</a>
                        <a href="{{action('BookController@edit', $book->id)}}" class="btn btn-warning">Edit</a>
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>

            </tr>
            @endforeach
        </tbody>
    </table>
    {{$books->links()}}

    @endsection
