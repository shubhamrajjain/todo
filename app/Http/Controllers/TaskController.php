<?php

namespace App\Http\Controllers;

use App\Exports\TaskExport;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    public function tasks($id = NULL, $status = NULL)
    {
        $minRange = NULL;
        $maxRange = NULL;
        if (isset(request()->datefilter)) {

            $dateRange  = explode(' - ', request()->datefilter);
            if (is_array($dateRange) && count($dateRange) == 2) {
                $minRange = date('Y-m-d', strtotime($dateRange[0]));
                $maxRange = date('Y-m-d', strtotime($dateRange[1]));
            }
        }

        $tasks = Task::orderBy('created_at', 'desc')
            ->when(isset($id), function ($q) use ($id) {
                return $q->where('user_id', $id);
            })
            ->when(isset($minRange), function ($q) use ($minRange) {
                return $q->where('task_date', '>=', $minRange);
            })
            ->when(isset($maxRange), function ($q) use ($maxRange) {
                return $q->where('task_date', '<=', $maxRange);
            })
            ->when(isset($status), function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->when(isset(request()->task_date), function ($q) {
                return $q->where('task_date', request()->task_date);
            })
            ->when(isset(request()->priority), function ($q) {
                return $q->where('priority', request()->priority);
            })
            ->when(isset(request()->user), function ($q) {
                return $q->where('user_id', request()->user);
            })
            ->paginate(5);

        return $tasks;
    }

    public function index($id = NULL)
    {
        $heading = 'All Tasks';
        $users = User::all();
        $tasks = $this->tasks($id);
        return view('backend.task.index', compact('tasks', 'heading', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('backend.task.create', compact('users'));
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'duration' => 'required|integer',
            'task_date' => 'required'
        ]);

        Task::create(request()->all());
        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully!');
    }

    public function delete($id)
    {
        $task = Task::findorFail($id);
        $task->delete();
        return back()->with('success', 'Task Deleted Successfully!');
    }

    public function changeStatus($id)
    {
        $task = Task::findOrFail($id);
        if ($task->status == 1) {
            $task->status = 0;
        } else {
            $task->status = 1;
        }
        $task->save();
        return response()->json([
            'status' => true,
            'message' => 'Task status Updated Succesfully!'
        ]);
    }

    public function completedTask()
    {

        $userId = NULL;
        $heading = 'Completed Task';
        $users = User::all();
        $tasks = $this->tasks($userId, 1);
        return view('backend.task.index', compact('tasks', 'heading', 'users'));
    }

    public function pendingTask()
    {
        $userId = NULL;
        $heading = 'Pending Task';
        $users = User::all();
        $tasks = $this->tasks($userId, 0);
        return view('backend.task.index', compact('tasks', 'heading', 'users'));
    }

    public function export()
    {
        return Excel::download(new TaskExport, 'tasks.xlsx');
    }
}
