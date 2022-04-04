<!DOCTYPE html>
@extends('layouts.app')
@section('title','New Arrivals')
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
                    <input type="search" class="form-control " name="search">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="col-md-2 text-right">
            @if (auth()->check() && auth()->user()->memberStatus)
            <a href="{{action('BookController@create')}}" class="btn btn-primary">Add New Book</a>
            @endif
        </div>
    </div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                @if (auth()->check() && auth()->user()->memberStatus)
                <th>ID</th>
                @endif
                <th>Book Code</th>
                <th>Book Name</th>
                <th>Book Description</th>
                <th>Book Privilege</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                @if (auth()->check() && auth()->user()->memberStatus)
                <td>{{$book->id}}</td>
                @endif
                <td>{{$book->bookCode}}</td>
                <td>{{$book->bookName}}</td>
                <td>{{$book->bookDesc}}</td>
                <td>{{$book->bookPrivilege}}</td>
                <td> 
                    @if (auth()->check() && auth()->user()->memberStatus >= 0)
                    @csrf
                    <a href="{{action('BookController@edit', $book->id)}}" class="btn btn-primary">Rent</a>
                    @endif
                    <a href="{{action('BookController@show', $book->id)}}" class="btn btn-primary">Show Details</a>
                    @if (auth()->check() && auth()->user()->memberStatus == 1)
                    <form action="{{action('BookController@destroy',$book->id)}}" method="post">      
                        <a href="{{action('BookController@edit', $book->id)}}" class="btn btn-warning">Edit</a>
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                    @endif

            </tr>
            @endforeach
        </tbody>
    </table>
    {{$books->links()}}

    @endsection
