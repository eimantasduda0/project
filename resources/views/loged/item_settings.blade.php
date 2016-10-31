@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Item information</div>

                    <div class="panel-body">
                        <table style="width: 100%;" class="">
                            <tr>
                                <td>Name: </td>
                                <td><b>{{ $item->name }}</b></td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td><b>{{ $item->price }}</b></td>
                            </tr>
                        </table>
                        <div>Item Object:</div>
                        <div>{!! dump(unserialize($item->object)) !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Item settings</div>

                    <div class="panel-body">

                        {!! Form::open() !!}

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            {!! Form::number('amount',old('amount'),['class'=>'form-control']) !!}
                        </div>


                        <div class="form-group">
                            <label for="type">Type of discount</label>
                            {!! Form::select('type',['percent'=>'Percentage','fixed'=>'Fixed'],null,['class'=>'form-control']) !!}

                        </div>

                        {!! Form::submit('Update', ['class'=>"btn btn-primary"]) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
