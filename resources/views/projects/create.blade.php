@extends('layouts.app')

@section('content')
	<form method="POST" action="{{ route('projects') }}">
		@csrf
		
		<h1 class="heading">Create a Project</h1>

		<div class="field">
			<label class="label" for="title">Title</label>

			<div class="control">
				<input type="text" class="input" name="title" placeholder="Title">
			</div>
		</div>

		<div class="field">
			<label class="label" for="description">Description</label>

			<div class="control">
				<textarea name="description" class="textarea"></textarea>
			</div>			
		</div>

		<div class="field">
			<div class="control">
				<button type="submit" class="button is-link">Create Project</button>

				
			</div>	

					
		</div>
	</form>

	<a href={{ route('projects') }}><button class="button is-link">Cancel</button></a>
@endsection