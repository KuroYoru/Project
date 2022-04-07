

@extends('layouts.app')
@section('title','Create')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 style="align-content: ">Add New Book</h2><br/>
        <form method="get" action="{{action('BookController@topupped')}}">            
            <input class="form-control" name="userID" type="hidden" value="{{Auth::user()->id}}">
            <div class="form-group">
                <label for="bookName">Credit Card Number (Without Dashes):</label>
                <input class="form-control" type="text" placeholder="8888-8888-8888" name="name" required>
            </div>
            <div class="form-group">
            <input class="form-control" type="hidden" name="userTokens" value="{{Auth::user()->tokens}}">
            </div>
            <div
                <label for="bookPrivilege">Top Up Amount (RM1 = 10 Tokens): </label><br>
                <input type="radio" id="topup10" class="radio-control" name="topup" value="10" required>
                <label for="topup10">RM1</label>
                
               
                <input type="radio" id="topup30" class="radio-control" name="topup" value="30" required>
                <label for="topup30">RM3</label>
                
                
                <input type="radio" id="topup50" class="radio-control" name="topup" value="50" required>
                <label for="topup50">RM5</label>
            </div>
            <br>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection

