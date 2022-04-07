@extends('layouts.app')
@section('title','HomePage')
@section('content')


<!-- Container (About Section) -->
<div class="w3-content w3-container w3-padding-64" id="about">
    <h1 class="w3-center w3-text-red ">Book Rental</h1></br>
    <h2 class="w3-center">Books for Rent</h2></br>
    <h3 class="w3-center">We have our own currency called Tokens. The conversion rate to token is 1 Ringgit To 10 Tokens</h3>
    </br>
    <div style="margin: 0 auto; text-align: center;" class="container" >
                <button> <a href="/book/books" class="w3-center w3-button "><i class="	fa fa-thumbs-o-up"></i> NEW ARRIVALS</a></button></br></br></br>
                
                @if (auth()->check() && auth()->user()->memberStatus ==1)
                <button> <a href="/book/bookXML" class="w3-button w3-hide-small"><i class="fa fa-th"></i> CURRENT BOOKS LIST</a></button></br></br></br>
                <button><a href="/book/showOwnedBookXML" class="w3-button w3-hide-small"><i class="fa fa-th"></i> OWNED BOOKS LIST</a></button></br></br></br>
                <button><a href="/book/topup" class="w3-button "><i class="fa fa-shopping-cart"></i> Top Up</a>
                @endif
    </div>



@endsection
