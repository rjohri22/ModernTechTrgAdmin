<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Job_applications;
use App\Models\Admin\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Rounds;

class RoundsController extends AdminBaseController
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
	public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['rounds'] = Rounds::get();
        return view('admin/rounds/index',$this->data);
    }
    public function delete($id){
        return redirect()->route('admin.rounds');
    }
    public function add(){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        return view('admin/rounds/add',$this->data);
    }
    public function edit(Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['round'] = Rounds::find($request->id);
        return view('admin/rounds/edit',$this->data);
    }
    public function store(Request $request){
        $round = new Rounds;
        $round->name = $request->name;
        $round->save();
        return redirect()->route('admin.rounds');
    }
    public function update(Request $request){
        $round = Rounds::find($request->id);
        $round->name = $request->name;
        $round->save();
        return redirect()->route('admin.rounds');
    }
}
