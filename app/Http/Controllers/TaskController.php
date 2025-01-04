<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{

    public function index(Request $request)
    {

        $tasks = Task::with('category')->get();
        $categories = Category::all();
        $avatar = auth()->user()->avatar;
        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
            'avatar' => $avatar,
            'categories' => $categories,
        ]);
    }
    public function getTask(Request $request)
    {

        $tasks = Task::with('category')->get();
        $categories = Category::all();
        $avatar = auth()->user()->avatar;
        return response()->json($tasks);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $obj = new Task();

        $obj->title = $validated['title'];
        $obj->description = $validated['description'] ?? '';
        $obj->category_id = $validated['category_id'];
        $obj->start_date = $validated['start_date'];
        $obj->end_date = $validated['end_date'];
        $obj->save();

        // Handle avatar upload if a file is provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tasks', 'public');
            $obj->image = $path;
        }

        // Save the user
        $obj->save();


        $tasks = Task::with('category')->get();
        $categories = Category::all();
        $avatar = auth()->user()->avatar;
        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
            'avatar' => $avatar,
            'categories' => $categories,
        ]);
        // Redirect with success message
        return redirect()->route('dashboard')
            ->with('success', 'Task Added');
    }





    public function update(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $obj = Task::find($request->id);
        $obj->title = $validated['title'];
        $obj->description = $validated['description'] ?? '';
        $obj->category_id = $validated['category_id'];
        $obj->start_date = $validated['start_date'];
        $obj->end_date = $validated['end_date'];
        $obj->save();

        // Handle avatar upload if a file is provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tasks', 'public');
            $obj->image = $path;
        }

        // Save the user
        $obj->save();


        // Redirect with success message
        return redirect()->route('dashboard')
            ->with('success', 'Task Updated');
    }



    public function destroy($id)
    {
        $obj = Task::find($id);
        if ($obj) {
            $obj->delete();
        }
        return redirect()->route('dashboard')
            ->with('success', 'Deleted');
    }



    public function exportExcel()
    {
        $datas = Task::with('category')->get();
        return Excel::download(new DataExport($datas), 'exportTask.xlsx');
    }
}
