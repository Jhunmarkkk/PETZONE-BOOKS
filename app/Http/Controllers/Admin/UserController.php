<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show users list
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        if ($request->ajax()) {
            $users = User::paginate(10); // 10 items per page for AJAX requests
            return response()->json($users);
        }

        $users = User::paginate(10);


        return view('admin.frontend.users.list', compact('users'));
    }

    /**
     * Show form for creating a new user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.frontend.users.add');
    }

    /**
     * Store a new created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateAddForm($request);

        if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }
            // Create user
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->role = $request->input('role');
            $user->phone_number = $request->input('phone_number');
            $user->address = $request->input('address'); 
            if ($request->hasFile('image_path')) {
                // Store the new image and update the user's image_path
            $imagePath = $request->file('image_path')->store('profile_images', 'public');
            $user->image_path = $imagePath;
            } else {
               
            $user->image_path = null; // Or leave it as null
            }
            $user->save();

        return redirect()->route('admin.users.all')->with('simpleSuccessAlert', 'User added successfully');
        } 
    /**
     * Show form for editing the specified user.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //$user = User::findOrFail($id);
        return view('admin.frontend.users.edit', compact('user'));
    }

    /** 
     * Update specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request){
        $validator = $this->validateUpdateForm($request);
        // dd($user);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role = $request->input('role');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');

    if ($request->hasFile('image_path')) {
        
        $imagePath = $request->file('image_path')->store('profile_images', 'public');
        $user->image_path = $imagePath;
    }
    $user->save();

    return redirect()->route('admin.users.all')->with('simpleSuccessAlert', 'User updated successfully');
}


    /**
     * Remove specified user from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        File::delete(public_path("\images\users\\$user->image_path"));

        $user->delete();

        return back()->with('simpleSuccessAlert' , 'User removed successfully');
    }

    /**
     * Validate form data for adding a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateAddForm(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
            'phone_number' => 'required|string|max:20', // Changed field name to match HTML form
            'address' => 'required|string|max:255',
        ]);  
    }

    protected function validateUpdateForm(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
            'phone_number' => 'required|string|max:20', // Changed field name to match HTML form
            'address' => 'required|string|max:255',
        ]);
    }

    public function deactivateUser(User $user)
    {
        $user->update(['is_active' => false]);

        return redirect()->back()->with('success', 'User deactivated successfully');
    }   

}