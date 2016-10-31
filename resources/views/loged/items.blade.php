@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Items</div>

                    <div class="panel-body">
                        <table class="table table-hover">
                        	<thead>
                        		<tr>
                        			<th>System id</th>
                        			<th>Name</th>
                        			<th>Price</th>
                        			<th>Created</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		@foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->system_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}<br/>
                                        <pre>
                                            <!--{{ print_r($item->objects) }}-->
                                        </pre>
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><a href="{{ route('itemSettings',['id'=>$item->id]) }}"><i class="fa fa-gear fa-2x"></i> </a> </td>
                                    </tr>
                                @endforeach
                        	</tbody>
                        </table>
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
