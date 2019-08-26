
@extends('layouts.main')


@section('title','Tasks Home')

@section('content')
    <style>
        .btn-primary {
    display: flex;
    flex-direction: row;
    width: 100%;
    justify-content: center;
        }
    </style>

    <div class="row justify-content-center mb-3">

        <a href="{{route('task.create')}}" class="btn btn-primary"> Create Task</a>

    </div>

@if($tasks->count()==0)

    <p>No task to do</p>
    
    @else

    @foreach($tasks as $task)

    <div class="row">
        <div class="col-sm-12"> 
        <h3>
            {{$task->name}}
            <small>{{$task->created_at}}</small>
        </h3>
        <p>{{$task->description}}</p>

        <h4>To do Date: <small> {{$task->todo_date}} </small></h4>
        <?php

        $date = new Carbon\Carbon;
        $datetime1 = strtotime($date);
        $datetime2 = strtotime($task->todo_date);
        $secs = $datetime2 - $datetime1;
        $days = $secs / 86400;
        if($days<0){
                echo 'ты пропустил задачу';
        } else{    
            echo 'Days left: ' . ceil($days);
        }


        ?>
        {!! Form::open(['route'=>['task.destroy',$task->id],'method'=>'DELETE']) !!}

        <a href="{{route('task.edit',$task->id)}}" class="btn btn-info"> Edit </a>
        <a href="{{route('task.show',$task->id)}}" class="btn btn-light"> Show </a>

        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}

    
        </div>
    </div>
    <hr>


    @endforeach 

@endif
 <div class="row justify-content-center">
    <div class="col-sm-6 text-center">
        {{ $tasks->links() }}
    </div>
 </div>

@endsection 