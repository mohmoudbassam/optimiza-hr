<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->paginate(5)
            ->through(function ($project) {
                return [
                    'id' => $project->id,
                    'name' => $project->name,
                    'company_name'=>$project->company->name,
                ];
            })
            ->withQueryString();

        return inertia('Project/Index', [
            'projects' => $projects,
            'filters' => $request->only('search')
        ]);
    }

    public function create(Request $request)
    {
        $companies = Company::query()->get();
        return inertia('Project/Create', [
            'companies' => $companies
        ]);
    }

    public function store(CreateProjectRequest $request)
    {
        Project::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'company_id' => $request->company_id,
        ]);

    }
    public function edit(Request $request,Project $project)
    {

        $companies = Company::query()->get();
        return inertia('Project/Edit', [
            'project' => $project,
            'companies' => $companies
        ]);
    }
    public function update(CreateProjectRequest $request,Project $project)
    {
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'company_id' => $request->company_id,
        ]);
    }
}
