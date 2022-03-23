<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Book Details</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    <body>
        <h2>Edit Book Details</h2><br />
        <form method="post" action="{{action('BookController@update', $id)}}">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <p>
                <label for="code">Book Code: </label>
                <input type="text" name="code" value="{{$book->code}}">
            </p>
            <p>
                <label for="name">Book Name: </label>
                <input type="text" name="name" value="{{$book->name}}">
            </p>
            <p>
                <label for="name">Book Description: </label>
                <input type="text" name="desc" value="{{$book->name}}">
            </p>
            <p>
                <button type="submit" style="margin-left:38px">Update</button>
            </p>
         </form>
        
    </body>
</html>
