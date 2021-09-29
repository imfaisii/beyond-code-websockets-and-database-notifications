<?php

namespace App\Http\Controllers;

use App\Http\Requests\IpAddressRequest;
use App\Models\Iprestriction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IprestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.ip.index');
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
    public function store(IpAddressRequest $request)
    {

        try {
            DB::beginTransaction();
            $create = Iprestriction::create([
                'address' => $request->ip,
                'user_id' => Auth::user()->id
            ]);
            if ($create) {
                DB::commit();
                return response()->json(['message' => 'success', 'response' => 'IP successfully added to Database and now can access the system'], 201);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'failed', 'response' => 'IP failed to add to the Database, Please try again !'], 400);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            if (isset($exception->errorInfo[2]))
                $result = $exception->errorInfo[2];
            else
                $result = $exception->getMessage();
            return response()->json(['message' => 'failed', 'response' => $result], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Iprestriction  $iprestriction
     * @return \Illuminate\Http\Response
     */
    public function show(Iprestriction $iprestriction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Iprestriction  $iprestriction
     * @return \Illuminate\Http\Response
     */
    public function edit(Iprestriction $iprestriction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Iprestriction  $iprestriction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Iprestriction $iprestriction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Iprestriction  $iprestriction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            DB::beginTransaction();
            if (Iprestriction::find($id)->delete()) {
                DB::commit();
                return response()->json(['message' => 'success', 'response' => 'IP successfully delete from Database and now can access the system'], 201);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'failed', 'response' => 'IP failed to delete from the Database, Please try again !'], 400);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            if (isset($exception->errorInfo[2]))
                $result = $exception->errorInfo[2];
            else
                $result = $exception->getMessage();
            return response()->json(['message' => 'failed', 'response' => $result], 400);
        }
    }
}
