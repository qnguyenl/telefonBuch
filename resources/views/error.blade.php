<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>yelBook</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
<div class="container" style="text-align: center">
    <div class="row">
        <h1>Oops! Something went wrong</h1>
        <a href="/">Back to Homepage</a>
    </div>
    @if(isset($host))
    <div class="row alert alert-danger">
        <p>{{$host or ""}}<p>
        <p>{{$response or ""}}<p>
    </div>
    @endif
</div>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
</body>
</html>