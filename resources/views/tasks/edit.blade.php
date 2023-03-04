@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('todos.tasks.update', [$todo, $task]) }}">
                            @csrf
                            @method('put')

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror" name="description"
                                              required autofocus>{{ old('description') ?: $task->description }}</textarea>

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
                    </div>

                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
