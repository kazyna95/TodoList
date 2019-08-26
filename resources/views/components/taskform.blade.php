{{ Form::label('name','Task Name', ['class' => 'control-label']) }}
{{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Task Name']) }}

{{ Form::label('description', 'Task Description', ['class' => 'control-label mt-3']) }}
{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Task Description']) }}

{{ Form::label('todo_date', 'To Do Date', ['class' => 'control-label mt-3']) }}
{{ Form::date('todo_date', null, ['class' => 'form-control']) }}


<div class="row justify-content-center mb-3">
    <div class="col-sm-4">
        <a href="{{ route('task.index') }}" class="btn btn-danger"> Go Back </a>
    </div>
<div class="row justify-content-center mb-3">
    <div class="col-sm-4">
        <button class="btn btn-primary" type="submit">Save Task</button>
        
    </div>
</div>