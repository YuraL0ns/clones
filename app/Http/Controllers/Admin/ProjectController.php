<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectStoreRequest;
use App\Sklad;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create project'])->only(['create', 'store']);
        $this->middleware(['permission:update project'])->only(['edit', 'update']);
        $this->middleware(['permission:show project'])->only(['show', 'index']);
        $this->middleware(['permission:destroy project'])->only(['destroy']);
        $this->middleware(['permission:create file'])->only(['uploadFile']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role(['Программист', 'Конструктор\АСУ', 'Склад', 'Снабжение'])->get();
        $safes = Sklad::get();
        $safeDetails = $safes->where('type', 'detail')->where('out', '<', 'in')->all();
        $safeMaterials = $safes->where('type', 'material')->where('out', '<', 'in')->all();
        $safePurchased = $safes->where('type', 'purchased')->where('out', '<', 'in')->all();
        return view('admin.project.create', compact('users', 'safePurchased', 'safeMaterials', 'safeDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $project = Project::query()
            ->create([
                'name' => $request->get('name'),
                'quest' => $request->get('quest'),
                'start' => $request->get('start'),
                'end' => $request->get('end'),
                'ps' => $request->get('ps'),
                'pe' => $request->get('pe'),
                'ss' => $request->get('ss'),
                'se' => $request->get('se'),
                'prs' => $request->get('prs'),
                'pre' => $request->get('pre'),
                'files_path' => $request->get('name') . Carbon::now()->timestamp
            ]);
        $users = $request->get('users');
        $descriptions = $request->get('descriptions');
        $startDates = $request->get('start_dates');
        $endDates = $request->get('end_dates');
        $newSafeName = $request->get('new_safe_name');
        $newSafeType = $request->get('new_safe_type');
        $newSafeCount = $request->get('new_safe_count');
        $newSafeUse = $request->get('new_safe_use');

        if ($users) {
            $project->owners()->attach($users);

            foreach ($users as $user) {
                Task::query()
                    ->create([
                        'descriptions' => $descriptions[$user],
                        'start_date' => $startDates[$user],
                        'end_date' => $endDates[$user],
                        'user_id' => $user,
                        'project_id' => $project->id
                    ]);
            }
        }

//        if ($newSafeCount && $newSafeName && $newSafeType && $newSafeUse && ($newSafeUse <= $newSafeCount)) {
//            $newSafe = Sklad::create([
//                'name' =>$newSafeName,
//                'type' => $newSafeType,
//                'in' => ($newSafeCount - $newSafeUse),
//                'out' => $newSafeUse
//            ]);
//
//            $project->safes()->attach($newSafe->id);
//        }
//
//        if ($request->get('safe_detail')) {
//            $this->addProductToProject($request->get('safe_detail'), $request->get('safe_detail_count'), $project);
//        }
//
//        if ($request->get('safe_material')) {
//            $this->addProductToProject($request->get('safe_material'), $request->get('safe_material_count'), $project);
//        }
//
//        if ($request->get('safe_purchased')) {
//            $this->addProductToProject($request->get('safe_purchased'), $request->get('safe_purchased_count'), $project);
//        }

        $path = public_path().'/uploads/projects/' . $project->files_path;
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

//        if ($request->file('files')) {
//            $this->createFiles($request->file('files'), $project, $request->get('file_types'));
//        }

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::query()
            ->with('owners')
            ->with('tasks')
            ->with('safes')
            ->findOrFail($id);
        $files = $project->files;

        // $users = $request->get('users');

        return view('admin.project.show', compact('project', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::query()
            ->with('owners')
            ->with('tasks')
            ->findOrFail($id);

        $users = User::role(['Программист', 'Конструктор\АСУ', 'Склад', 'Снабжение'])->get();
        return view('admin.project.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'quest' => ['nullable'],
            'start' => ['nullable'],
            'end' => ['nullable'],
            'ps' => ['nullable'],
            'pe' => ['nullable'],
            'ss' => ['nullable'],
            'se' => ['nullable'],
            'prs' => ['nullable'],
            'pre' => ['nullable'],
            'descriptions' => ['nullable', 'array'],
            'start_dates' => ['nullable', 'array'],
            'end_dates' => ['nullable', 'array']
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'name' => $request->get('name'),
            'quest' => $request->get('quest'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'ps' => $request->get('ps'),
            'pe' => $request->get('pe'),
            'ss' => $request->get('ss'),
            'se' => $request->get('se'),
            'prs' => $request->get('prs'),
            'pre' => $request->get('pre'),
            'updated_at' => now()
        ]);

        $users = $request->get('users');
        $descriptions = $request->get('descriptions');
        $startDates = $request->get('start_dates');
        $endDates = $request->get('end_dates');

        $project->owners()->detach();
        $project->tasks()->delete();
        if ($users) {
            foreach ($users as $user) {
                $project->owners()->attach($user);

                Task::query()
                    ->create([
                        'descriptions' => $descriptions[$user],
                        'start_date' => $startDates[$user],
                        'end_date' => $endDates[$user],
                        'user_id' => $user,
                        'project_id' => $project->id
                    ]);
            }
        }

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'file' => ['required', 'mimes:jpg,jpeg,png,pdf,docx', 'max:4096'],
            'file_type' => ['required', 'in:report,document,drawing']
        ]);

        $project = Project::findOrFail($id);
        $file = $request->file('file');
        $fileType = $request->get('file_type');

        $icon = null;
        switch ($file->getClientOriginalExtension()) {
            case 'pdf':
                $icon = 'fa-file-pdf';
                break;
            case 'jpeg':
                $icon = 'fa-image';
                break;
            case 'jpg':
                $icon = 'fa-image';
                break;
            case 'png':
                $icon = 'fa-image';
                break;
            case 'docx':
                $icon = 'fa-file-word';
                break;
            default:
                $icon = 'fa-file';
        }
        $filename = explode('.', $file->getClientOriginalName())[0] . '-' . Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/projects/'.$project->files_path), $filename);

        $project->files()->create([
            'name' => $filename,
            'icon' => $icon,
            'type' => $fileType,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    public function downloadFile($name, $project)
    {
        $project = Project::findOrFail($project);
        $file = $project->files()->where('name', $name)->first();

        $file = public_path(). "/uploads/projects/".$project->files_path.'/'.$file->name;
        if (File::exists($file)) {
            return response()->download($file);
        }
        return redirect()->back();
    }

    protected function addProductToProject($safeID, $safeDount, $project)
    {
        $safe = Sklad::find($safeID);
        $count = $safeDount;

        if ($safe && $count > 0 && $safe->out <= $safe->in && (($safe->out + $count)) <= $safe->in) {
            $safe->in -= $count;
            $safe->out += $count;
            $safe->save();

            $project->safes()->attach($safe->id);
        }
    }

    protected function createFiles($files, $project, $fileTypes)
    {
        foreach ($files as $key => $file) {
            $icon = null;
            switch ($file->getClientOriginalExtension()) {
                case 'pdf':
                    $icon = 'fa-file-pdf';
                    break;
                case 'jpeg':
                    $icon = 'fa-image';
                    break;
                case 'jpg':
                    $icon = 'fa-image';
                    break;
                case 'png':
                    $icon = 'fa-image';
                    break;
                case 'docx':
                    $icon = 'fa-file-word';
                    break;
                default:
                    $icon = 'fa-file';
            }
            $filename = explode('.', $file->getClientOriginalName())[0] . '-' . Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/projects/'.$project->files_path), $filename);

            $project->files()->create([
                'name' => $filename,
                'icon' => $icon,
                'type' => $fileTypes[$key],
                'user_id' => auth()->user()->id
            ]);
        }
    }
}
