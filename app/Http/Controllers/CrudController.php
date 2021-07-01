<?php

namespace App\Http\Controllers;
use App\Events\VideoViewer;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Mcamara\LaravelLocalization\LaravelLocalization;
//use Mcamara\LaravelLocalization\Facades;
use LaravelLocalization ;
class CrudController extends Controller
{
    use OfferTrait;

    public function getOffers(){
      return Offer::get();
    }
//    public function store(){
//        Offer::create([
//            'name' => 'offer2' ,
//            'price' => '100' ,
//            'details' => 'this is the field of the offer2 details' ,
//             ]);
//    }

    public function create(){
       return view('offers.create');

    }
    /////////////////////////
    public function store(OfferRequest $request){
//        // validate data before insert to database
//        $rules = $this -> getRules();
//        $messages = $this -> getMessages();
//        $validator = Validator::make( $request->all(), $rules, $messages );
//        if ( $validator -> fails() )
//           {
//               return redirect()->back()->withErrors($validator)->withInput($request->all()) ;
//           }

        //save photo in folder
       $file_name = $this -> saveImageInFolder($request -> photo , 'iamges/offers');





        // insert the data to database after validation
        Offer::create([
            'photo' => $file_name,
            'name_en' => $request -> name_en ,
            'name_ar' => $request -> name_ar ,
            'price' => $request -> price ,
            'details_en' => $request -> details_en ,
            'details_ar' => $request -> details_ar ,
             ]);
        return redirect()->back()->with([ 'success' => 'Stored successfully' ]);
    }



//     /////////////////////////////////////
//    protected function getRules(){
//        return [
//                  'name' => 'required|max:100|unique:offers,name' ,
//                  'price' => 'required|numeric' ,
//                  'details' => 'required' ,
//               ];
//    }
//    ///////////////////////////////////////
//    protected function getMessages(){
//         return [
//             // the key messages is refer to lang files "translation between english and arabic"
//                  'name.required' => __('messages.offer name required'),
//                  'name.unique' => __('messages.offer name taken'),
//                  'price.required' => __('messages.offer price required'),
//                  'price.numeric' => __('messages.offer must be a number'),
//                  'details.required' => __('messages.offer details required'),
//
//         ];
//    }


public function getAllOffers()
{
    $offers = Offer::select(
        'id' ,
        'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
        'price' ,
        'details_'.LaravelLocalization::getCurrentLocale().' as details') -> get(); // return collection
    return view('offers.all', compact('offers')) ;
}

public function editOffer($offer_id)
{
//    Offer::findOrFail($offer_id);
//     return $offer_id;
    $offer = Offer::select('id' , 'name_en' , 'name_ar' , 'price' , 'details_en' , 'details_ar') -> findOrFail($offer_id);


    return view('offers.update' , compact('offer'));
}
public function updateOffer(OfferRequest $request , $offer_id)
{
    // validation   OfferRequest

    // check if offer exists
    $offer = Offer::findOrFail($offer_id);

    //update data
    $offer -> update( $request -> all() );
    return redirect()->back()->with([ 'Updated Succssfully' => 'تم التحديث بنجاح']);
}
public function deleteOffer($offer_id){
    // check if offer exists
    $offer = Offer::findOrFail($offer_id);
    //delete data
    $offer -> delete();
    return redirect()->back()->with(['success' => 'Deleted Successfully']);

}

public function getVideo()
{
    $video = Video::first();
    event(new VideoViewer($video));
    return view('video', compact('video'));
}


}
