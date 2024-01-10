<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    
    public function index (Request $request) {
        if (session()->has('email')) {
            $email = session()->get('email');

            $user = User::where('email', $email)->first();

            if ($user) {
                $username = $user->name;
            } else {
                return redirect('/login');
            }
    
            $userId = Auth::id();

            $tasks = DB::table('tasks')->where('user_id', $userId);

            $search = $request->input('search');
            if ($search) {
                $tasks->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }
            
            $tasks = $tasks->get();

            return view('tasks', [
                'username' => $username,
                'tasks' => $tasks,
            ]); 
        }
            
        return redirect('/login');
    }

    public function add_task () {
        if (session()->has('email')) {
            $email = session()->get('email');

            $user = User::where('email', $email)->first();

            if ($user) {
                $username = $user->name;
            } else {
                return redirect('/login');
            }
    
            return view('add_task', [
                'username' => $username,
            ]);
        }
        
        return redirect('/login');
    }

    public function create_task (Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority_level' => 'required|string'
        ]);

        $userId = Auth::id();

        DB::table('tasks')->insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'priority_level' => $request->input('priority_level'),
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/')->with('task_created', 'Task created successfully!');
    }

    public function view_task ($taskId) {
        if (session()->has('email')) {
            $email = session()->get('email');

            $user = User::where('email', $email)->first();

            if ($user) {
                $username = $user->name;
            } else {
                return redirect('/login');
            }
            
            $task = DB::table('tasks')->where('id', $taskId)->first();
        
            if (!$task) {
                abort(404);
            }
        
            return view('view_task', [
                'username' => $username,
                'task' => $task
            ]);
        }
        return redirect('/login');
    }

    public function edit_task ($taskId) {
        $email = session()->get('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            $username = $user->name;
        } else {
            return redirect('/login');
        }

        $task = DB::table('tasks')->where('id', $taskId)->first();

        if (!$task) {
            abort(404);
        }

        return view('edit_task', [
            'username' => $username,
            'task' => $task
        ]);
    }

    public function update_task (Request $request, $taskId) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority_level' => 'required|string'
        ]);

        DB::table('tasks')->where('id', $taskId)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'priority_level' => $request->input('priority_level'),
            'updated_at' => now(),
        ]);

        return redirect()->route('view_task', ['taskId' => $taskId])->with('task_updated', 'Task updated successfully!');
    }

    public function destroy ($taskId) {
        $task = DB::table('tasks')->where('id', $taskId)->first();

        if (!$task) {
            abort(404);
        }

        DB::table('tasks')->where('id', $taskId)->delete();

        return redirect('/')->with('task_deleted', 'Task deleted successfully!');
    }


}
