<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 class="text-upper fw-bold" >This is user home page</h1>
    <ul>
        <li>User Info</li>
        <li>{{Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name}}</li>
        <li>{{Auth::user()->email}}</li>
        <li>{{Auth::user()->role}}</li>
    </ul>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <input type="submit" value="Log Out">
    </form>
</body>
</html>
