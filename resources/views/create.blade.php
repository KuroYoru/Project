<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New Book</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    <body>
        <h2>Add New Book</h2><br/>
        <form method="post" action="{{url('books')}}">
            @csrf
            <p>
                <label for="bookCode">Book Code:</label>
                <input type="text" name="code">
            </p>
            <p>
                <label for="bookName">Book Name:</label>
                <input type="text" name="name">
            </p>
            <p>
                <label for="bookDesc">Book Description:</label>
                <input type="text" name="desc">
            </p>
            <p>
                <button type="submit">Submit</button>
            </p>
        </form>
    </body>
</html>
