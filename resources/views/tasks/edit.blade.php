@extends('layouts.main')

    @section('title','Edit Task')

        @section('content')

        <div class="row">
           
            <h1>Edit task</h1>
           
            {!! Form::model($task,['route'=>['task.update',$task->id],'method'=>'PUT']) !!}

            @component('components.taskform')
            @endcomponent 

            {!! Form::close() !!}
        
        
        </div>


    @endsection