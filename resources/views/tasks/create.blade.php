@extends('layouts.main')

    @section('title','Create Task')

        @section('content')

        <div class="row">
        
            {!! Form::open(['route'=>'task.store','method'=>'POST']) !!}

            @component('components.taskform')
            @endcomponent

            {!! Form::close() !!}   
        
        
        </div>



    @endsection