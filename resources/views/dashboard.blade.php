<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
      {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in!") }}
        </div>
      </div> --}}


      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <div class="space-y-2">
              <div>
                <label for="" class="text-sm font-bold">
                  Title
                </label>
                <input type="text" name="title" class="w-full border-gray-300 rounded-md"
                  placeholder="Add a new task">
              </div>
              <div>
                <label for="" class="text-sm font-bold">
                  Description
                </label>
                <textarea name="description" id="" cols="30" rows="5" class="w-full border-gray-300 rounded-md "
                  placeholder="Add a description (optional)"></textarea>
              </div>
              <div class="text-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add</button>
              </div>
            </div>  
            @error('title')
              <div class="text-red-500 text-sm mt-1 font-bold ">{{ $message }}</div>
            @enderror
          </form>
        </div>
        <hr>
        <div class="p-6 text-gray-900">
          <h4 class="text-xl font-bold mb-2">To-Do List ({{ count($toDos) }})</h4>
          <ul class="space-y-4 ms-4 mt-4">
            @forelse ($toDos as $todo)
              <li class="flex justify-between">
                <div class="flex gap-2">
                  <input id="toDo{{ $todo->id }}" type="checkbox"
                    class="border-gray-300 rounded-md disabled:opacity-50 checked:bg-green-500 mt-1  hover:bg-blue-500 hover:checked:bg-green-400 translation ease-in-out duration-300"
                    @if ($todo->isCompleted()) checked @endif
                    onclick="event.preventDefault(); document.getElementById('form-complete-{{ $todo->id }}').submit()">
                  <form id="form-complete-{{ $todo->id }}" action="{{ route('todos.complete', $todo->id) }}"
                    method="POST" class="hidden">
                    @csrf
                    @method('PUT')
                  </form>
                  <label for="toDo{{ $todo->id }}"
                    class="ml-1 max-w-3xl @if ($todo->isCompleted()) line-through italic @endif">
                    <span class="font-medium">{{ $todo->title }}</span>
                    <p class="text-sm text-gray-500">
                      {!! $todo->description !!}
                    </p>
                  </label>
                </div>
                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class=" text-red-500 px-4 py-2 rounded-md hover:underline font-bold">Delete</button>
                </form>
              </li>
            @empty
              <li>No tasks yet</li>
            @endforelse
          </ul>
        </div>
        <hr>
        <div class="p-6 text-sm text-gray-500">
          <strong>Note:</strong> Completed tasks are automatically moved to the bottom of the list.
        </div>
      </div>

    </div>
  </div>

</x-app-layout>
