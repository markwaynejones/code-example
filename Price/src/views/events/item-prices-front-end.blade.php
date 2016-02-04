<!-- Start of displaying associated prices -->

	<h4>Prices</h4>

<div class="panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title">Associated Prices</h3>
	</div>
	
	@if(count($itemPrices))

	<div style="padding:20px;">
		
		@foreach($itemPrices as $price)
			
			{{ $price->name }}<br />

		@endforeach;

	</div>

	@else

		<p>No prices associated to this item</p>

	@endif	

</div><!-- .panel-default -->

<!-- End of displaying associated prices -->

