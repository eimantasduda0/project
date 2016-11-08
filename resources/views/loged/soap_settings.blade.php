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
            
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Data import</div>

                    <div class="panel-body">
                        <div><a class="btn btn-primary" onclick="Import('items');">Import items</a></div>
                        <div style="margin-top: 10px;"><a class="btn btn-primary" onclick="Import('properties');">Import properties</a></div>
                        <div style="margin-top: 10px;"><a class="btn btn-primary" onclick="Import('listings');">Import listings</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    
    function Import($what){
        if ($what == 'items'){
            $url = '?items=1'
        }
        if ($what == 'listings'){
            $url = '?listings=1'
        }
        if ($what == 'properties'){
            $url = '?properties=1'
        }
        $.post( "{!! route('import') !!}"+$url, function() {
          swal("Started", "Import operation will be started in 10 seconds", "success");
        });
    }
    
</script>
@endsection