<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Jobs\SendTaskCreatedEmail;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $tasks = Task::all();
        return response()->json(['status' => true, 'message' => 'List of Tasks', 'data' => $tasks], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create($request->all());
        // Dispatch job to send email
        SendTaskCreatedEmail::dispatch($task);

        return response()->json(['status' => true, 'message' => 'Task Created', 'data' => $task], 200);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($request->all());

        return response()->json(['status' => true, 'message' => 'List Task', 'data' => $task], 200);
    }

    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['status' => true, 'message' => 'Delete Task Successfully...'], 200);
    }
}
