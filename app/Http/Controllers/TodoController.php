<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Mockery\Exception;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::where('parent_id', null)->get();
        foreach ($todos as $todo){
            $todo->subtasks = Todo::where('parent_id', $todo->_id)->get();
        }
        return $todos;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->task = $request->task;
        $id =Todo::create([
            'task' => $request->task,
            'user_id' => 1,
            'completed' => false
        ])->_id;

      if($request->subtasks){
          foreach ($request->subtasks as $subtask){
              Todo::create([
                  'task' => $subtask,
                  'parent_id' => $id,
                  'completed' => false
              ]);
          }
      }
        return response()->json([
            'message' => 'Todo created successfully',
            'id' => $id
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Todo::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->completed = $request->completed;
        $todo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Todo::destroy($id);
    }


    public function deleteMant(Request $request){
        $ids = $request->ids;
        dd($ids)
        // Todo::whereIn('_id', $ids)->delete();



    }
}
