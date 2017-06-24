<?php

namespace App\Http\Controllers\Bookin;

use App\Stand;
use App\Bookin;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * A bookin transaction
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try
        {
            DB::transaction(function () use ($request) {

                // Creating a new bookin
                $bookin = Bookin::create(["user_id" => $request->user_id,
                    "event_id" => $request->event_id,
                    "stand_id" => $request->stand_id,
                    "price" => $request->price]);


                if(isset($request->doc_file)){
                    // Specify the folder to store the marketing documents
                    $doc_folder = 'events/event_'. $request->event_id . '/stand_' . $request->stand_id;
                    $doc_path = $request->doc_file->store($doc_folder);

                    // Update the Stand 
                    $stand = Stand::find($request->stand_id);
                    $stand->document_url = $doc_path;
                    $stand->status = Stand::UNAVAILABLE_STAND;
                    $stand->save();  
                }

                if(isset($request->logo_file)){
                    // Specify the folder to store the logo of company
                    $logo_folder = 'companies/company_'. $request->company_id;
                    $logo_path = $request->logo_file->store($logo_folder);

                    // Update the logo of the company
                    $company = Company::find($request->company_id);
                    $company->name = $request->company_name;
                    $company->logo_url = $logo_path;
                    $company->save();
                }


            });
        } catch (\Exception $e)
        {
            return response()->json(array("error" => "Impossible to create now"), 422);
        }
        return response()->json($request->all(), 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bookin  $bookin
     * @return \Illuminate\Http\Response
     */
    public function show(Bookin $bookin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bookin  $bookin
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookin $bookin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bookin  $bookin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookin $bookin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bookin  $bookin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookin $bookin)
    {
        //
    }
}
