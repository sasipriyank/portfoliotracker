<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portfolio Tracker App</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
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
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('dashboard') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>


                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <form action="{{ url('searchposts') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-10 offset-1 text-center">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h3>PortfolioTracker</h3>
                                        </div>
                                        <div class="card-body" style="height: 210px;">
                                            <input type="text" id='employee_search' name="employee_search" placeholder="--search Company--">
                                            <span class="text-danger">{{ $errors->first('employee_search') }}</span>
                                            <input type="hidden" id='employeeid' readonly>
                                            <button type="submit" name="submit">Submit</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
        <!-- Script -->
        <script type="text/javascript">

            // CSRF Token
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function(){

                $( "#employee_search" ).autocomplete({
                    source: function( request, response ) {
                        // Fetch data
                        $.ajax({
                            url:"{{route('ApiHandlerController.getCompanies')}}",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: CSRF_TOKEN,
                                search: request.term
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },
                    select: function (event, ui) {
                        // Set selection
                        $('#employee_search').val(ui.item.label); // display the selected text
                       // $('#employeeid').val(ui.item.value); // save selected id to input
                        return false;
                    }
                });

            });
        </script>
    </body>
</html>
