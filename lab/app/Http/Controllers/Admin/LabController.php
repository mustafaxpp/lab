<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lab\LabRequest;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class LabController extends Controller
{
     /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_contract',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_contract',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_contract',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_contract',   ['only' => ['destroy','bulk_delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.labs.index');
    }

    /**
    * get antibiotics datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=User::where('type' , 'lab')->newQuery();

        return DataTables::eloquent($model)
        ->addColumn('action',function($lab){
            return view('admin.labs._action',compact('lab'));
        })
        ->addColumn('bulk_checkbox',function($item){
            return view('partials._bulk_checkbox',compact('item'));
        })
        ->toJson();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lab = User::findOrFail($id);
        
        $contracts = Contract::all();

        return view('admin.labs.edit',compact('lab' , 'contracts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LabRequest $request, $id)
    {
       $lab=User::findOrFail($id);
       $lab->update([
           'name'=>$request['name'],
           'email'=>$request['email'],
           'lab_id'=>$request['lab_id'],
       ]);

       $lab->roles()->create([
           'role_id' => 5
       ]);

       session()->flash('success',__('Lab updated successfully'));

       return redirect()->route('admin.labs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab = User::findOrFail($id);
        $lab->delete();

        session()->flash('success',__('Lab deleted successfully'));

        return redirect()->route('admin.labs.index');
    }


}
