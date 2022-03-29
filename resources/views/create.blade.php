<!DOCTYPE html>
@extends('layout')
@section('title','Create')
@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 style="align-content: ">Add New Book</h2><br/>
        <form method="post" action="{{url('books')}}">
            @csrf
            <div class="form-group">
                <label for="bookCode">Book Code:</label>
                <input class="form-control" type="text" name="code" required>
            </div>
            <div class="form-group">
                <label for="bookName">Book Name:</label>
                <input class="form-control" type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="bookDesc">Book Description:</label>
                <input class="form-control" type="text" name="desc" required>
            </div>
            <br>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
