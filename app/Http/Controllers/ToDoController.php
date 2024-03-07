<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'default:pending|in:pending,completed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $toDo = auth()->user()->todos()->create($validator->validated());

        return redirect()->back()->with('success', 'To-Do created successfully');
    }

    public function destroy(string $id)
    {
        $toDo = ToDo::findOrFail($id);

        $toDo->delete();

        return redirect()->back()->with('success', 'To-Do deleted successfully');
    }

    public function complete(string $id)
    {
        $toDo = ToDo::findOrFail($id);

        $toDo->status = $toDo->status === 'completed' ? 'pending' : 'completed';
        
        $toDo->save();

        return redirect()->back()->with('success', 'To-Do completed successfully');
    }
}
