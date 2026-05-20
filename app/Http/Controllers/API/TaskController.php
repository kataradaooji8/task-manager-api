<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $tasks = $query->latest()->paginate(10);

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        return response()->json([
            'message' => 'Task Created Successfully',
            'data' => new TaskResource($task)
        ], 201);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($task->user_id != auth()->id()) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $task->update($request->validated());

        return response()->json([
            'message' => 'Task Updated Successfully',
            'data' => new TaskResource($task)
        ], 200);
    }

    public function destroy(Task $task)
    {
        if ($task->user_id != auth()->id()) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task Deleted Successfully'
        ], 200);
    }
}   