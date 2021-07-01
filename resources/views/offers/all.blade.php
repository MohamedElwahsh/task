<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }} <span class="sr-only">(current)</span></a>
                </li>
            @endforeach
        </ul>

    </div>
</nav>

@if(Session::has('success'))
    <div class="alert.alert-success">
    {{ Session::get('success') }}
    </div>
    @endif
@if(Session::has('error'))
    <div class="alert.alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
<div class="flex-center position-ref full-height">
    <div class="content">
{{--        <div class="title m-b-md">--}}
{{--            {{ __('messages.Add your offer') }}--}}
{{--        </div>--}}

        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ __('messages.Offer Number') }}</th>
                <th scope="col">{{ __('messages.Offer Name') }}</th>
                <th scope="col">{{ __('messages.Offer Price') }}</th>
                <th scope="col">{{ __('messages.Offer Details') }}</th>
                <th scope="col">{{ __('messages.Offer Image') }}</th>
                <th scope="col">{{ __('messages.Operations') }}</th>


            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
            <tr>
                <th scope="row">{{ $offer -> id }}</th>
                <td>{{ $offer -> name }}</td>
                <td>{{ $offer -> price }}</td>
                <td>{{ $offer -> details }}</td>
                <td>  <img src="{{asset('images/offers/'.$offer -> photo)}}"></td>

                <td> <a href="{{ url('offers/edit/'.$offer -> id) }}" class="btn btn-success">{{ __('messages.edit') }}</a></td>
                <td> <a href="{{ url('offers/delete/'.$offer -> id) }}" class="btn btn-success">{{ __('messages.delete') }}</a></td>

            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>

</html>
