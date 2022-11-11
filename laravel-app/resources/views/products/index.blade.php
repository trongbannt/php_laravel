<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>This page Products index</h1>
    <h2>List Phone</h2>
    <div>
        <ul>
            @foreach ($dataPhone as $phone)
                <h3>
                    <ul>
                        <li>{{ $phone["name"] }}</li>
                        <li>{{ $phone["year"] }}</li>
                        <li>{{ $phone["price"] }}</li>
                    </ul>
                </h3>
            @endforeach
        </ul>
    </div>
</body>
</html>