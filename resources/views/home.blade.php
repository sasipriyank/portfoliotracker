@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


					 <table border="5" column="6">



                    <tbody>


                    <tr>
                        <td>Company Details  </td>
                        <td>  </td>

                    </tr>

                  @foreach( $data AS $key => $results )
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $results }}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
