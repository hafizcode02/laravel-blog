<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- this document is as template of mail message --}}
    <p>Name : {{ $data['name'] }}</p>
    <p>Email : {{ $data['email'] }}</p>
    <p>Tel : {{ $data['tel'] }}</p>
    <p>Message : {{ $data['message'] }}</p>
</body>

</html>
