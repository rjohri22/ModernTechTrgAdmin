<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Oppertunities;
use App\Models\Admin\Companies;
use Illuminate\Support\Facades\Auth;

class OppertunitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['oppertunities'] = Oppertunities::get();
        return view('admin/oppertunities/index',$data);
    }

    public function add()
    {
         $data['companies'] = Companies::where('status','1')->get();
        return view('admin/oppertunities/add',$data);
    }

    public function edit($id)
    {
        $data['companies'] = Companies::where('status','1')->get();
        $data['oppertunity'] = Oppertunities::where('id', $id)->first();
        return view('admin/oppertunities/edit',$data);
    }

    public function view($id)
    {
        $data['oppertunity'] = Oppertunities::where('id', $id)->first();
        return view('admin/oppertunities/view',$data);
    }

    public function store_oppertunity(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $update_arr = array(
            'title'         => $request->input('title'),
            'company_id'       => $request->input('company'),
            'min_salary'    => $request->input('min_salary'),
            'max_salary'    => $request->input('max_salary'),
            'salary_type'   => $request->input('salary_type'),
            'job_type'   => $request->input('job_type'),
            'work_type'   => $request->input('work_type'),
            'expires_on'    => $request->input('expires_on'),
            'no_of_positions'    => $request->input('no_of_position'),
            'urgent_hiring'     => $request->input('urgent_hiring'),
            'status'            => $request->input('status'),
            'summery'           => $request->input('summery'),
            'description'       => $request->input('description'),
        );

        $query = Oppertunities::insert($update_arr);
        return redirect()->route('admin.oppertunities')
        ->with('success','oppertunity created successfully.');
    }

    public function update_oppertunity($id, Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $update_arr = array(
            'title'         => $request->input('title'),
            'company_id'       => $request->input('company'),
            'min_salary'    => $request->input('min_salary'),
            'max_salary'    => $request->input('max_salary'),
            'salary_type'   => $request->input('salary_type'),
            'job_type'   => $request->input('job_type'),
            'work_type'   => $request->input('work_type'),
            'expires_on'    => $request->input('expires_on'),
            'no_of_positions'    => $request->input('no_of_position'),
            'urgent_hiring'     => $request->input('urgent_hiring'),
            'status'            => $request->input('status'),
            'summery'           => $request->input('summery'),
            'description'       => $request->input('description'),
        );

        $query  = Oppertunities::where('id', $id)->update($update_arr);
        return redirect()->route('admin.oppertunities')
        ->with('success','oppertunity Updated successfully.');
    }

    public function delete_oppertunity($id){
        Oppertunities::where('id',$id)->delete(); 
        return redirect()->route('admin.oppertunities')
        ->with('success','Oppertunity Deleted successfully.');
    }
}