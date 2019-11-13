<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewUserCreateEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Image;
use App\Group;
use Image as Img;
use App\Group_user;
use App\Group_image;
use Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('is_admin', 0)->count();
        $groups = Group::count();
        $images = Image::count();
        return view('admin.dashboard', ['users' => $users, 'groups' => $groups, 'images' => $images]);
    }
    public function admin_profile()
    {
        return view('admin.admin_profile');
    }
    public function update_admin_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = request('name');
        $user->email = request('email');
        $user->save();
        return redirect()->back()->with('success', 'User has been updated.');
    }

    public function change_admin_password()
    {
        return view('admin.change_admin_password');
    }
    public function update_admin_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return redirect()->route('home');
        //return redirect()->back()->with('success', 'Password has been updated.');
    }

    public function user_list()
    {
        $users = User::all()->where('is_admin', 0);
        return view('admin.user_list', ['users' => $users]);
    }

    public function create_new_user()
    {
        return view('admin.create_user');
    }
    public function save_new_user(Request $request)
    {
        $user_detail = array();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ]);
        $user_detail['password'] = $request->password;
        $user_detail['email'] = $request->email;
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //---Send email event----//
        //event(new NewUserCreateEvent($user_detail));

        return redirect()->route('user_list')->with('success', 'User has been created.');
    }
    public function edit_user(User $user)
    {
        //dd($user->name);
        $groups = Group::all();
        $selected_groups = array();
        foreach ($user->groups as $group) {
            $selected_groups[] = $group->id;
        }
        return view('admin.edit_user', ['user' => $user, 'groups' => $groups, 'selected_groups' => $selected_groups]);
    }

    public function update_user(User $user)
    {
        //var_dump(request('groups'));
        //die();
        $groups = request('groups');
        Group_user::where('user_id', $user->id)->delete();
        if ($groups) {
            foreach ($groups as $key => $group) {
                $group_user = new Group_user;
                $group_user->user_id = $user->id;
                $group_user->group_id = $group;
                $group_user->save();
            }
        }

        $this->validate(request(), [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $user->name = request('name');
        $user->email = request('email');

        $user->save();
        return redirect()->back()->with('success', 'User has been updated.');
    }
    public function change_user_password(User $user)
    {
        return view('admin.change_user_password', ['user' => $user]);
    }
    public function update_user_password(User $user)
    {
        $this->validate(request(), [
            'password' => 'required|confirmed|min:8',
        ]);
        $user->password = Hash::make(request('password'));
        $user->save();
        return redirect()->back()->with('success', 'User password has been updated.');
    }

    public function delete_user(User $user)
    {
        $user->delete();
        return redirect()->route('user_list')->with('success', 'User has been deleted.');
    }


    public function fileCreate()
    {
        return view('admin.upload_images');
    }

    public function fileStore(Request $request)
    {
        $filenamewithextension = $request->file('file')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('file')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename . '_' . time() . '.' . $extension;

        //small thumbnail name
        $smallthumbnail = $filename . '_small_' . time() . '.' . $extension;

        //medium thumbnail name
        $mediumthumbnail = $filename . '_medium_' . time() . '.' . $extension;

        //large thumbnail name
        $largethumbnail = $filename . '_large_' . time() . '.' . $extension;

        //Upload File
        //$request->file('file')->storeAs('public/images', $filenametostore);
        $request->file('file')->storeAs('public/images/thumbnail', $smallthumbnail);
        $request->file('file')->storeAs('public/images/thumbnail', $mediumthumbnail);
        $request->file('file')->storeAs('public/images/thumbnail', $largethumbnail);

        //create small thumbnail
        $smallthumbnailpath = public_path('storage/images/thumbnail/' . $smallthumbnail);
        $this->createThumbnail($smallthumbnailpath, 150, 93);

        //create medium thumbnail
        $mediumthumbnailpath = public_path('storage/images/thumbnail/' . $mediumthumbnail);
        $this->createThumbnail($mediumthumbnailpath, 300, 185);

        //create large thumbnail
        $largethumbnailpath = public_path('storage/images/thumbnail/' . $largethumbnail);
        $this->createThumbnail($largethumbnailpath, 550, 340);


        // Add watermark
        $image = $request->file('file');
        $img = Img::make($image->getRealPath());
        $watermark = Img::make(public_path('/img/logo.png'));
        $img->insert($watermark, 'bottom-right', 10, 10);
        $img->save(public_path('storage/images/' . $filenametostore));



        $Image = new Image();
        $Image->filename = $filenametostore;
        $Image->small = $smallthumbnail;
        $Image->medium = $mediumthumbnail;
        $Image->large = $largethumbnail;
        $Image->save();
        return response()->json(['success' => $filenametostore]);
    }
    public function createThumbnail($path, $width, $height)
    {
        // $img = Img::make($path)->resize($width, $height, function ($constraint) {
        //     $constraint->aspectRatio();
        // });
        $img = Img::make($path)->resize($width, $height);
        $img->save($path);
    }
    public function images()
    {
        $images = Image::all();
        $groups = Group::all();

        return view('admin.image_list', ['images' => $images, "groups" => $groups]);
    }

    public function group_list()
    {
        $groups = Group::all();
        return view('admin.group_list', ['groups' => $groups]);
    }

    public function create_new_group()
    {
        return view('admin.create_group');
    }

    public function save_new_group(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:groups,name',
        ]);
        $group = new Group;
        $group->name = $request->name;
        $group->save();
        return redirect()->route('group_list')->with('success', 'Group has been created.');
    }

    public function edit_group(Group $group)
    {
        //dd($group->name);
        return view('admin.edit_group', ['group' => $group]);
    }

    public function update_group(Group $group)
    {
        $this->validate(request(), [
            'name' => [
                'required',
                Rule::unique('groups')->ignore($group->id),
            ],
        ]);
        $group->name = request('name');
        $group->save();
        return redirect()->back()->with('success', 'Group has been updated.');
    }

    public function delete_group(Group $group)
    {
        $group->delete();
        return redirect()->route('group_list')->with('success', 'Group has been deleted.');
    }
    public function edit_image(Image $image)
    {
        return view('admin.edit_image', ['image' => $image]);
    }

    public function update_image(Image $image)
    {
        $image->title = request('title');
        $image->description = request('description');
        $image->save();
        return redirect()->back()->with('success', 'Image has been updated.');
    }
    public function delete_image(Request $request)
    {
        $image = Image::find($request->id);
        $original = public_path() . '/storage/images/' . $image->filename;
        $small = public_path() . '/storage/images/thumbnail/' . $image->small;
        $medium = public_path() . '/storage/images/thumbnail/' . $image->medium;
        $large = public_path() . '/storage/images/thumbnail/' . $image->large;
        if (file_exists($original)) {
            unlink($original);
        }
        if (file_exists($small)) {
            unlink($small);
        }
        if (file_exists($medium)) {
            unlink($medium);
        }
        if (file_exists($large)) {
            unlink($large);
        }
        $image->delete();
        return response()->json(['success' => 'Got Simple Ajax Request.', 'id' => $request->id]);
    }

    public function group_images(Request $request)
    {
        $group = Group::find($request->group);
        $selected_images = array();
        foreach ($group->images as $image) {
            $selected_images[] = $image->id;
        }
        $images = Image::all();
        return view('admin.group_images', ['images' => $images, 'group' => $group, 'selected_images' => $selected_images]);
    }

    public function add_group_images(Request $request)
    {
        $group = $request->group_id;
        $image = $request->image_id;
        // DB::table('group_image')->insert(
        //     ['image_id' => $image, 'group_id' => $group]
        // );
        $group_image = new Group_image;
        $group_image->image_id = $image;
        $group_image->group_id = $group;
        $group_image->save();
        return response()->json(['success' => 'Saved to group.', 'image' => $image]);
    }
    public function remove_group_images(Request $request)
    {
        $group = $request->group_id;
        $image = $request->image_id;
        //DB::table('group_image')->where('image_id', $image)->where('group_id', $group)->delete();
        Group_image::where('image_id', $image)->where('group_id', $group)->delete();
        return response()->json(['success' => 'Image Deleted.', 'image' => $image]);
    }
}
