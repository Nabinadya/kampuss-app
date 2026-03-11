<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
     public function index(): \Illuminate\Contracts\View\View
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
        //
    }

    public function create()
    {
        return view('tasks.create');            
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'deadline_time' => 'required|string|max:5',
            'nama_tugas' => 'required|string|max:255',
            'deadline' => 'required|date',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
        ]);
        Task::create($request->all());
        return redirect()->route('tasks.index');
        //
    }

   
    public function show($id)
    {

        //
    }


    public function edit($id): \Illuminate\Contracts\View\View
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
        //
    }

    
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $task = Task::findOrFail($id);
        $task->update([
            'nama_tugas' => $request->nama_tugas,
            'deadline' => $request->deadline,
            'prioritas' => $request->prioritas,
            'deadline_time' => $request->deadline_time,
        ]);
        return redirect()->route('tasks.index');
        //
    }

       public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index');
        //
    }
}
