@extends('layouts.app')

@section('content')
<div class="container content_container">
	<style type="text/css">
		body{
			background-image: url("{{$productdata->media['images'][2]}}");
		}
	</style>
    <div class="row">
    	<div class="col-xs-12">
    		<a href="{{route('product.index')}}">Produkter</a>/<a href="{{ route('product.show', $productdata->id) }}">{{$productdata->slug}}</a>
    	</div>
	    <div class="col-xs-7">
	    	<h2>{{$productdata->title}}</h2>
	    </div>
	    <div class="col-xs-5">
	    	<h2>Fra <span class="price_color">{{$productdata->prices['new']['price_formatted']}}</span></h2>
	    </div>
    </div>
    <div class="row top_pro_row">
    	<div class="col-md-7 col-xs-12">
		    <div id="game_carousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			  	@php
			  	$i = 0;
        		@endphp
			  	@foreach ($productdata->media['images'] as $image)
				  	@if ($loop->first)
				     	<li data-target="#game_carousel" data-slide-to="{{$i}}" class="active"></li>
				     	@php
				     	$i++;
				     	@endphp
			   		@else
				    	<li data-target="#game_carousel" data-slide-to="{{$i}}"></li>
				    	@php
				     	$i++;
				     	@endphp
				    @endif
			    @endforeach
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			  	@foreach ($productdata->media['images'] as $image)
				  	@if ($loop->first)
			        <div class="item active">
				      <img class="pro_Image" src="{{$image}}">
				    </div>
			   		@else
				    <div class="item">
				      <img class="pro_Image" src="{{$image}}">
				    </div>
				    @endif
			    @endforeach
			  </div>

			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#game_carousel" data-slide="prev">
			    <span style="color: black;" class="glyphicon glyphicon-chevron-left"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#game_carousel" data-slide="next">
			    <span style="color: black;" class="glyphicon glyphicon-chevron-right"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
			</div>
			<div class="col-md-5 col-xs-12">
			<p><strong>Platform: </strong>{{$productdata->platform[0]}}</p>

			@php
				$intro = explode("<br>",$productdata->description);
				//dummy data :/
				$likes = 100;
				$dislikes = 5;
				$total= $likes+$dislikes;
			@endphp

			<p><strong>Om produktet:</strong></p>
			<p>{!! $intro[0] !!}<a href="#description"><span class="game_content"> Læs mere</span></p></a><br>
			<div class="game_content">
			<p>
				<strong>
					@if ($productdata->stock['total']['status'] == "På lager")
						<span style="color: green;" class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> {!! $productdata->stock['total']['status'] !!}
					@else
						{!! $productdata->stock['total']['status'] !!}
					@endif
					 - {!! $productdata->stock['total']['delivery'][1] !!}
				</strong>
				<br>
				{!! $productdata->stock['total']['delivery'][0] !!}
			</p>


			<p><strong>Vores brugere mener:</strong> <br>
			<a href="#" data-toggle="tooltip" title="{{floor(($likes/$total)*100)}}% af {{$total}} brugere har synes godt om spillet">  
			@if ($likes/$total >= 0.80)
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
			@elseif ($likes/$total >= 0.60)
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
			@elseif ($likes/$total >= 0.40)
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
			@elseif ($likes/$total >= 0.20)
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
			@else 
				<span style="color: red;" class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
			@endif
			</a>
			</p>
			<p><strong>Udgivelsesdato:</strong> ##. Lorember ####</p>
			<p><strong>Genre:</strong>
			<ul class="list-inline genre_list">
				  <li class="list-inline-item btn">Lorem</li>
				  <li class="list-inline-item btn">Ipsum</li>
				  <li class="list-inline-item btn">Phasellus</li>
				</ul>
			</p>
			</div>
			</div>
		</div>
		<hr>
		<div class="row">
		<div class="col-xs-12">

		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#Ny" aria-controls="Ny" role="tab" data-toggle="tab"><h3>Ny {{ isset($productdata->prices['new']['price']) ? $productdata->prices['new']['price']/100 . " kr." : 'ingen tilgængelige' }}</h3></a></li>
		    <li role="presentation"><a href="#Brugt" aria-controls="Brugt" role="tab" data-toggle="tab"><h3>Brugt {{ isset($productdata->prices['used']['price']) ? $productdata->prices['used']['price']/100 . " kr." : 'ingen tilgængelige' }}</h3></a></li>
		  </ul>


		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="Ny">
			    <div class="col-xs-6">	
			    	<h4>Standard <span class="price_color">{{ isset($productdata->prices['new']['price']) ? $productdata->prices['new']['price']/100 . " kr." : 'ingen tilgængelige' }}</span></h4>    
			    	<button type="button" class="btn btn-primary buy-btn">læg i kurv <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
				</div>
				<div class="col-xs-6">
					<h4>Premium <span class="price_color">{{ isset($productdata->prices['new']['premium_price']) ? $productdata->prices['new']['premium_price']/100 . " kr." : 'ingen tilgængelige' }}</span></h4> 
					<button type="button" class="btn btn-warning buy-btn">læg i kurv <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
					<h5 style="color: red; text-align: center;">Du kan spare {{ isset($productdata->prices['new']['premium_saving']) ? $productdata->prices['new']['premium_saving']/100 . " kr." : 'ingen tilgængelige' }}</h5>	
				</div>
			</div>
		    <div role="tabpanel" class="tab-pane" id="Brugt">
		    	<div class="col-xs-6">	
			    	<h4>Standard <span class="price_color">{{ isset($productdata->prices['used']['price']) ? $productdata->prices['used']['price']/100 . " kr." : 'ingen tilgængelige' }}</span></h4>    
			    	<button type="button" class="btn btn-primary buy-btn">læg i kurv <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
				</div>
				<div class="col-xs-6">
					<h4>Premium <span class="price_color">{{ isset($productdata->prices['used']['premium_price']) ? $productdata->prices['used']['premium_price']/100 . " kr." : 'ingen tilgængelige' }}</span></h4> 
					<button type="button" class="btn btn-warning buy-btn">læg i kurv <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
					<h5 style="color: red; text-align: center;">Du kan spare {{ isset($productdata->prices['used']['premium_saving']) ? $productdata->prices['used']['premium_saving']/100 . " kr." : 'ingen tilgængelige' }}</h5>	
				</div>
		    </div>
		  </div>
		</div>

		<div id="description" class="col-xs-12">
		<hr>
			<h3>Om spillet</h3>
			<p>{!! $productdata->description !!}</p>
		</div>


		<!--Script for tooltips som on hover ved rating-->
		<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
		</script>
		<!--Script for tabs-->
		<script>
		$('#myTabs a').click(function (e) {
		  e.prevent()
		  $(this).tab('show')
		})
		</script>
</div>
@endsection