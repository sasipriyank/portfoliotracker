<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Portfolio Tracker AP</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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



<h1>Company Portfolio</h1>
@if(Session::has('company'))
<h2> Company Name :  {{Session::get('company')}}</h2>
@endif
<div class="top-right links">
    @auth
        <a href="{{ url('dashboard') }}">Home</a>
    @else
        <a href="{{ url('login') }}">Login</a>




    @endauth
</div>
<table border="5" column="6">



<tbody>


<tr>
    <td>Date  </td>
    <td>Open  </td>
    <td>  </td>
    <td>High  </td>
    <td>  </td>
    <td>Low  </td><td>  </td>
    <td>Close  </td><td>  </td>
    <td>Volume</td><td>  </td>
</tr>

        @foreach( $data AS $date => $results )
        <tr>
            <td>{{ $date }}</td>
            @foreach( $results AS $key => $value )

            <td> {{ $key }}</td>


                <td>
                   {{$value}}

                </td>





            @endforeach
        </tr>
        @endforeach

</tbody>
</table>


    </body>

</html>
