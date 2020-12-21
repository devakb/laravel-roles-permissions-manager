@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Add/Edit User Photo') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.photo.update',[$user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row align-items-center">
                    <label for="photo" class="required col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                    <div class="col-md-6">
                        <input id="photo" type="file" class="dropify" name="photo">

                        @error('photo')
                            <span class="invalid-feedback d-inline-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Upload') }}
                        </button>
                    </div>
                </div>
            </form>


                @if($user->photo != null)
                    <form action="{{ route('admin.users.photo.delete',[$user->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            {{ __('Remove Photo') }}
                        </button>
                    </form>
                @endif

        </div>
    </div>

@endsection
