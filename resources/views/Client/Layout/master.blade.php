<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    this is user page
    Name = {{Auth::user()->name}}
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button>log out</button>
    </form>
</body>
</html>
