<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Culture;
use App\Models\Patient;
use App\Models\Antibiotic;
use App\Models\Group;
use App\Models\GroupTest;
use App\Models\GroupCulture;
use App\Models\Visit;
use App\Models\Expense;
use App\Models\Contract;
use App\Models\UserBranch;
use App\Models\Branch;
use Spatie\Activitylog\Models\Activity;

class IndexController extends Controller
{
    /**
     * admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todays visits
        $today_visits=Visit::with('patient')
                            ->where('branch_id',session('branch_id'))
                            ->whereDate('visit_date',now())
                            ->get();

        //all branches
        $all_branches=Branch::all();

        $patient = Patient::with('contract')->whereHas('contract' , function($q){
            $q->where('id' , auth()->guard('admin')->user()->lab_id);
        });

        $group = Group::with('patient','contract','branch','created_by_user')
        ->where('branch_id',session('branch_id'))->whereHas('contract' , function($q){
            $q->where('id' , auth()->guard('admin')->user()->lab_id);
        });
       
        return view('admin.index',compact(
            'patient',
            'group',
            'today_visits',
            'all_branches'
        ));
    }

    public function change_branch(Request $request,$id)
    {
        $branch=UserBranch::where([
            ['branch_id',$id],
            ['user_id',auth()->guard('admin')->user()->id]
        ])->first();

        if($branch)
        {
            session()->put('branch_id',$branch['branch_id']);
            session()->put('branch_name',$branch['branch']['name']);

            session()->flash('success',__('Branch changed successfully'));
            
            return redirect()->route('admin.index');
        }
        else{
            session()->flash('failed',__('You aren\'t authorized to browse this branch'));
            
            return redirect()->back('admin.index');
        }
    }
}
