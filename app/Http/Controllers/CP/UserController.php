<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users=User::query()
            ->when($request->search,function ($query) use ($request){
                $query->where('name','like','%'.$request->search.'%');
            })

            ->paginate(5)
            ->through(function ($user){
                return [
                    'id'=>$user->id,
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'salary'=>$user->salary,
                    'dob'=>$user->dob,
                    'profile_photo_path'=>$user->profile_photo_path,
                    'monthly_working_hours'=>$user->monthly_working_hours,
                ];
            })
            ->withQueryString();

        return inertia('User/Index',[
            'users'=>$users,
            'filters'=>$request->only('search')
        ]);
    }

    public function create(Request $request)
    {
        return inertia('User/Create');
    }
    public function store(CreateUserRequest $request)
    {


        User::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'salary'=>$request->salary,
            'dob'=>$request->dob,
            'profile_photo_path'=>$request->image,
            'password'=>bcrypt('12345678'),
            'monthly_working_hours'=>$request->monthly_working_hours,
        ]);

    }

    public function edit(Request $request)
    {
        $user=User::query()->findOrFail($request->id);
        return inertia('User/Edit',[
            'user'=>$user->only('id','name','email','salary','image','dob','profile_photo_url','monthly_working_hours'),
        ]);
    }
    public function update(UpdateUserRequest $request)
    {


        $user=User::query()->findOrFail($request->id);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'salary'=>$request->salary,
            'dob'=>$request->dob,
            'profile_photo_path'=>$request->image,
            'monthly_working_hours'=>$request->monthly_working_hours,
        ]);
    }
    public function destroy(Request $request)
    {
        $user=User::query()->findOrFail($request->id);
        $user->delete();
    }
    public function upload_image(Request $request)
    {
        if($request->file('image'))
            return response()->json(['filename'=>$request->file('image')->store('image', 'public')]);

    }


}
