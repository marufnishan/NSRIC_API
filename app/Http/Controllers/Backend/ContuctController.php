<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contuct;
use Illuminate\Http\Request;

class ContuctController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contucts = Contuct::with('metafild')->latest()->paginate(5);
        return view('admin.contucts.index', compact('contucts'));
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
        //
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
        //
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

    public function pagination(Request $request)
    {
        $contucts = Contuct::latest()->paginate(5);
        return view('admin.contucts.pagination_contucts', compact('contucts'))->render();
    }
    public function searchcontuct(Request $request)
    {
        $contucts = Contuct::where('name', 'like', '%'.$request->search_string.'%')
        ->latest()
        ->paginate(5);
        if($contucts->count() >= 1){
            return view('admin.contucts.pagination_contucts', compact('contucts'))->render();
        }else{
            return response()->json(['status'=>'nothing_found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contuct $contuct)
    {
        //dd($id);
        $contuct->delete();

        return response()->json([
            'status'=>'success',
        ]);
    }
}
