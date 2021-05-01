<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Category;


class ProductController extends Controller
{
    //

	function GetProducts()
	{
		// $products = Products::all('product_id');

		$products = Products::join('categories', 'products.cat_id', '=', 'categories.id')
				->where('is_deleted', '0')
               ->get(['products.product_id', 'products.product_name', 'products.cat_id', 'products.sku', 'products.unit_price', 'products.description', 'products.image_path', 'categories.cat_name']);

		return $products;
	}

	function GetProductById(Request $req)
	{
		// $products = Products::all('product_id');

		$product = Products::join('categories', 'products.cat_id', '=', 'categories.id')
				->where('products.product_id', $req->productId)
               ->get(['products.product_id', 'products.product_name', 'products.cat_id', 'products.sku', 'products.unit_price', 'products.description', 'products.image_path', 'categories.cat_name']);

		return $product;
	}

    function InsertProduct(Request $req)
	{
		$product = new Products();

		$product->product_name=$req->productName;
		$product->sku=$req->sku;
		$product->cat_id= $req->categoryId;
		$product->unit_price=$req->unitPrice;
		$product->description= $req->description;
		$product->image_path=$req->file('imagePath')->store('products');
		$product->save();

		$savedId=0;
		$savedId = Products::select('product_id')
				->where('sku',$product->sku)
				->first();
		
		return $savedId->product_id;
	}

	function UpdateProduct(Request $req)
	{
		$product = Products::find($req->productId);
		$updatedId=0;

		if($product)
		{
			$product->product_name=$req->productName;
			$product->sku=$req->sku;
			$product->cat_id= $req->categoryId;
			$product->unit_price=$req->unitPrice;
			$product->description= $req->description;
			$product->image_path=$req->imagePath;
			$product->save();

			$updatedId = Products::select('product_id')
			->where('sku',$req->sku)
			->first();

			return $updatedId->product_id;
		}
		
		else
		{
			return $updatedId;
		}
		
	}


}
