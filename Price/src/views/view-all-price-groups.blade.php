@extends('Core::admin-master')

@section('Item::title', 'Laravel 5.1')

@section('content')
			<h2>Price Groups</h2><br />	
	

<div class="row">



		<div class="col-sm-4">

			<div class="panel panel-default">

						<div class="panel-heading">
		<h3 class="panel-title">Create Price Group</h3>
	</div>

				<div style="padding:20px;">

					{!! Form::open(['method' => 'POST', 'route' => ['admin-price-group.store']]) !!}

						<input type="text" name="name" style="width:100%;" value="" /><br /><br />
					
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
		<h3 class="panel-title">Existing Price Groups</h3>
	</div>

				<div style="padding:20px;">

				@foreach($priceGroups as $priceGroup)

					<p><a href="/admin-price-group/{{ $priceGroup->id }}/edit">{{ $priceGroup->name }}</a></p>
					
				@endforeach
				
				</div>

				</div><!-- .panel-default -->

		</div><!-- .col-sm-8 -->

	</div><!-- .row -->
				
@endsection