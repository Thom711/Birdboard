@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-4 pb-4">
        <div class="flex justify-between w-full items-end">
            <h2 class="text-gray-400 text-sm font-normal">
                <a href={{ route('projects')}}>My Projects</a> / {{ $project->title }}
            </h2>
            <a href={{ route('projects.create') }} class="py-2 px-4 bg-blue-500 text-white font-normal rounded-lg shadow-md hover:bg-blue-700 
            focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Create a new Project
            </a>
        </div>  
    </div>

    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3">
            <div class="mb-8">
                <h2 class="text-gray-400 font-normal text-lg mb-3">Tasks</h2>
                <div class="bg-white rounded-lg shadow-lg p-5 mb-3">
                    Lorem Ipsum
                </div>

                <div class="bg-white rounded-lg shadow-lg p-5 mb-3">
                    Lorem Ipsum
                </div>

                <div class="bg-white rounded-lg shadow-lg p-5 mb-3">
                    Lorem Ipsum
                </div>

                <div class="bg-white rounded-lg shadow-lg p-5">
                    Lorem Ipsum
                </div>
            </div>

            <div>
                <h2 class="text-gray-400 font-normal text-lg mb-3">General Notes</h2>

                <textarea class="bg-white rounded-lg shadow-lg p-5 w-full" style="min-height: 150px;">Lorem Ipsum</textarea>
            </div>   
        </div>

        <div class="lg:w-1/4 px-3">
            @include('projects.card')  
        </div>
    </div>
@endsection