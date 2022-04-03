<!DOCTYPE html>
@extends('layouts.app')
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
            <div>
                <label for="bookPrivilege">Book Privilege (What level member can access): </label><br>
                <input type="radio" id="priv0" class="radio-control" name="priv" value="0" required>
                <label for="priv0">0</label>
                <input type="radio" id="priv1" class="radio-control" name="priv" value="1" required>
                <label for="priv1">1</label>
                <input type="radio" id="priv2" class="radio-control" name="priv" value="2" required>
                <label for="priv2">2</label>
            </div>
            <br>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
