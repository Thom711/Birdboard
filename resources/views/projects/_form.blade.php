@csrf

<div class="mb-4">
    <label for="title">Title</label>

    <div>
        <input type="text" class="rounded-md shadow-md w-full" name="title" placeholder="Title" value="{{ $project->title }}" required>
    </div>
</div>

<div class="mb-4">
    <label for="description">Description</label>

    <div>
        <textarea name="description" class="rounded-md shadow-md w-full text-sm" placeholder="Description goes here" required>{{ $project->description }}</textarea>
    </div>			
</div>

<div class="mb-4">
    <div class="flex items-center">
        <button type="submit" class="btn-blue mr-4">{{ isset($project->id) ? 'Update ' : 'Create ' }}Project</button>

        <a href={{ isset($project->id) ? $project->path() : route('projects') }}><button class="btn-blue bg-gray-400">Cancel</button></a>
    </div>				
</div>

@if($errors->any())
    <div class="mb-4 mt-4">
        @foreach($errors->all() as $error)
            <li class="text-red-500 text-sm">{{ $error }}</li>
        @endforeach
    </div>
@endif