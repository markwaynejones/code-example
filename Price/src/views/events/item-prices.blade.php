<!-- Start of displaying associated prices -->

	<h2>Prices</h2>

<div class="panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title">Associated Prices</h3>
	</div>
	
	@if(count($itemPrices))

	<div style="padding:20px;">
		{!! $formHTML !!}
	</div>

	@else

		<p>No prices associated to this item</p>

	@endif	

</div><!-- .panel-default -->

<!-- End of displaying associated prices -->

