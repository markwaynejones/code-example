@extends('Core::admin-master')

@section('Item::title', 'Laravel 5.1')

@section('content')

<h2>Edit Price Group</h2><br />	
	
<div class="row">

	<div class="col-sm-4">

		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">Create Price For Group</h3>
			</div>

				<div style="padding:20px;">

					{!! Form::open(['method' => 'POST', 'route' => ['admin-price.store']]) !!}

						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" style="width:100%;" class="form-control" />
						</div>

						<div class="form-group">
							<label for="price">Price</label>
							<input type="text" name="price" style="width:100%;" class="form-control" />
						</div>

						<input type="hidden" name="priceGroupID" value="{{ $priceGroup->id }}" />

						<input type="submit" value="Create" class="btn btn-small btn-info">

					{!! Form::close() !!}		

				</div>

				</div><!-- .panel-default -->

		</div><!-- .col-sm-4 -->

		<div class="col-sm-8">

			@if(Session::has('message'))

				<p style="padding:10px" class="bg-success">{{ Session::get('message') }}</p>
				
			@endif					
				
				<div class="panel panel-default">

					<div class="panel-heading">
						<h3 class="panel-title">Price Group Name</h3>
					</div>

					<div style="padding:20px;">

						{!! Form::open(['method' => 'PATCH', 'route' => ['admin-price-group.update', $priceGroup->id]]) !!}

							<input type="text" name="name" style="width:100%;" value="{{ $priceGroup->name }}" /><br /><br />
						
							<input type="submit" value="Update" class="btn btn-small btn-info">

						{!! Form::close() !!}

					</div>

				</div><!-- .panel-default -->

				<div class="panel panel-default">

						<div class="panel-heading">
		<h3 class="panel-title">Prices</h3>
	</div>

				<div style="padding:20px;">

				@foreach($prices as $price)

					<p>
						<a href="/sort-price/{{ $priceGroup->id }}/{{ $price->id }}/up"><span class="glyphicon glyphicon-arrow-up"></span></a> &nbsp; | &nbsp;
						<a href="/sort-price/{{ $priceGroup->id }}/{{ $price->id }}/down"><span class="glyphicon glyphicon-arrow-down"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="/admin-price/{{ $price->id }}/edit">{{ $price->name }} - ({{ $price->price }})</a>
					</p>
					
				@endforeach
				
				</div>

				</div><!-- .panel-default -->				

		</div><!-- .col-sm-8 -->

	</div><!-- .row -->
				
@endsection