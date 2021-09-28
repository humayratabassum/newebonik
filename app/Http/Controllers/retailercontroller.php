<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\retailer;
use DataTables;

class retailercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $retailers =retailer::get();
        if($request->ajax()){
            $allData =DataTables::of($retailers)
            ->addIndexColumn()
             ->addColumn('action',function($row){
                $btn='<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.
                $row->id.'" data-original-title="edit" class="edit btn btn-primary btn-sm editretailer">edit</a>';
                $btn.='<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.
                $row->id.'" data-original-title="delete" class="delete btn btn-danger btn-sm deleteretailer">detete</a>';
                return $btn;
             })
             ->rawColumns(['action'])
             ->make(true);
             return $allData;
        }
        return view('retailers',compact('retailers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        retailer::updateOrCreate(
            ['id'=>$request->retailer_id],
           [
            'shop_name'=>$request->retailer_id,
            'proprietor_name'=>$request->retailer_id,
            'shop_area'=>$request->retailer_id,
            'shop_type'=>$request->retailer_id,
            'contact_no'=>$request->retailer_id,
            'shop_no'=>$request->retailer_id
        ]
    );
        return response()->json(['success'=>'retailer add successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retailers = retailer::find($id);
        return response()->json($retailers);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        retailer::find($id)->delete();
         return response()->json(['success'=>'retailer delete successfully']);
    }
}
