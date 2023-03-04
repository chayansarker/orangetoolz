@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tasks') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('todos.tasks.store', [$todo]) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <p class="form-control-plaintext">{{ $todo->name }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                           class="form-control @error('description') is-invalid @enderror" name="description"
                                             required autofocus>{{ old('description') }}</textarea>

                                    @include('shared.errors.validation', ['name' => 'description'])
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @isset($tasks)
                                @forelse($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($task->description, 20) }}</td>
                                        <td>{{ $todo->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('todos.tasks.show', [$todo, $task]) }}">View</a>
                                            <a class="btn btn-secondary"
                                               href="{{ route('todos.tasks.edit', [$todo, $task]) }}">Edit</a>
                                            <a class="btn btn-danger"
                                               href="{{ route('todos.tasks.destroy', [$todo, $task]) }}"
                                               onclick="return destroy(event, {{ $task->id }})"
                                            >Delete</a>

                                            <form id="delete-form-{{ $task->id }}"
                                                  action="{{ route('todos.tasks.destroy', [$todo, $task]) }}"
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="alert alert-info" role="alert">
                                                No record found!
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @endisset
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        @isset($tasks)
                            {{ $tasks->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function destroy(e, taskId) {
            e.preventDefault();
            if (confirm('Do you want to delete this ?')) {
                document.getElementById('delete-form-' + taskId).submit();
            }
        }
    </script>
@endpush
