@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-4 pb-4">
        <div class="flex justify-between w-full items-end">
            <h2 class="text-gray-400 text-sm font-normal">My Projects</h2>
            <a href={{ route('projects.create') }} class="py-2 px-4 bg-blue-500 text-white font-normal rounded-lg shadow-md hover:bg-blue-700 
            focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Create a new Project
            </a>
        </div>  
    </div>

    <div class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>
                No projects yet.
            </div>     
        @endforelse
    </div>
@endsection