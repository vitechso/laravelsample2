<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\User\User;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Entities\LogEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use App\Keywords;
use App\Posts;
use App\Pages;
use App\Comments;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->data=[];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counts = [
            'users' => \DB::table('users')->count(),
            'keywords' => \DB::table('keywords_tb')->count(),
            'questions' => \DB::table('posts')->count(),
            'answers' => \DB::table('comment_onpost')->count(),
            'users_unconfirmed' => \DB::table('users')->where('confirmed', false)->count(),
            'users_inactive' => \DB::table('users')->where('active', false)->count(),
            'protected_pages' => 0,
        ];

        foreach (\Route::getRoutes() as $route) {
            foreach ($route->middleware() as $middleware) {
                if (preg_match("/protection/", $middleware, $matches)) $counts['protected_pages']++;
            }
        }

        return view('admin.dashboard', ['counts' => $counts]);
    }


    public function getLogChartData(Request $request)
    {
        \Validator::make($request->all(), [
            'start' => 'required|date|before_or_equal:now',
            'end' => 'required|date|after_or_equal:start',
        ])->validate();

        $start = new Carbon($request->get('start'));
        $end = new Carbon($request->get('end'));

        $dates = collect(\LogViewer::dates())->filter(function ($value, $key) use ($start, $end) {
            $value = new Carbon($value);
            return $value->timestamp >= $start->timestamp && $value->timestamp <= $end->timestamp;
        });


        $levels = \LogViewer::levels();

        $data = [];

        while ($start->diffInDays($end, false) >= 0) {

            foreach ($levels as $level) {
                $data[$level][$start->format('Y-m-d')] = 0;
            }

            if ($dates->contains($start->format('Y-m-d'))) {
                /** @var  $log Log */
                $logs = \LogViewer::get($start->format('Y-m-d'));

                /** @var  $log LogEntry */
                foreach ($logs->entries() as $log) {
                    $data[$log->level][$log->datetime->format($start->format('Y-m-d'))] += 1;
                }
            }

            $start->addDay();
        }

        return response($data);
    }

    public function getRegistrationChartData()
    {

        $data = [
            'registration_form' => User::whereDoesntHave('providers')->count(),
            'google' => User::whereHas('providers', function ($query) {
                $query->where('provider', 'google');
            })->count(),
            'facebook' => User::whereHas('providers', function ($query) {
                $query->where('provider', 'facebook');
            })->count(),
            'twitter' => User::whereHas('providers', function ($query) {
                $query->where('provider', 'twitter');
            })->count(),
        ];

        return response($data);
    }

    public function keywords(Request $request)
    {
        if(!empty($_POST))
        {
            //echo "<pre>";print_r($request->all());die;
             $id=$request->all()['id'];//die;
             $name=$request->all()['name'];
            Keywords::where("id",$id)->update(array("name"=>$name));
            return redirect()->intended(route('admin.keywords'))->withFlashSuccess('Keyword Updated Successfully!');
        }
        $this->data["keywords"]=Keywords::select(["keywords_tb.*","users.name as username"])->join("users","keywords_tb.user_id","=","users.id")->orderBy('keywords_tb.id','desc')->get();
        //echo "<pre>";print_r($keywords->toArray());die;
       return view("admin.keywords",$this->data);
    }

    public function edit_keyword(Request $request,$id)
    {
        //echo $id;die;
        $this->data["keyword_detail"]=Keywords::where("id",$id)->first()->toArray();
        //echo "<pre>";print_r($this->data["keyword_detail"]->toArray());die;
       return view("admin.edit_keyword",$this->data);
    }

    public function delete_keyword($id)
    {
        // echo $id;die;
        // $this->data["keywords"]=Keywords::get();
        Keywords::where("id",$id)->delete();
        //echo "<pre>";print_r($keywords->toArray());die;
        return redirect()->intended(route('admin.keywords'))->withFlashSuccess('Keyword deleted Successfully!');
       //return view("admin.keywords",$this->data);
    }
    public function posts(Request $request)
    {
       //$select="users.name as username,posts.*,keywords_tb.*";
       $select=array("users.name as username","posts.*","keywords_tb.*");
        $this->data["posts"]=Posts::select($select)->join("users","users.id","=","posts.user_id")->join("keywords_tb","keywords_tb.id","=","posts.keyword_id")->orderBy('posts.id','desc')->get();
        //echo "<pre>";print_r($this->data["posts"]->toArray());die;
       return view("admin.posts",$this->data);
    }
    public function comments()
    {
       //$select="users.name as username,posts.*,keywords_tb.*";
       $select=array("comment_onpost.*");
       $where['status']=1;
        $this->data["comments"]=Comments::select($select)->where($where)->orderBy('id','desc')->get();
        //echo "<pre>";print_r($this->data["posts"]->toArray());die;
       return view("admin.comments",$this->data);
    }
    public function commentsdelete($id){
        $where['id']=$id;
        $update['status']=0;
        $data = Comments::where($where)->update($update);
        if ($data) {
            return redirect()->back()->with('success','Comment deleted Successfully');
        }else{
            return redirect()->back()->with('error','Comment Not deleted');
        }
    }

    public function pageslist()
    {
       //$select="users.name as username,posts.*,keywords_tb.*";
       
       
        $this->data["pagelist"]=Pages::select(["title","slug","description","id"])->orderBy('id','desc')->get();
        //echo "<pre>";print_r($this->data["posts"]->toArray());die;
       return view("admin.allpages",$this->data);
    }

    public function page_edit($id)
    {
       if($id!='')
       {
        $this->data["page_detail"]=Pages::select(["title","slug","description","id"])->where(['id'=>$id])->first();
        //echo "<pre>";print_r($this->data["posts"]->toArray());die;
            return view("admin.edit_page",$this->data);
        }else{
            return redirect()->back();
        }
    }

    public function page_update(Request $request)
    {
       
        $page_detail = Pages::find($request->id);
        $page_detail->title = $request->title;
        $page_detail->description = $request->description;
        $page_detail->save();
        return redirect()->back()->with('success','Updated Successfully');
            
    } 
    
}
