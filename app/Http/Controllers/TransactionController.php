<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::orderBy('date', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor' => 'required',
            'price' => 'required',
            'description' => 'required',

        ]);
        return Transaction::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Transaction::find($id);
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
        $transaction = Transaction::find($id);
        $transaction->update($request->all());
        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Transaction::destroy($id);
    }


    /**
     * Get All transactions for an owner
     *
     * @param  str  $owner
     * @return \Illuminate\Http\Response
     */
    public function owner($owner)
    {
        return Transaction::where('owner',  $owner)->orderBy('date', 'DESC')->get();
    }

    /**
     * Get all uniqure categories for a user
     *
     * @param  str  $owner
     * @return \Illuminate\Http\Response
     */
    public function categories($owner)
    {
        return Transaction::where('owner',  $owner)->distinct('category')->get('category');
    }


    /**
     * Get all uniqure categories for a user as well as the sum of those transactions
     *
     * @param  str  $owner
     * @return \Illuminate\Http\Response
     */
    public function sum($owner)
    {
        return Transaction::where('owner',  $owner)->select([Transaction::raw("SUM(price) as value"), Transaction::raw("category as name"), Transaction::raw("COUNT(price) as count")])->groupBy('category')->get();
    }
}
