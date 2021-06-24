<!DOCTYPE html>
<html>
<head>
    <title> Impfservice Test</title>
</head>
<body>
<ul>
    @foreach($events as $event)
        <li>{{$event->date}} {{$event->location}}</li>
    @endforeach
</ul>
</body>
</html>
