<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>

<body>
    <h1>{{ $title }}</h1>
    <ul>
        @foreach($students as $student)
            <li>{{ $student }}</li>
        @endforeach
    </ul>
</body>

</html>
