@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">SOAP Settings</div>

                    <div class="panel-body">
                        {!! Form::open() !!}

                            <div class="form-group">
                                <label for="">User</label>
                                <input type="text" class="form-control" name="user" id="" placeholder="" value="{{ old('user',$settings['user']) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" class="form-control" name="pass" id="" value="{{ old('user',$settings['pass']) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Url</label>
                                <input type="text" class="form-control" name="url" id="" placeholder="" value="{{ old('user',$settings['url']) }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection