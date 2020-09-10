<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Posts;
use App\Pages;
use App\Comments;
use App\Keywords;
use App\Uservoting_onpost;
use App\Uservoting_oncomment;
use Session;
use Auth;
class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth', ['except' => ['index']]);
    }

    public function getpage($slug='')
    {	
    	// echo $slug;exit();
    	$pagedata = [];
		$pagedata = Pages::where(['slug'=>$slug])->first();
    	if(empty($pagedata)){
    		return redirect()->to('/');
    	}
    	return view('pages',['page'=>$pagedata]);
    }
}