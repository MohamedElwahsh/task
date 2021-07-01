<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;
use LaravelLocalization ;


class OfferController extends Controller
{
    use OfferTrait;

    public function create()
    {
        //view form to add offer
        return view('ajaxoffers.create');

    }
    public function store(OfferRequest  $request)
    {
        //save offer into DB using AJAX
        $file_name = $this -> saveImageInFolder($request -> photo , 'iamges/offers');

        // insert the data to database after validation
       $offer =  Offer::create([
            'photo'      => $file_name,
            'name_en'    => $request -> name_en ,
            'name_ar'    => $request -> name_ar ,
            'price'      => $request -> price ,
            'details_en' => $request -> details_en ,
            'details_ar' => $request -> details_ar ,
        ]);
       if($offer) {
           return response()->json([
               'status' => true,
               'msg' => 'Stored successfully',
           ]);
       }
       else{
           return response()->json([
               'status' => false,
               'msg' => 'Failed To Store The Offer',
           ]);
       };
//       return redirect('ajaxoffers.create');
    }
    public function all()
    {
         $offers = Offer::select(
            'id' ,
            'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
            'price' ,
            'details_'.LaravelLocalization::getCurrentLocale().' as details') -> get(); // return collection
        return view('ajaxoffers.all', compact('offers')) ;
    }
    public function delete(OfferRequest $request){
        // check if offer exists
        $offer = Offer::findOrFail($request -> id);
        //delete data
        $offer -> delete();
        if(!$offer) {
            return response()->json([
                'status' => true,
                'msg' => 'deleted successfully',

            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'msg' => 'Failed To delete The Offer',
                'id' => $request -> id,
            ]);
        }
    }
    public function edit(OfferRequest $request)
    {
        $offer = Offer::find($request->offer_id);
        if (!$offer)
        {
            return response()->json([
                'status' => false,
                'msg' => 'This Offer Is Not Found',

            ]);
        }

        $offer = Offer::select(
            'id' ,
            'name_en' ,
            'name_ar' ,
            'price' ,
            'details_en'
            , 'details_ar') -> find($request -> offer_id);

        return view('ajaxoffers.update' , compact('offer'));
    }
    public function update(OfferRequest $request)
    {
        // validation

        // check if offer exists
        $offer = Offer::find($request->offer_id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'Offer Not Found',
            ]);
        }
        //update data
        $offer -> update( $request -> all() );
            return response()->json([
                'status' => true,
                'msg' => 'Updated Succssfully',
            ]);

    }

}
