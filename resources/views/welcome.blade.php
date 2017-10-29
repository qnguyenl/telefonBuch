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
        <p>another version of dastelefonbuch.de. It's just a little crappier :D</p>
    </div>
    <div class="row">
        <h1>Was suchen Sie?</h1>
    </div>
    <div class="row">
        <form action="/search" method="get" class="form-inline">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" placeholder="Wer/Was" autocomplete="off"/>
                <div class="selectable"><ul class="list-group"></ul></div>
            </div>
            <div class="form-group">
            <span>
                <input type="text" name="location" class="form-control" placeholder="Wo" autocomplete="off"/>
                <div id="locationresult" class="selectable"><ul class="list-group"></ul></div>
            </span>
            </div>
            <button type="submit" class="btn btn-primary">Finden</button>
        </form>
    </div>

    <div class="row" id="result" class="hitslist" style="text-align: left">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Adress</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($hits))
                @foreach($hits as $hit)
                    <tr>
                        <td>{{$hit->displayName}}</td>
                        <td>{{$hit->address->street.' '.$hit->address->houseNo.', '.$hit->address->postalCode.' '.$hit->address->locationName}}</td>
                    </tr>
                    <p></p>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    @if(isset($paginator))
        {{ $paginator->links() }}
    @endif
</div>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
</body>
</html>