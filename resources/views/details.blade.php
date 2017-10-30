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
    <div class="alert alert-warning" role="alert">
        <h1>yelBook</h1>
        <p>is another version of dastelefonbuch.de. It's just a little crappier :D</p>
    </div>
    <div class="row">
        <h1>Was suchen Sie?</h1>
    </div>
    <div class="row">
        <form action="/search" method="get" class="form-inline">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" placeholder="Wer/Was" autocomplete="off" @if(isset($keyword))value="{{$keyword}}"@endif/>
                <div class="selectable"><ul class="list-group"></ul></div>
            </div>
            <div class="form-group">
            <span>
                <input type="text" name="location" class="form-control" placeholder="Wo" autocomplete="off" @if(isset($location))value="{{$location}}"@endif/>
                <div id="locationresult" class="selectable"><ul class="list-group"></ul></div>
            </span>
            </div>
            <button type="submit" class="btn btn-primary">Finden</button>
        </form>
    </div>
    <div class="row" style="text-align: left;">
        <a type="button" class="btn btn-primary" href="{{$startToken or '/'}}">zurück</a>
    </div>
    <div class="row" id="result" class="hitsresult" style="margin-top: 5px; border: 1px solid darkgrey; height: 400px; padding: 20px;">
        <div class="col-md-4" style="text-align: left;">
            <div class="row"><h3>{{$displayName or "Notfound"}}</h3></div>
            <div class="row">Telephone: {{$tel or "Notfound"}}</div>
            <div class="row">Adresse: {{$address or "Notfound"}}</div>
        </div>
        <div class="col-md-4" style="text-align: left;">

        </div>
        <div class="col-md-4" style="text-align: right;">
            <img src="{{$logoUri or null}}">
        </div>
    </div>
</div>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
</body>
</html>