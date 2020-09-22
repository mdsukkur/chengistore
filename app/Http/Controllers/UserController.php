<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUser = User::where('id', '!=', 1)->get();
        return view('admin.template_layouts.user.addNewUser.addNewUsers', compact('allUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'unique:users'],
            'password' => 'required'
        ]);

        $all = $request->all();

        $all['password'] = Hash::make($request->password);

        $all['mobile'] = str_replace('+88', '', $request->mobile);

        User::create($all);

        return redirect()->back()->with('success', 'Successfully Added New User');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'picture' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        $id = User::findorfail($id);

        $all = $request->all();

        if ($request->hasFile('picture') && $request['picture'] != null) {
            $file = $request->file('picture');
            $file_name = $request->name . time() . '.' . $file->getClientOriginalExtension();

            $file_name = str_replace(' ', '_', $file_name);

            $file->move("upload/profile", $file_name);

            if (isset($id->picture)) {
                if (file_exists(public_path('/upload/profile/' . $id->picture))) {

                    unlink(public_path('/upload/profile/' . $id->picture));

                }
            }
        }

        $all['picture'] = isset($file_name) ? $file_name : $id->picture;

        $id->update($all);

        return redirect()->back()->with('success', 'Successfully Updated Your Information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = User::findorfail($id);

        if (isset($id->picture)) {
            if (file_exists(public_path('/upload/profile/' . $id->picture))) {

                unlink(public_path('/upload/profile/' . $id->picture));

            }
        }

        $id->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
