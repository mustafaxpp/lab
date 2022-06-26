<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Govrenment;
use App\Models\Region;
use Illuminate\Http\Request;
use DataTables;
class RegionController extends Controller
{
    
    public function index()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }

    public function ajax(Request $request)
    {
        $model = Region::query();

        return DataTables::eloquent($model)
            ->addColumn('action', function ($region) {
                return view('admin.regions._action', compact('region'));
            })
            ->addColumn('bulk_checkbox', function ($item) {
                return view('partials._bulk_checkbox', compact('item'));
            })
            ->toJson();
    }

    // create
    public function create()
    {

        $governments = Govrenment::all();
        return view('admin.regions.create' , compact('governments'));
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'government_id' => 'required',
        ]);

        $regions = Region::create([
            'name' => $request->name,
            'government_id' => $request->government_id,
        ]);

        session()->flash('success', 'created successfully');

        return redirect()->route('admin.regions.index');
    }

    // edit 
    public function edit(Region $region)
    {

        $governments = Govrenment::all();

        return view('admin.regions.edit', compact('region' , 'governments'));
    }

    // update
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required',
            'government_id' => 'required',
        ]);

        $region->update([
            'name' => $request->name,
            'government_id' => $request->government_id,
        ]);


        session()->flash('success', 'updated successfully');

        return redirect()->route('admin.regions.index');
    }

    // destroy
    public function destroy(Region $region)
    {
        $region->delete();
        session()->flash('success', 'deleted successfully');
        return redirect()->route('admin.regions.index');
    }

    // bulk_delete
    public function bulk_delete(Request $request)
    {
        $request->validate([
            'ids' => 'required',
        ]);
        $ids = $request->ids;
        foreach ($ids as $id) {
            $region = Region::find($id);
            $region->delete();
        }
        session()->flash('success', 'deleted successfully');
        return redirect()->route('admin.regions.index');
    }

    // get region by government
    public function get_region_by_government(Request $request)
    {
        $government_id = $request->government_id;
        $regions = Region::where('government_id', $government_id)->get();
        return response()->json($regions);
    }
}
