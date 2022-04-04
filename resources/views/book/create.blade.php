<!DOCTYPE html>
@extends('layouts.app')
@section('title','Create')
@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 style="align-content: ">Add New Book</h2><br/>
        <form method="post" action="{{url('book/books')}}">
            @csrf
            <div class="form-group">
                <label for="bookCode">Book Code:</label>
                <input class="form-control" type="text" placeholder="Book Code (Numbers Only)" name="code" required>
            </div>
            <div class="form-group">
                <label for="bookName">Book Name:</label>
                <input class="form-control" type="text" placeholder="Enter Book Name here" name="name" required>
            </div>
            <div class="form-group">
                <label for="bookDesc">Book Description:</label>
                <textarea  class="form-control" rows = "5" cols = "60" placeholder="Enter Book Description here" name = "desc" required></textarea>
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
