<?php

namespace App\Http\Controllers\Admin;

use App\Models\Govrenment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
class GovernmentController extends Controller
{
    
    public function index()
    {
        $governments = Govrenment::all();
        return view('admin.governments.index', compact('governments'));
    }

    public function ajax(Request $request)
    {
        $model = Govrenment::query();

        return DataTables::eloquent($model)
            ->addColumn('action', function ($government) {
                return view('admin.governments._action', compact('government'));
            })
            ->addColumn('bulk_checkbox', function ($item) {
                return view('partials._bulk_checkbox', compact('item'));
            })
            ->toJson();
    }

    // create
    public function create()
    {
        return view('admin.governments.create');
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $governments = Govrenment::create([
            'name' => $request->name,
        ]);

        session()->flash('success', 'created successfully');

        return redirect()->route('admin.governments.index');
    }

    // edit 
    public function edit(Govrenment $government)
    {
        return view('admin.governments.edit', compact('government'));
    }

    // update
    public function update(Request $request, Govrenment $government)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $government->update([
            'name' => $request->name,
        ]);


        session()->flash('success', 'updated successfully');

        return redirect()->route('admin.governments.index');
    }

    // destroy
    public function destroy(Govrenment $government)
    {
        $government->delete();
        session()->flash('success', 'deleted successfully');
        return redirect()->route('admin.governments.index');
    }

    // bulk_delete
    public function bulk_delete(Request $request)
    {
        $request->validate([
            'ids' => 'required',
        ]);
        $ids = $request->ids;
        foreach ($ids as $id) {
            $government = Govrenment::find($id);
            $government->delete();
        }
        session()->flash('success', 'deleted successfully');
        return redirect()->route('admin.governments.index');
    }

}
