<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Difficulty;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    protected $rules = [
        'name' => 'required|min:3|max:100|string|unique:projects',
        'publication_date' => 'required',
        'preview' => 'required|image|max:300',
        'github_url' => 'required|url|min:10',
        'slug' => 'unique',
        'type_id' => 'required|exists:types,id',
        'difficulty_id' => 'required|exists:difficulties,id'
    ];

    protected $messages = [
        'name.required' => 'Inserisci il nome del progetto.',
        'name.min' => 'Il nome è troppo corto.',
        'name.max' => 'Il nome è troppo lungo.',
        'name.unique' => 'Il nome del progetto deve essere UNICO',
        'publication_date.required' => 'Inserisci la data di pubblicazione del progetto.',
        'preview.required' => 'Inserisci l\'url della copertina.',
        'preview.image' => 'Carica una immagine o inserisci il suo URL.',
        'preview.max' => 'Url troppo lungo o non valido.',
        'complexity.required' => 'Inserisci il livello di complessità.',
        'complexity.min' => 'Il numero deve essere compreso tra 1 e 5',
        'complexity.max' => 'Il numero deve essere compreso tra 1 e 5',
        'github_url.required' => 'Inserisci l\'url della repository GitHub.',
        'github_url.url' => 'Url non valido.',
    ];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sort = $request->sort ?? '';
        if ($sort) {
            $projects = Project::orderBy($sort)->paginate(10);
        } else {
            $projects = Project::paginate(10);
        }

        $trashed = Project::onlyTrashed()->get()->count();
        return view('admin.projects.index', compact('projects', 'trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {

        return view('admin.projects.create', compact('project'), ['types' => Type::all(), 'difficulties' => Difficulty::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->rules,
            $this->messages
        );
        $data['slug'] = Str::slug($data['name']);
        $data['preview'] =  Storage::put('imgs/', $data['preview']);
        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();

        return redirect()->route('admin.projects.show', $newProject->slug)->with('info-message', "'$newProject->name' was created successfully!")->with('alert', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'), ['types' => Type::all(), 'difficulties' => Difficulty::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $newRules = $this->rules;
        $newRules['name'] = ['required', 'string', 'min:3', 'max:100', Rule::unique('projects')->ignore($project->id)];

        $data = $request->validate($newRules, $this->messages);

        if ($request->hasFile('preview')) {
            if (!$project->isAnUrl()) {
                Storage::delete($project->preview);
            }
            $data['preview'] =  Storage::put('imgs/', $data['preview']);
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', compact('project'))->with('info-message', "'$project->name' was updated successfully!")->with('alert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('info-message', "$project->name has been trashed!")->with('alert', 'warning');
    }


    public function trash()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    public function forceDelete($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->first();
        if (!$project->isAnUrl()) {
            Storage::delete($project->preview);
        }

        $project->forceDelete();
        return redirect()->route('admin.trash')->with('info-message', "'$project->name' is permanently deleted!")->with('alert', 'danger');
    }

    public function restore($slug)
    {
        // Project::where('slug', $slug)->withTrashed()->restore();
        Project::onlyTrashed()->where('slug', $slug)->restore();
        return redirect()->route('admin.trash')->with('info-message', "The project has been restored successfully!")->with('alert', 'success');
    }


    /**
     * Restore all archived projects
     * 
     * @return \Illuminate\Http\Response
     */
    public function restoreAll()
    {
        Project::onlyTrashed()->restore();
        return redirect()->route('admin.trash')->with('info-message', "All projects have been restored!")->with('alert', 'success');
    }
}
