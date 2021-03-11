@extends('layouts.app')

@section('content')
	<div class="flex justify-center">
		<div class="w-1/2 items-center m-8 p-8 bg-white rounded-lg shadow-lg">
			<div class="flex justify-center">
                <h1 class="text-blue-500 text-lg font-bold mb-4">Let's create something new</h1>
            </div>

			<form method="POST" action="{{ route('projects') }}">
				@include('projects._form', ['project' => new App\Models\Project])
			</form>
		</div>
	</div>	
@endsection
