@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('To-do list') }}</div>

                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <p class="form-control-plaintext">{{ $todo->name }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="created_at" class="col-md-4 col-form-label text-md-end">{{ __('Created at') }}</label>

                                <div class="col-md-6">
                                    <p class="form-control-plaintext">{{ $todo->created_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">{{ __('User') }}</label>

                                <div class="col-md-6">
                                    <p class="form-control-plaintext">{{ $todo->user->full_name }}</p>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
