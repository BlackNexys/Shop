@extends('layouts.app')

@section('content')
<div class="container content_container">
	<div class="row">
		<div id="filter" class="collapse col-xs-12 page_pjust">
			<div class="page_just">
				{!! Form::open(['route' => 'product.index', 'method' => 'GET', 'role' => 'filter']) !!}
				<div class="form-group">
					<label for="vplatform">Sorter efter platform</label>
                    {!! Form::select('vplatform', array(null => 'Ingen valgte', 'PlayStation 4' => 'PlayStation 4', 'Wii' => 'Wii'), Request::get('vplatform'), ['class' => 'form-control', 'id' => 'vplatform']) !!}
                    <br>
                    <label for="condition">Sorter efter stand</label>
                    {!! Form::select('condition', array('new' => 'Ny', 'used' => 'Brugt'), Request::get('condition'), ['class' => 'form-control', 'id' => 'condition']) !!}
                    <br>
                    <button type="submit" class="btn btn-default">submit</button>
                </div>
                    {!! Form::close() !!}
                    <hr>
			</div>
		</div>
	    <div class="col-xs-6">
	    	<div class="page_just"><a href="{{route('product.index')}}">Produkter</a>/<br></div>
	    </div>
	    <div class="col-xs-6">
	    	<div class="page_just"><button data-toggle="collapse" data-target="#filter" style="float: right;" class="btn btn-default">Filter</button></div>
	    </div>
    </div>
    <div class="row">
        	@foreach ($products as $product)
	        	<a href="{{ route('product.show', $product->id) }}">
		        	<div class="col-md-3 col-xs-12 product-outer">
			        	<div class="product-inner">
					        	<div class="col-xs-12 product-inner-left">
					        	@php
					        	$path = $product->url->domain.$product->url->json;
					            $ch = curl_init();
					            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					            curl_setopt($ch, CURLOPT_URL, $path);
					            $result = curl_exec($ch);
					            curl_close($ch);
					            $product_json = json_decode($result,true);
					        	@endphp
					        	<img class="product_img" src="{{$product_json['media']['primary']}}">
				        	</div>
				        	<div class="col-xs-12 product-inner-right">
					        	<p class="pro_text">
					        	Ny: <span class="price_color">{{ isset($product->prices->new->price) ? $product->prices->new->price/100 . " kr." : 'ingen tilgængelige' }}</span>
					        	<br>
					        	Brugt: <span class="price_color">{{ isset($product->prices->used->price) ? $product->prices->used->price/100 . " kr." : 'ingen tilgængelige' }}</span>
					        	<br>
					        	@if ($product->stock->total->status == "På lager")
									<span style="color: green;" class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> {!! $product->stock->total->status !!}
								@else
									{!! $product->stock->total->status !!}
								@endif
					        	<br>
					        	<span class="pro_small_txt">
					        	{{$product->title}}
					        	<br>
					        	@foreach ($product->platform as $platform)
					        	{{$platform}}</span>
					        	@endforeach

					        	</p>
				        	</div>
			        	</div>
		        	</div>
	        	</a>
        	@endforeach
        	@if ($products == null)
        		<div class="page_just"><p>Der kunne ikke findes noget med disse søge kriterier</p></div>
        	@endif
    </div>
</div>
@endsection