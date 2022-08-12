<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminBaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $data;
    public function __construct(Request $request)
    {
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
         $this->data['userdata'] = Auth::user();
            return $next($request);
         });

    }
    public function loadBaseData(){
       $this->option_permissions();
       $this->get_sidemenu();
    }
    public function get_sidemenu(){
      $sidemenu = array();
      $modules = DB::table('modules')->select('id','module_name','redirect_link')->where('modules.active',1)->get();
      foreach($modules as $key => $m){
         $options = DB::table('options')->select('option_name','option_slug','module_id','redirect_link')->where('module_id',$m->id)->get();
         $m->options = array();
         foreach($options as $o){
            if($this->data['bp'][$o->option_slug]->_index == 1){
               $m->options[] = $o;
            }
         }
         $sidemenu[] = $m;
      }
      $this->data['sidemenu'] = $sidemenu;
    }

    function option_permissions(){
      $options = array();
      $chek = DB::table('modules')->join('options','options.module_id','=','modules.id')->where('modules.active',1)->get();
      foreach($chek as $key => $row){
         $op = DB::table('option_permissions')->where('bend_id',$this->data['userdata']->bend_id)->where('option_slug',$row->option_slug)->first();
         $options[$row->option_slug] = $op;
      }
      $this->data['bp'] = $options;
    }

    function check_role(){
         $user_id = Auth::user()->id;  
         $details = User::where('id', $user_id)->first();
         // dd($details->group_id);
         if($details->group_id != 1 || $details->group_id == null){
            return false;
         }else{
            return true;
         }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}
