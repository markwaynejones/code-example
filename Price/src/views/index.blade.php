<?php
use Caramba\Price\Events\GetPriceSidebar;

$priceSidebar = \Event::fire(new GetPriceSidebar());
$priceSidebar = reset($priceSidebar);
?>

@extends('Core::admin-master')

@section('Item::title', 'Laravel 5.1')

@section('content')

    <h2>View All Prices</h2>

@endsection