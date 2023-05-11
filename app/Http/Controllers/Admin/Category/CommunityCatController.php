<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Farm;
use App\Models\User;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Community;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommunityCatController extends Controller
{
    public function index()
    {
        $communityCats = CommunityCat::with('user')->get();
        return view('admin.community_cat.index', compact('communityCats'));
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        return view('admin.community_cat.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'password' => 'required|confirmed|min:6',
            'community_name' => 'required|max:100',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'post' => 'required',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = "user_".rand(0,1000).'.'.$image->getClientOriginalExtension();
            $request->image->move('files/images/user/',$image_name);
        }else{
            $image_name = "company_logo.jpg";
        }

        $user = [
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'permission' => 2,
            'address' => $request->input('address'),
            'profile_photo_path' => $image_name,
            'password' => bcrypt($request->input('password')),
        ];
        DB::beginTransaction();

        $user = User::create( $user);

        $community = [
            'user_id' => $user->id,
            'name' => $request->name,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'post' => $request->upazila_id,
            'address' => $request->address,
        ];

        try{
            DB::commit();
            CommunityCat::create($community);
            toast('Success','success');
            return redirect()->route('community-cat.index');
        }catch(\Exception $ex){
            DB::rollBack();
            toast('Failed','error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $districts = District::orderBy('name')->get();
        $upazilas = Upazila::all();
        $user = User::find($id);
        return view('admin.community_cat.edit', compact('user','districts','upazilas'));
    }

    public function update(Request $request, $id)
    {
        $user = [
            'name' => $request->input('name'),
            // 'email' => strtolower($request->input('email')),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            // 'permission' => 2,
            'address' => $request->input('address'),
            // 'profile_photo_path' => $image_name,

        ];

        if(!empty($request->password))
        {
            $user['password'] = bcrypt($request->input('password'));
        }

        User::where('id', $id)->update($user);

        $data = $this->validate($request, [
            'name' => 'required|max:80',
            // 'contact_person' => 'required|max:100',
            // 'phone' => 'required|numeric',
            // 'nid' => 'required|numeric',
            'post' => 'required',
            'address' => 'required',
        ]);

        try{
            CommunityCat::where('user_id', $id)->update($data);
            toast('Success!','success');
            return redirect()->route('community-cat.index');
        }catch(\Exception $ex){
            // return $ex->getMessage();
            toast('Farm Update Failed','error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Farm::find($id)->delete();
        toast('Farm Successfully Deleted','success');
        return redirect()->back();
    }
}
