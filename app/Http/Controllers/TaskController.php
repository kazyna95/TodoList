<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Task;
use Telegram\Bot\Laravel\Facades\Telegram;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $task=Task::all();

        foreach($task as $test){
        $date = new Carbon();
        $datetime1 = strtotime($date);
        $datetime2 = strtotime($test->todo_date);
        $secs = $datetime2 - $datetime1;
        $days = $secs / 86400;
        if($days<1){
            $test1="$test->name\n"
            ."$test->description\n";

            Telegram::sendMessage([
                'chat_id'=>env('TELEGRAM_CHANNEL_ID','-1001342791467'),
                'parse_mode'=>'HTML',
                'text'=>$test1
            ]);

        }
    } 
        $task=Task::orderBy('todo_date','asc')->paginate(5);
        return view('tasks.index')->with('tasks', $task);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255|min:3',
            'description'=>'required|string|max:1000|min:10',
            'todo_date'=>'required|date',
            ]);

            $task= new Task;

            $task->name=$request->name;
            $task->description=$request->description;
            $task->todo_date=$request->todo_date;
            
            $task->save();

            Session::flash('success','Task Successully Craeted');

            return redirect()->route('task.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $task=Task::find($id);
       return view('tasks.edit')->with('task', $task);

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
        
        $this->validate($request,[
            'name'=>'required|string|max:255|min:3',
            'description'=>'required|string|max:1000|min:10',
            'todo_date'=>'required|date',
            ]);
    
            $task=Task::find($id);
    
                $task->name=$request->name;
                $task->description=$request->description;
                $task->todo_date=$request->todo_date;
                
                $task->save();
    
                Session::flash('success','Craeted Task Successully');
    
            return redirect()->route('task.index');
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task= Task::findOrFail($id);
        $task->delete();
        Session::flash('success','Deleted!');
       return back(); //redirect()->('task.index')
    }
}
