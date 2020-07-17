<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Models\TaskHasFiles;
use App\Models\TaskHasSklads;
use App\Sklad;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Project;
use Illuminate\Support\Facades\Validator;

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
        $projects = Project::query()->get();
        return view('project.main', compact('projects'));
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

        return view('project.create', compact('users','safes'));
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
        $descriptions1 = $request->get('descriptions1');
        $descriptions2 = $request->get('descriptions2');
        $descriptions3 = $request->get('descriptions3');
        $descriptions4 = $request->get('descriptions4');
        $descriptions5 = $request->get('descriptions5');
        $descriptions6 = $request->get('descriptions6');
        $descriptions7 = $request->get('descriptions7');
        $descriptions8 = $request->get('descriptions8');
        $descriptions9 = $request->get('descriptions9');
        $descriptions10 = $request->get('descriptions10');
        $descriptions11 = $request->get('descriptions11');
        $descriptions12 = $request->get('descriptions12');
        $descriptions13 = $request->get('descriptions13');
        $descriptions14 = $request->get('descriptions14');
        $tartDates = $request->get('start_dates');
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
                        'descriptions1' => $descriptions1[$user],
                        'descriptions2' => $descriptions2[$user],
                        'descriptions3' => $descriptions3[$user],
                        'descriptions4' => $descriptions4[$user],
                        'descriptions5' => $descriptions5[$user],
                        'descriptions6' => $descriptions6[$user],
                        'descriptions7' => $descriptions7[$user],
                        'descriptions8' => $descriptions8[$user],
                        'descriptions9' => $descriptions9[$user],
                        'descriptions10' => $descriptions10[$user],
                        'descriptions11' => $descriptions11[$user],
                        'descriptions12' => $descriptions12[$user],
                        'descriptions13' => $descriptions13[$user],
                        'descriptions14' => $descriptions14[$user],
                        'start_date' => $tartDates[$user],
                        'end_date' => $endDates[$user],
                        'user_id' => $user,
                        'project_id' => $project->id
                    ]);
            }
        }

       // if ($newSafeCount && $newSafeName && $newSafeType && $newSafeUse && ($newSafeUse <= $newSafeCount)) {
       //     $newSafe = Sklad::create([
       //         'name' =>$newSafeName,
       //         'type' => $newSafeType,
       //         'in' => ($newSafeCount - $newSafeUse),
       //         'out' => $newSafeUse
       //     ]);

       //     $project->safes()->attach($newSafe->id);
       // }

       // if ($request->get('safe_detail')) {
       //     $this->addProductToProject($request->get('safe_detail'), $request->get('safe_detail_count'), $project);
       // }

       // if ($request->get('safe_material')) {
       //    $this->addProductToProject($request->get('safe_material'), $request->get('safe_material_count'), $project);
       // }

       // if ($request->get('safe_purchased')) {
       //     $this->addProductToProject($request->get('safe_purchased'), $request->get('safe_purchased_count'), $project);
       // }

        $path = public_path().'/uploads/projects/' . $project->files_path;
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }


//        if ($request->file('files')) {
//            $this->createFiles($request->file('files'), $project, $request->get('file_types'));
//        }


        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth = auth()->user();
        $project = Project::query()
            ->with('tasks')
            ->with('owners')
            ->with('safes')
            ->with('comments')
            ->findOrFail($id);
        $safes = Sklad::get();

        $users = User::orderBy('last_name', 'asc')->get();
        $sklads = Sklad::orderBy('name', 'asc')->get();

        $files = $project->files;
        if (!in_array('Бухгалтер', $auth->getRoleNames()->toArray())) {
            $files = $files->filter(function ($value, $key) {
                if (!!in_array('Бухгалтер', $value->owner->getRoleNames()->toArray()) && $value->type === 'document') {
                    return false;
                }
                return true;
            });
        }

        return view('project.show', compact('project', 'files', 'safes', 'users', 'sklads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $project = Project::query()
//            ->with('owner')
//            ->findOrFail($id);
//
//        $users = User::query()->get();
//        return view('project.edit', compact('project', 'users'));
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
        $request->validate([
            'safe_types' => ['required', 'array'],
            'safe_names' => ['required', 'array'],
            'safe_counts' => ['required', 'array'],
            'safe_types.*' => ['nullable', 'in:material,detail,purchased'],
            'safe_names.*' => ['nullable', 'integer'],
            'safe_counts.*' => ['nullable', 'integer'],
            'files' => ['required', 'array'],
            'file_types' => ['required', 'array'],
            'file_types.*' => ['nullable', 'in:report,document,drawing'],
            'files.*' => ['nullable', 'mimes:jpg,jpeg,png,pdf,docx', 'max:4096']
        ]);

        $project = Project::findOrFail($id);
        $names = $request->get('safe_names');
        $counts = $request->get('safe_counts');

        if ($names) {
            foreach ($names as $key => $name) {
                $this->addProductToProject($name, $counts[$key], $project);
            }
        }

        if ($request->file('files')) {
            $this->createFiles($request->file('files'), $project, $request->get('file_types'));
        }

//         $this->validate($request, [
//            'name' => 'required'
//        ]);
//
//        $project = Project::findOrFail($id);
//        $email = $request->get('owner');
//
//        if ($email) {
//            $user = User::query()->where('email', $email)->first();
//
//            if ($user && !$user->hasRole('Администратор')) {
//                $project->user_id = $user->id;
//            }
//        }
//
//        $project->name = $request->input('name');
//        $project->quest = $request->input('quest');
//        $project->start = $request->input('start');
//        $project->end = $request->input('end');
//        $project->ps = $request->input('ps');
//        $project->pe = $request->input('pe');
//        $project->ss = $request->input('ss');
//        $project->se = $request->input('se');
//        $project->prs = $request->input('prs');
//        $project->pre = $request->input('pre');
//
//        $project->save();
//        return redirect('project.index')->with('success', 'Молодец , вообще красавчик');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $project = Project::find($id);
//        $project->delete();
//        return redirect('/project')->with('success', 'Ну что могу сказать - ты его удалил.');
    }

    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'file' => ['required', 'mimes:jpg,jpeg,png,pdf,docx', 'max:894096'],
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

    /**
     * @param Request $request
     * @param $project_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTask(Request $request, $project_id)
    {
        $project = Project::findOrFail($project_id);

        $validator = Validator::make($request->post(),[
            'task_user_id' => 'required|exists:users,id',
            'task_description'  => 'required',
            'task_date_from' => 'nullable',
            'task_date_to' => 'nullable',
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator->errors()->all());
        }

        $payload = $validator->validated();
        Task::create([
            'project_id' => $project->id,
            'user_id' => $payload['task_user_id'],
            'descriptions' => $payload['task_description'],
            'start_date' => $payload['task_date_from'],
            'end_date' => $payload['task_date_to'],
        ]);
        return back();
    }

    /**
     * @param $project_id
     * @param $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function taskDone($project_id, $task_id)
    {
        $project = Project::findOrFail($project_id);
        $task = Task::where('project_id', $project->id)->findOrFail($task_id);

        $task->update([
            'done' => true,
        ]);

        return redirect('/project/' . $project->id);
    }

    /**
     * @param Request $request
     * @param $project_id
     * @param $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function taskAddFile(Request $request, $project_id, $task_id)
    {
        $project = Project::findOrFail($project_id);
        $task = Task::where('project_id', $project->id)->findOrFail($task_id);

        $request->validate([
            'file' => ['required', 'mimes:jpg,jpeg,png,pdf,docx', 'max:894096'],
        ]);

        $file = $request->file('file');

        $filename = explode('.', $file->getClientOriginalName())[0] . '-' . Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/tasks/' . $task->id), $filename);

        TaskHasFiles::create([
            'task_id' => $task->id,
            'name' => $filename,
        ]);

        return redirect()->back();
    }

    /**
     * @param $project_id
     * @param $task_id
     * @param $file_id
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTaskFile($project_id, $task_id, $file_id)
    {
        $project = Project::findOrFail($project_id);
        $task = Task::findOrFail($task_id);
        $file = TaskHasFiles::findOrFail($file_id);

        $filePath = public_path(). "/uploads/tasks/".$task->id.'/'.$file->name;

        if (File::exists($filePath)) {
            return response()->download($filePath);
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $project_id
     * @param $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editTaskSklads(Request $request, $project_id, $task_id)
    {
        $project = Project::findOrFail($project_id);
        $task = Task::findOrFail($task_id);
        $validate = Validator::make($request->post(),
        [
            'in_stock' => 'nullable|array',
            'to_purchase' => 'nullable|array',
        ]);

        if($validate->fails()){
            return back()->withErrors($validate->errors()->all());
        }

        $payload = $validate->validate();
        DB::table('task_has_sklads')->where('task_id', $task->id)->update(['in_stock' => false]);
        if(isset($payload['in_stock'])) {
            foreach (array_keys($payload['in_stock']) as $sklad_id){
                if($taskHasSklad = TaskHasSklads::where('task_id', $task->id)->where('sklad_id', $sklad_id)->first()){
                    $taskHasSklad->update([
                        'in_stock' => true,
                    ]);
                }else{
                    TaskHasSklads::create([
                        'task_id' =>  $task->id,
                        'sklad_id'=>  $sklad_id,
                        'in_stock' => true,
                    ]);
                }
            }
        }

        DB::table('task_has_sklads')->where('task_id', $task->id)->update(['to_purchase' => false]);
        if(isset($payload['to_purchase'])) {
            foreach (array_keys($payload['to_purchase']) as $sklad_id){
                if($taskHasSklad = TaskHasSklads::where('task_id', $task->id)->where('sklad_id', $sklad_id)->first()){
                    $taskHasSklad->update([
                        'to_purchase' => true,
                    ]);
                }else{
                    TaskHasSklads::create([
                        'task_id' =>  $task->id,
                        'sklad_id'=>  $sklad_id,
                        'to_purchase' => true,
                    ]);
                }
            }
        }

        return redirect()->back();
    }



}
