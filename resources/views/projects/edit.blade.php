@extends('layouts.app')

@section('content')
	<div class="flex justify-center">
		<div class="w-1/2 items-center m-8 p-8 bg-white rounded-lg shadow-lg">
            <div class="flex justify-center">
                <h1 class="text-blue-500 text-lg font-bold mb-4">Edit your project</h1>
            </div>

            <form method="POST" action="{{ $project->path() }}">
                @method('PATCH')

			    @include('projects._form')
            </form>
		</div>
	</div>	
@endsection