<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FarmerController extends Controller
{
    public function index()
    {
        $adminUsers = User::where('type', 2)->get();
        return view('admin.user_management.farmer.index', compact('adminUsers'));
    }

    public function create()
    {
        return view('admin.user_management.farmer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $image_name = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = "user_".rand(0, 1000).'.'.$image->getClientOriginalExtension();
            $request->image->move('files/images/user/', $image_name);
        } else {
            $image_name = "company_logo.jpg";
        }

        $data = [
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'type' => 2,
            'is' => 1,
            'address' => $request->input('address'),
            'profile_photo_path' => $image_name,
            'password' => bcrypt($request->input('password')),
        ];

        DB::beginTransaction();

        try {
            $user = User::create($data);
            $permission = [
                'role_id' => 2,
                'model_type' => "App\Models\User",
                'model_id' =>  $user->id,
            ];
            DB::table('model_has_roles')->insert($permission);
            DB::commit();
            toast('Farmer Successfully Inserted', 'success');
            // return redirect()->route('farmer.index');
            return back();
        } catch (\Exception $ex) {
            DB::rollBack();
            toast($ex->getMessage().'Farmer Inserted Failed', 'error');
            return back();
        }
    }

    public function edit($id)
    {
        $adminUsers = User::find($id);
        return view('farmer.user_management.farmer.edit', compact('adminUsers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $image_name = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = "user_".rand(0, 10000).'.'.$image->getClientOriginalExtension();
            $request->image->move('files/images/user/', $image_name);
        } else {
            $image_name = $request->oldImage;
        }

        DB::beginTransaction();

        $data = [
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'profile_photo_path' => $image_name,
            'password' => bcrypt($request->input('password')),
        ];

        $permission = [
            'role_id' => $request->input('is')
        ];

        try {
            User::find($id)->update($data);
            DB::table('model_has_roles')->where('model_id', $id)->update($permission);
            DB::commit();
            toast('User Successfully Updated', 'success');
            return redirect()->route('admin-user.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            toast($ex->getMessage().'User Updated Failed', 'error');
            return back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $getData = User::where('is', 1)->first();
        // $getData = User::where('is', 1)->get();
        // foreach($getData as $getDatas){
        //     return $getDatas->password;
        // }
        return $getData->password;
        // return$password = bcrypt($request->password);
        // return User::find($id);


        if ($getData->password == $request->password) {
            return 'asdfgasdf';
        } else {
            return 'Not';
        }
    }
}
