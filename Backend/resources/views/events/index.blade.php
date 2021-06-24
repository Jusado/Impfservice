<!DOCTYPE html>
<html>
<head>
    <title> Impfservice Test</title>
</head>
<body>
<ul>
    @foreach($events as $event)
        <li><a href="events/{{$event->id}}">{{$event->date}} {{$event->location}}</a> </li>
    @endforeach
</ul>
</body>
</html>
