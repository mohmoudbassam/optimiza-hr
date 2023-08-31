<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {

        $users = Team::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->paginate(5)
            ->through(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'manager_name' => $user?->manager?->name,

                ];
            })->withQueryString();

        return inertia('Teams/Index', [
            'users' => $users,
            'filters' => $request->only('search')
        ]);
    }

    public function create(Request $request)
    {
        $users = User::query()->where(function ($q){
            $q->where('is_manager',0)->orWhereNull('is_manager');
        })->where('is_admin',0)->get();

        return inertia('Teams/Create', [
            'users' => $users
        ]);
    }

    public function store(CreateTeamRequest $request)
    {

        Team::query()->create([
            'name' => $request->name,
            'team_leader_id' => $request->manger_id,
        ]);
        User::query()->where('id',$request->manger_id)->update([
            'is_manager'=>1
        ]);

    }

    public function edit(Request $request)
    {

        $team= Team::query()->findOrFail($request->id);
        $mangers = User::query()->where(function ($q)use ($team){
            $q->where('is_manager',0)->orWhereNull('is_manager')->orWhere('id',$team->team_leader_id);
        })->where('is_admin',0)->get();

        return inertia('Teams/Edit', [
            'editable_user' => $team->only('id', 'name', 'team_leader_id'),
            'mangers' => $mangers
        ]);
    }

    public function update(Request $request)
    {
        $user = Team::query()->findOrFail($request->id);
        $user->update([
            'name' => $request->name,
            'team_leader_id' => $request->manger_id,
        ]);
    }

    public function destroy(Request $request)
    {
        $user = Team::query()->findOrFail($request->id);
        $user->delete();
    }

}
