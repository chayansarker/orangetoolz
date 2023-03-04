@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('To-do list') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('todos.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @include('shared.errors.validation', ['name' => 'name'])
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
                            @isset($todos)
                                @forelse($todos as $todo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $todo->name }}</td>
                                        <td>{{ $todo->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('todos.show', [$todo]) }}">View</a>
                                            <a class="btn btn-secondary"
                                               href="{{ route('todos.edit', [$todo]) }}">Edit</a>
                                            <a class="btn btn-danger"
                                               href="{{ route('todos.destroy', [$todo]) }}"
                                               onclick="return destroy(event, {{ $todo->id }})"
                                            >Delete</a>

                                            <form id="delete-form-{{ $todo->id }}"
                                                  action="{{ route('todos.destroy', [$todo]) }}"
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <a class="btn btn-primary"
                                               href="{{ route('todos.tasks.index', [$todo]) }}">Tasks</a>
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
                        @isset($todos)
                            {{ $todos->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function destroy(e, todoId) {
            e.preventDefault();
            if (confirm('Do you want to delete this ?')) {
                document.getElementById('delete-form-' + todoId).submit();
            }
        }
    </script>
@endpush
