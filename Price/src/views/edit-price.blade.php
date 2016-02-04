@extends('Core::admin-master')

@section('Item::title', 'Laravel 5.1')

@section('content')
			<h2>Edit Price</h2><br />	
	

<div class="row">


		<div class="col-sm-12">

			@if(Session::has('message'))

				<p style="padding:10px" class="bg-success">{{ Session::get('message') }}</p>
				
			@endif				

			@foreach($errors->all() as $error)

				<p style="padding:10px" class="bg-danger">{{ $error }}</p>

			@endforeach
				
				<div class="panel panel-default">

						<div class="panel-heading">
		<h3 class="panel-title">Edit Price</h3>
	</div>

				<div style="padding:20px;">

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin-price.update', $price->id]]) !!}

						<p>Name:<input type="text" name="name" style="width:100%;" value="{{ $price->name }}" /></p>

						<p>Price:<input type="text" name="price" style="width:100%;" value="{{ $price->price }}" /></p>
						
						<input type="submit" value="Update" class="btn btn-small btn-info">

					{!! Form::close() !!}

			 	</div>

				</div><!-- .panel-default -->
			
		</div><!-- .col-sm-12 -->

	</div><!-- .row -->

	<div class="row">


		<div class="col-sm-12">
				
				
				<div class="panel panel-default">

						<div class="panel-heading">
		<h3 class="panel-title">Add New Price Break-Point</h3>
	</div>

				<div style="padding:20px;">

					{!! Form::open(['method' => 'POST', 'route' => ['admin-price-breakpoint.store']]) !!}

						<div class="row">

							<div class="col-sm-4">
								<p>Range from:<input type="text" name="rangeFrom" style="width:100%;" /></p>
							</div>

							<div class="col-sm-4">
								<p>Range to:<input type="text" name="rangeTo" style="width:100%;" /></p>
							</div>

							<div class="col-sm-4">
								<p>Price:<input type="text" name="price" style="width:100%;" /></p>
							</div>							

						</div><!-- .row -->

						<input type="hidden" name="priceID" value="{{ $price->id }}" />

						<input type="submit" value="Add price break-point" class="btn btn-success idh-button form-control">

					{!! Form::close() !!}

				</div>

				</div><!-- .panel-default -->
			
		</div><!-- .col-sm-12 -->

	</div><!-- .row -->

<div class="row">

<div class="row">


		<div class="col-sm-12">
				
				<div class="panel panel-default">

						<div class="panel-heading">
		<h3 class="panel-title">Current Price Break-Points</h3>
	</div>

				<div style="padding:20px;">


	<table class="table table-striped table-bordered">
	    <thead>
	        <tr>
	        	<td>Range from</td>
	            <td>Range to</td>
	            <td>Price</td>
	            <td>Delete</td>
	        </tr>
	    </thead>
    	<tbody>

					@foreach($priceBreakPoints as $priceBreakPoint)
						<tr>

							<td>{{ $priceBreakPoint->range_from }}</td>
							<td>{{ $priceBreakPoint->range_to }}</td>
							<td>{{ $priceBreakPoint->price }}</td>

							<td>
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin-price-breakpoint.destroy', $priceBreakPoint->id]]) !!}

	{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

{!! Form::close() !!}</td>

						</tr>

					@endforeach

		</tbody>
				
	</table>				
					

				</div>

				</div><!-- .panel-default -->
			
		</div><!-- .col-sm-12 -->

	</div><!-- .row -->


				
@endsection