<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Posts;
use App\Comments;
use App\Keywords;
use App\Forums;
use App\Uservoting_onpost;
use App\Uservoting_oncomment;
use App\Uservoting_forum;
use App\Models\Auth\User\User; 
use Session;
use Mail;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth', ['except' => ['index']]);
      // echo Auth::user()->role;
    	$this->data=array();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(Auth::user()!=null)
      {
        $user_id=Auth::user()->id;
        if($user_id==50)
        {
           return redirect('/admin');
        }
      }
        return view('welcome');
    }

    public function searchautocomplete(Request $request){
        $search = $request->search;

        if($search == ''){
         $employees = Keywords::orderby('id','asc')->select('id','name')->limit(5)->get();
        }else{
         $employees = Keywords::orderby('id','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($employees as $employee){
         $response[] = array("value"=>$employee->id,"label"=>$employee->name);
        }

        return response()->json($response);
        // if(isset($request) && $request->searchkeyword!=''){
        //     echo $request->searchkeyword;
        //     return response()->json($response);
        // }else{
        //     echo false;
        // }
    }

    public function new_to_crypto(Request $request,$keyword='')
    {
        if(!empty($_POST))
        {
          // print_r($request->all()); exit();
            // echo "<pre>";print_r($_FILES);die;
            $insert_data=$request->all();
            $insert_data["user_id"]=Auth::user()->id;
            unset($insert_data["returnurl"]);
            // $insert_data["keyword_id"]=(isset(var));
            // $file = $request->file('media_file');  
            // $destinationPath = 'assets/posts';
          // if(isset($file) && $file->move($destinationPath,time().'.'.$file->getClientOriginalExtension()))
          // {
          // $insert_data["media_file"] = time().'.'.$file->getClientOriginalExtension();
          // }
           Posts::create($insert_data);
           return redirect($request->returnurl)->with('success', 'Question Add Successfully');
           // Session::flash('flash_message','<p class="alert alert-success">Post submitted Successfully</p>');
        }
        $keywords_id = 0;
        if($keyword!=''){
          $keywords_id = Keywords::select('id','name')->where('name', 'like', $keyword)->first();
        }
        // print_r($keywords_id); exit();
        //echo Auth::user()->id;
        //Session::flash("msg","<p class='alert alert-success'>Post send successfully</p>");
        if(!isset(Auth::user()->id))
        {
            return redirect('/login');
        }
        
        return view('new_to_crypto',['keywords_id'=>$keywords_id]);
    }

    public function comment_onpost(Request $request)
    {
        if(!empty($_POST))
        {
            //echo "<pre>";print_r($_FILES);die;
            $insert_data=$request->all();
            $insert_data["user_id"]=Auth::user()->id;
            
            unset($insert_data['submit']);
            unset($insert_data['searchkeyword']);
            Comments::create($insert_data);

            $postdata = Posts::select(["id","title","description","media_file","tags","vote","user_id"])->orderby('vote','desc')->where('title', 'like', '%' .$request->searchkeyword . '%');
            $postarr = [];
            if($postdata->count()>0){
              foreach($postdata->get() as $ck => $cvalue){
                $postarr[$ck] = $cvalue;
                $comment_resp = Comments::select(["comment_onpost.id as comment_id","comment_onpost.comment","comment_onpost.vote","comment_onpost.created_at","comment_onpost.user_id","users.name"])->join("users","comment_onpost.user_id","=","users.id")->where(["status"=>1,'post_id'=>$cvalue->id]);
                if($comment_resp->count() >0){
                  $postarr[$ck]['comment_data'] = $comment_resp->get();
                }
              }
            }
            // echo '<pre>';print_r($postarr);exit();
            return redirect()->back()->with('success', 'add comment on post');
            // return view('beginner',['postdata_result'=>$postarr,'totalrecord'=>$postdata->count(),'searchkeyword'=>$request->searchword])->with('success', 'add comment on post');
            // Session::flash('flash_message','<p class="alert alert-success">Post submitted Successfully</p>');
           // return 
        }
        
        // //echo Auth::user()->id;
        // //Session::flash("msg","<p class='alert alert-success'>Post send successfully</p>");
        // if(!isset(Auth::user()->id))
        // {
        //     return redirect('/login');
        // }
        
        // return view('new_to_crypto');
    }

    function searchkeyword(Request $request){
      // print_r($request->all()); 

      if(isset($request->selected_result_id) && $request->selected_result_id!=''){
        return redirect()->to('glossary/'.$request->searchword);
      }else{
        return redirect()->to('glossary-search/'.$request->searchword);
      }
      // exit();
    }
    
    public function beginner(Request $request,$searchkey='')
    { 
        // echo $searchkey;exit();
        if(isset($_POST) && !empty($_POST))
        {
            // print_r($request->all());exit();
            $postdata = Posts::select(["id","title","description","media_file","tags","vote","user_id"])->orderby('vote','desc')->where('title', 'like', '%' .$request->searchword . '%');
            $postarr = [];
            if($postdata->count()>0){
              foreach($postdata->get() as $ck => $cvalue){
                $postarr[$ck] = $cvalue;
                $comment_resp = Comments::select(["comment_onpost.id as comment_id","comment_onpost.comment","comment_onpost.vote","comment_onpost.created_at","comment_onpost.user_id","users.name"])->join("users","comment_onpost.user_id","=","users.id")->where(["status"=>1,'post_id'=>$cvalue->id])->orderBy('comment_onpost.vote','DESC');
                if($comment_resp->count() >0){
                  $postarr[$ck]['comment_data'] = $comment_resp->get();
                }
              }
            }
            // echo '<pre>';print_r($postarr);exit();
           return view('allpostlist',['postdata_result'=>$postarr,'totalrecord'=>$postdata->count(),'searchkeyword'=>$request->searchword]);
        }elseif($searchkey!=''){
          $searchkey = str_replace('_',' ',$searchkey);
          $postdata = Posts::select(["id","title","description","media_file","tags","vote","user_id"])->orderby('vote','desc')->where('title', 'like', '%' .$searchkey . '%');
            $postarr = [];
            if($postdata->count()>0){
              foreach($postdata->get() as $ck => $cvalue){
                $postarr[$ck] = $cvalue;
                $comment_resp = Comments::select(["comment_onpost.id as comment_id","comment_onpost.comment","comment_onpost.vote","comment_onpost.created_at","comment_onpost.user_id","users.name"])->join("users","comment_onpost.user_id","=","users.id")->where(["status"=>1,'post_id'=>$cvalue->id])->orderBy('comment_onpost.vote','DESC');
                if($comment_resp->count() >0){
                  $postarr[$ck]['comment_data'] = $comment_resp->get();
                }
              }
            }
            // echo '<pre>';print_r($postarr);exit();
           return view('allpostlist',['postdata_result'=>$postarr,'totalrecord'=>$postdata->count(),'searchkeyword'=>$searchkey]);
        }else{
            $searchkey = str_replace('_',' ',$searchkey);
            return view('allpostlist',['searchkeyword'=>$searchkey]);
        }
    }


    public function alpha()
    {
        $postdata = Posts::orderby('vote','desc')->where('title','!=','')->limit(20);
        
        return view('alpha',['postdata_result'=>$postdata->get(),'totalrecord'=>$postdata->count()]);
    }


    public function glossary($keywords='')
    {
        $keyword_data = Keywords::orderby('name','asc');
        if($keywords!=''){
          if(strlen($keywords) == 1){
            $keyword_data->where('name','like',$keywords.'%');
          }else{
            $keyword_data->where('name','like','%'.$keywords.'%');
          }
        }
        return view('glossary',['keyworddata_result'=>$keyword_data->get(),'totalrecord'=>$keyword_data->count()]);
    }

    public function add_keywords(Request $request)
    { 
      // print_r($request->all()); exit();
        if(isset($request->keywords) && $request->keywords!=''){
          
          $insert_data['is_crypto'] = (isset($request->is_crypto) ? $request->is_crypto : 0);
          $insert_data['name'] = ($insert_data['is_crypto']==1) ? $request->keywords.' - '.strtoupper($request->ticker) : $request->keywords;
          $resp = Keywords::where("name","like","%".$request->keywords."%")->count();
          if($resp == 0){
            $this->basic_email($insert_data['name']);
            Keywords::create($insert_data);

            return redirect()->back()->with('success', 'Keyword Added Successfully');
          }else{
            return redirect()->back()->withInput()->with('error', 'This keyword '.$request->keywords.' already added');
          }
        }
        return redirect()->back()->withInput()->with('error', 'Something went Wrong');
    }

    public function glossary_keywords($slug='')
    {
        if(isset($slug) && $slug!=''){
          $slug = str_replace('_',' ',$slug);
          // echo $slug; exit();
          // $insert_data['name'] = $slug;
          $postdata = Posts::select(["posts.id","posts.keyword_id","posts.title","posts.description","posts.media_file","posts.tags","posts.vote","posts.user_id","keywords_tb.name"])->join("keywords_tb","posts.keyword_id","=","keywords_tb.id")->where("keywords_tb.name","like","%".$slug."%");
          // $postdata = Posts::select(["id","title","description","media_file","tags","vote","user_id"])->orderby('vote','desc')->where('title', 'like', '%' .$searchkey . '%');
            $postarr = [];
            if($postdata->count()>0){
              foreach($postdata->get() as $ck => $cvalue){
                $postarr[$ck] = $cvalue;
                $comment_resp = Comments::select(["comment_onpost.id as comment_id","comment_onpost.comment","comment_onpost.vote","comment_onpost.created_at","comment_onpost.user_id","users.name"])->join("users","comment_onpost.user_id","=","users.id")->where(["status"=>1,'post_id'=>$cvalue->id])->orderBy('comment_onpost.id','DESC');
                if($comment_resp->count() >0){
                  $postarr[$ck]['comment_data'] = $comment_resp->get();
                }
              }
            }
          // print_r($postdata->count());exit();
          return view('allpostlist',['postdata_result'=>$postarr,'totalrecord'=>$postdata->count(),'searchkeyword'=>$slug]);
        }else{
          return redirect()->to('glossary')->with('error', 'Something went Wrong');
        }
    }

    public function uservoting_onpost(Request $request)
    {
        $addvoting_arr['voting_type'] = $request->votingtype;
        $addvoting_arr['post_id'] = $request->postid;
        $addvoting_arr['user_id'] = Auth::user()->id;
        // print_r($request->all());exit();
        $uservote = Uservoting_onpost::where(['post_id' => $addvoting_arr['post_id'],'user_id' => Auth::user()->id]);
        $vote_count = 0;
        if($uservote->count()>0){
          $post_result = Posts::find($addvoting_arr['post_id'] );
          if($uservote->first()->voting_type!=$addvoting_arr['voting_type']){
            $postdata = Uservoting_onpost::updateOrCreate(['post_id' => $addvoting_arr['post_id'] ,'user_id' => Auth::user()->id],$addvoting_arr);
            if($addvoting_arr['voting_type']==1){
              $post_result->vote = ($post_result->vote+1);
              $vote_count = $post_result->vote;
            }else{
              $post_result->vote = ($post_result->vote-1);
              $vote_count = $post_result->vote;
            }
            $post_result->save();

          }
          $vote_count = $post_result->vote;
        }else{
            $post_result = Posts::find($addvoting_arr['post_id'] );
            $postdata = Uservoting_onpost::updateOrCreate(['post_id' => $addvoting_arr['post_id'] ,'user_id' => Auth::user()->id],$addvoting_arr);
            if($addvoting_arr['voting_type']==1){
              $post_result->vote = ($post_result->vote+1);
              $vote_count = $post_result->vote;
            }else{
              $post_result->vote = ($post_result->vote-1);
              $vote_count = $post_result->vote;
            }
            $post_result->save();
        }
        return response()->json([

            'resp' => $vote_count
        ]);
        
    }


    public function uservoting_oncomment(Request $request)
    {
        $addvoting_arr['voting_type'] = $request->votingtype;
        $addvoting_arr['post_id'] = $request->postid;
        $addvoting_arr['comment_id'] = $request->commentid;
        $addvoting_arr['user_id'] = Auth::user()->id;
        // print_r($request->all());exit();
        $uservote = Uservoting_oncomment::where(['post_id' => $addvoting_arr['post_id'],'user_id' => Auth::user()->id]);
        $vote_count = 0;
        if($uservote->count()>0){
          $comment_result = Comments::find($addvoting_arr['comment_id']);
          if($uservote->first()->voting_type!=$addvoting_arr['voting_type'] && $uservote->first()->comment_id == $request->commentid){
            $postdata = Uservoting_oncomment::updateOrCreate(['comment_id'=>$addvoting_arr['comment_id'],'post_id' => $addvoting_arr['post_id'] ,'user_id' => Auth::user()->id],$addvoting_arr);
            if($addvoting_arr['voting_type']==1){
              $comment_result->vote = ($comment_result->vote+1);
              $vote_count = $comment_result->vote;
            }else{
              $comment_result->vote = ($comment_result->vote-1);
              $vote_count = $comment_result->vote;
            }
            $comment_result->save();
          }
          $vote_count = $comment_result->vote;
        }else{
          $post_result = Comments::find($addvoting_arr['comment_id']);
          $postdata = Uservoting_oncomment::updateOrCreate(['post_id' => $addvoting_arr['post_id'] ,'user_id' => Auth::user()->id],$addvoting_arr);
          if($addvoting_arr['voting_type']==1){
            $post_result->vote = ($post_result->vote+1);
            $vote_count = $post_result->vote;
          }else{
            $post_result->vote = ($post_result->vote-1);
            $vote_count = $post_result->vote;
          }
          $post_result->save();
        }
        return response()->json([

            'resp' => $vote_count,
            'data'=>$uservote->first()
        ]);
        
    }
    public function myprofile(Request $request)
    {
    	$select=array("keywords_tb.*");
    	$user_id=Auth::user()->id;
       $keywords=Keywords::select($select)->join("posts","posts.keyword_id","=","keywords_tb.id")->where("posts.user_id",$user_id)->groupBy('posts.keyword_id')->get();
       $posts=Posts::join("keywords_tb","posts.keyword_id","=","keywords_tb.id")->where("posts.user_id",$user_id)->get();
       $select_comment=array("posts.title as post_title","comment_onpost.*");
       $comments=Comments::select($select_comment)->join("posts","posts.id","=","comment_onpost.post_id")->where("comment_onpost.user_id",$user_id)->get();
       //echo "<pre>";print_r($keywords);die;
       $this->data["keywords"]=$keywords;
       $this->data["posts"]=$posts;
       $this->data["comments"]=$comments;
       return view("myprofile",$this->data);
    }


    public function forumspost(Request $request)
    {
        if(!empty($_POST))
        {
          
            $insert_data=$request->all();
            $insert_data["user_id"]=Auth::user()->id;
            unset($insert_data["returnurl"]);
            
           Forums::create($insert_data);
           return redirect()->back()->with('success', 'Question Add Successfully');
           
        }
        
        $forumsdata = Forums::select(["id","user_id","question","answer","vote"])->orderBy('id','desc')->get();
        if(!isset(Auth::user()->id))
        {
            return redirect('/login');
        }
        // print_r($forumsdata); exit();
        return view('forum',['forumsdata'=>$forumsdata]);
    }

    public function forumsvoting(Request $request)
    {
        if(!empty($_POST))
        {
          $addvoting_arr['voting_type'] = $request->votingtype;
          $addvoting_arr['forum_id'] = $request->forum_id;
          $addvoting_arr['user_id'] = Auth::user()->id;
          // print_r($request->all());exit();
          $uservote = Uservoting_forum::where(['forum_id' => $addvoting_arr['forum_id'],'user_id' => Auth::user()->id]);
          $vote_count = 0;
          if($uservote->count()>0){
            $forum_result = Forums::find($addvoting_arr['forum_id']);
            if($uservote->first()->voting_type!=$addvoting_arr['voting_type']){
              $postdata = Uservoting_forum::updateOrCreate(['forum_id'=>$addvoting_arr['forum_id'],'user_id' => Auth::user()->id],$addvoting_arr);
              if($addvoting_arr['voting_type']==1){
                $forum_result->vote = ($forum_result->vote+1);
                $vote_count = $forum_result->vote;
              }else{
                $forum_result->vote = ($forum_result->vote-1);
                $vote_count = $forum_result->vote;
              }
              $forum_result->save();
            }
            $vote_count = $forum_result->vote;
          }else{
            $post_result = Forums::find($addvoting_arr['forum_id']);
            $postdata = Uservoting_forum::updateOrCreate(['forum_id' => $addvoting_arr['forum_id'] ,'user_id' => Auth::user()->id],$addvoting_arr);
            if($addvoting_arr['voting_type']==1){
              $post_result->vote = ($post_result->vote+1);
              $vote_count = $post_result->vote;
            }else{
              $post_result->vote = ($post_result->vote-1);
              $vote_count = $post_result->vote;
            }
            $post_result->save();
          }
          return response()->json([

              'resp' => $vote_count,
              'data'=>$uservote->first()
          ]);

           //  $insert_data=$request->all();
           //  $insert_data["user_id"]=Auth::user()->id;
           //  // unset($insert_data["returnurl"]);
            
           // Forums::create($insert_data);
           // return redirect()->back()->with('success', 'Question Add Successfully');
           
        }
    }

    public function basic_email($keywords='') {
      $user_id = Auth::user()->id;
      $userdetail = User::select(["id","name","email"])->where(['id'=>$user_id])->first();
      $data = array('name'=>$userdetail->name,'keywords'=>$keywords,'email'=>$userdetail->email);
      // $username = $userdetail->name;
      // print_r($userdetail); exit(); $data['email']
      Mail::send('mail', $data, function($message) {
         $message->to('editcryptotest@gmail.com','Edit Crypto')->subject
            ('New Keywords Added');
         $message->from('editcryptotest@gmail.com','Edit Crypto');
      });
      return true;//
      echo "Basic Email Sent. Check your inbox.";
    }

}
