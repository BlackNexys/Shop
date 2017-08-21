<?php

namespace Fakeshop\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    

    public function index(Request $request)
    {
        $path = storage_path() . "/data/products.json";
        $jsondata = file_get_contents($path);
        $products_data = json_decode($jsondata);
        $products = array();
        //echo $request;
        if (empty($request->get('vplatform')) AND empty($request->get('condition')))
        {
        	foreach ($products_data->products as $prod) {
        		array_push($products, $prod);
        	}
        }
        elseif (!empty($request->get('vplatform')) AND empty($request->get('condition')))
        {
	        foreach ($products_data->products as $prod) {
	        	foreach ($prod->platform as $platform) {
	        		if ($platform == $request->get('vplatform'))
			        {
			        	array_push($products, $prod);
			        }
	        	}
		   	}
	    }
	    elseif (empty($request->get('vplatform')) AND !empty($request->get('condition'))) 
	    {
	    	foreach ($products_data->products as $prod) {
	        	if ($request->get('condition') == 'new') {
	        		if (isset($prod->prices->new->price)){
	        			array_push($products, $prod);
	        		}
	        	}else{
	        		if (isset($prod->prices->used->price)){
	        			array_push($products, $prod);
	        		}
	        	}
		   	}
	    }
	    else
	    {
	    	foreach ($products_data->products as $prod) {
	        	foreach ($prod->platform as $platform) {
	        		if ($platform == $request->get('vplatform'))
			        {
			        	if ($request->get('condition') == 'new') {
			        		if (isset($prod->prices->new->price)){
			        			array_push($products, $prod);
			        		}
			        	}else{
			        		if (isset($prod->prices->used->price)){
			        			array_push($products, $prod);
			        		}
			        	}
			        }
	        	}
		   	}
	    }

        return view('product.index', compact('products'));
    	}

    public function show($id)
    {
    	$path = storage_path() . "/data/products.json";
        $jsondata = file_get_contents($path);
        $products = json_decode($jsondata);
        $url = null;

		foreach($products->products as $item)
		{
		    if($item->id == $id)
		    {
		        $url = $item->url->domain . $item->url->json;
		    }
		}

        $path = $url;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $path);
            $result = curl_exec($ch);
            curl_close($ch);

            $productdata = (object) json_decode($result,true);



    	return view('product.show', compact('productdata'));
    }

    public function search(Request $input)
    {
    	$path = storage_path() . "/data/products.json";
        $jsondata = file_get_contents($path);
        $products = json_decode($jsondata);

        foreach($products->products as $item)
		{
			if($item->id == $input->get('input'))
		    {
		        return $this->show($item->id);
		    }
		    elseif (strtolower($item->title) == strtolower($input->get('input')))
		    {
		        return $this->show($item->id);
		    }elseif ($item === end($products->products))
		    {
		        echo "Intet blev fundet";
		    }
		}
    }
}