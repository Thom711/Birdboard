@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-4 pb-4">
        <div class="flex justify-between w-full items-end">
            <h2 class="text-gray-400 text-sm font-normal">
                <a href={{ route('projects')}}>My Projects</a> / {{ $project->title }}
            </h2>
            <a href={{ $project->path() . '/edit' }} class="btn-blue">
                Edit Project
            </a>
        </div>  
    </div>

    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3">
            <div class="mb-8">
                <h2 class="text-gray-400 font-normal text-lg mb-3">Tasks</h2>
                
                @foreach($project->tasks as $task)
                    <div class="bg-white rounded-lg shadow-lg p-5 mb-3">
                        <form action="{{$task->path()}}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <div class="flex items-center">
                                <input value="{{ $task->body }}" name="body" class="w-full
                                {{ $task->completed ? 'text-gray-500' : '' }}">
                                <input name="completed" type="checkbox" class="rounded-sm" onChange="this.form.submit()"
                                {{ $task->completed ? 'checked' : '' }}>
                            </div>
                        </form>
                    </div>

                @endforeach

                <div class="bg-white rounded-lg shadow-lg p-5 mb-3">
                    <form action="{{ $project->path() . '/tasks'}}" method="POST">
                        @csrf

                        <input placeholder="Add a new task" type="text" class="w-full border-none" name="body">
                    </form>   
                </div>
            </div>

            <div>
                <h2 class="text-gray-400 font-normal text-lg mb-3">General Notes</h2>

                <form action="{{ $project->path()}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <textarea class="bg-white rounded-lg shadow-lg p-5 w-full border-none" name="notes"
                    style="min-height: 150px;" placeholder="Keep your notes here">{{ $project->notes }}</textarea>

                    <button type="submit" class="btn-blue">Save</button>
                </form>
            </div>   
        </div>

        <div class="lg:w-1/4 px-3">
            @include('projects.card')  
        </div>
    </div>
@endsection