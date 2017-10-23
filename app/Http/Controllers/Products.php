<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products as ProductModel;
use DB;
use Input;
use Excel;

class Products extends Controller
{
    //serve the import view
    public function import()
	{
		return view('import');
	}
    //on post, process csv with Excel load from Maatwebsite dependency and
    //dump into products table
    public function importCSV()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){

                //loop through csv and assign table columns to db columns
				foreach ($data as $key => $value) {

                    //only make availability true if it says true.
                    //if false or empty, make false
                    if(strpos($value->availability, 'true') !== false){
                        $value->availability = 1;
                    } else {
                        $value->availability = 0;
                    }

                    //return empty strings for dimensions, description,
                    //and color if null - if title/sku are null we should fail
                    //the upload, because they are critical 
                    if($value->dimensions === null){
                        $value->dimensions = '';
                    }
                    if($value->color === null){
                        $value->color = '';
                    }
                    if($value->description === null){
                        $value->description = '';
                    }

                    //set the price super high, because we don't want the price
                    //to be 0 in case it accidentally gets activated
                    if($value->price === null){
                        $value->price = 999999;
                    }

                    //make sure we don't accidentally pass in the headers
                    //if($value->sku == 'sku'){
                        $products = ProductModel::updateOrCreate(
                            ['sku' => $value->sku],
                            [
                                'title' => $value->title,
                                'description' => $value->description,
                                'price' => $value->price,
                                'availability' => $value->availability,
                                'color' => $value->color,
                                'dimensions' => $value->dimensions
                            ]
                        );
                    //}

				}

                //insert the collected data
				if(!empty($insert)){

                    //make sure we don't accidentally pass in the headers
                    if($insert[0]['sku'] == 'sku'){
                        array_shift($insert);
                    }

					//DB::table('products')->insert($insert);
					//dd('Insert Record successfully.');
				}

			}
		}
		return back();
	}

    //dump a json string of the products table
    public function dumpProducts()
	{
        $productsModel = new ProductModel();
        $products = $productsModel->all();
        $products = json_encode($products);
		return view('products', ['products' => $products]);
	}
}
