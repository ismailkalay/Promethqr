<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items =  Item::all();
        return $items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->desc = $request->desc;
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json(['message'=>'eleman kaydedildi']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return $item;
    }

    public function usercontrol(Request $request)
    {
        //return "deneme";
        
        $username = Item::where('name', $request->name)->first();
        $userpassword = Item::where('desc', $request->desc)->first();
        if($username && $userpassword){
            //return "kullanici ve desc var";
            return response()->json(['message'=>'kullanicivedesc var']);

        }
        else{
            //return "kullanici veya desc yanlis";
            return response()->json(['message'=>'kullaniciveyadesc yanlis']);
        }
    
      
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($request->id);
        $item->name = $request->name;
        $item->desc = $request->desc;
        $item->quantity = $request->quantity;
        $item->save();
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::destroy($id);
        return response()->json(['message'=>'eleman silindi']);
    }
}
