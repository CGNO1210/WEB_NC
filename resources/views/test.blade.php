<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/testupimg" enctype="multipart/form-data" method="post">
        <input type="file" name="fileTest">
        <button type="submit">Upload</button>
        @csrf
    </form>
</body>
</html>