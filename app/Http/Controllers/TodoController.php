<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class TodoController extends Controller
{
    public function create(Request $request)
    {
        Todo::create([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard');
    }

    public function delete($id)
    {
        Todo::where('id', $id)->delete();

        return redirect()->route('dashboard');
    }

    public function complete($id)
    {
        $todo = Todo::find($id);
        if (is_null($todo)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $todo->done = true;
        $todo->save();

        return redirect()->route('dashboard');
    }
}
