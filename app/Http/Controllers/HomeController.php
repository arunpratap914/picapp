<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Image;
use App\Group;
use App\Group_user;
use App\Group_image;
use Auth;
use App\Like;
use File;
use ZipArchive;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // var_dump(Auth::user()->id);
        // die;
        if (Auth::user()->id) {
            return redirect()->route('user_groups');
        }
        return view('home');
    }

    public function user_groups()
    {
        $user = User::find(Auth::user()->id);
        return view('user_groups', ['user' => $user]);
    }
    public function group(Request $request)
    {
        $my_likes = array();
        if (isset($request->likes) && $request->likes == "my_likes") {
            $my_likes = Like::all()->where('user_id', Auth::user()->id)->where('group_id', $request->id)->pluck('image_id')->toArray();
            //var_dump($my_likes);
            $group = Group::find($request->id);
            $likes = Like::all()->where('user_id', Auth::user()->id)->pluck('image_id')->toArray();
            return view('group_detail', ['group' => $group, 'likes' => $likes, 'my_likes' => $my_likes, 'show_likes' => 1]);
        } else {
            $group = Group::find($request->id);
            $likes = Like::all()->where('user_id', Auth::user()->id)->pluck('image_id')->toArray();
            return view('group_detail', ['group' => $group, 'likes' => $likes, 'my_likes' => $my_likes, 'show_likes' => 0]);
        };
    }

    // public function group(Request $request)
    // {
    //     if (isset($request->likes) && $request->likes == "my_likes") {
    //         $images = Like::all()->where('group_id', $request->id)->where('user_id', Auth::user()->id);
    //     } else {
    //         $images = Group_image::all()->where('group_id', $request->id);
    //     }
    //     $likes = Like::all()->where('user_id', Auth::user()->id)->pluck('image_id')->toArray();
    //     $group = Group::find($request->id);
    //     return view('group_detail', ['group' => $group, 'likes' => $likes, 'images' => $images]);
    // }
    public function get_comment(Request $request){
        //var_dump($request->group_id);
        //return $request;
        $comment = Like::where('user_id', Auth::user()->id)->where('image_id', $request->image_id)->where('group_id', $request->group_id)->get()->pluck('comment');
        return $comment;
    }

    public function post_comment(Request $request){
        $like = Like::where('user_id', Auth::user()->id)->where('image_id', $request->image_id)->where('group_id', $request->group_id)->update(['comment' => $request->comment]);
        return $like;
    }

    public function like(Request $request)
    {
        if ($request->action == "like") {
            $like = new Like();
            $like->user_id = $request->user_id;
            $like->image_id = $request->image_id;
            $like->group_id = $request->group_id;
            $like->save();
            return response()->json(['success' => 'Liked' . $request->user_id . $request->image_id . $request->group_id, 'action' => "like"]);
        }
        $like = Like::where('user_id', $request->user_id)->where('image_id', $request->image_id)->where('group_id', $request->group_id)->delete();
        return response()->json(['success' => 'unliked' . $request->user_id . $request->image_id . $request->group_id, 'action' => 'unlike']);
    }
    function downloadZip(Request $request)
    {
        $str = str_replace("[", "", $request->images);
        $str = str_replace("]", "", $str);
        $images = explode(",", $str);
        $zip = new ZipArchive;

        $fileName = 'images/myimages.zip';
        if (file_exists($fileName)) {
            unlink($fileName);
        }
        if ($zip->open(public_path($fileName), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($images as $key => $image) {
                $im = Image::find($image);
                if ($im->path != "") {
                    $relativeNameInZipFile = basename($im->path);
                    $zip->addFile($im->path, $relativeNameInZipFile);
                }
            }
            $zip->close();
            return response()->download(public_path($fileName));
        }
    }
}
