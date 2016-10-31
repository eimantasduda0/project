@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in! <a href="{{ url('/home?items=1') }}">Get items</a>
                    <div><a href="{{ url('/home?listings=1') }}">Get listings</a> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
