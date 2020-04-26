<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirect</title>
    <meta name="csrf-token" content="{{csrf_token()}}">

    {{ Html::script('js/manifest.js') }}
    {{ Html::script('js/vendor.js') }}

    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/styles.bundle.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="d-flex flex-column align-items-center justify-content-center vh-100">
        <div style="width:200px;height:200px" class="lottie"
             data-animation-path="/assets/lottie-animations/launch-qualibrate.json"
             data-anim-loop="true"
             data-name="launch"></div>
        <p>Taking you places...</p>
        {!! Form::open(['method' => 'POST', 'route' => $destination_route, 'id' => 'redirect-form']) !!}
        {!! Form::close() !!}
    </div>
</div>
    {{ Html::script('js/app.js') }}

    <script>
        $(document).ready(() => {
            setTimeout(function(){
                $('#redirect-form').submit();
            }, 2000)
        });
    </script>
</body>
</html>
