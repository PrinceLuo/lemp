<!DOCTYPE html>
<html>
    <!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  
  <script src="{{ asset('js/pusher.min.js') }}"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e85856a237eefdafe445', {
      cluster: 'ap1',
      encrypted: true
    });

    var channel = pusher.subscribe('testChannel');
    channel.bind("App\\Events\\Event", function(data) {
      console.log(data.message);
    });
    
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>testChannel</code>
    with event name <code>Event</code>.
  </p>
</body>
</html>
