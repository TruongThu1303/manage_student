@extends('index')
@section('content')
<form  method="POST" action="{{route('students.store')}}" >
    @csrf
    <fieldset>
        <div class="mb-3">
            <label for="fullname" class="form-label">{{ trans('message.students.fullname') }}</label>
            <input type="text" id="fullname" class="form-control @error('fullname') is-invalid @enderror" name="fullname" placeholder="{{ trans('message.students.fullname_input') }}" >
            @error('fullname')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="masv" class="form-label">{{ trans('message.students.masv') }}</label>
            <input type="text" id="masv" class="form-control @error('masv') is-invalid @enderror" name="masv" placeholder="{{ trans('message.students.masv_input') }}" >
            @error('masv')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ trans('message.students.email') }}</label>
            <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ trans('message.students.email_input') }}" >
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">{{ trans('message.students.phone') }}</label>
            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="{{ trans('message.students.phone_input') }}" >
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary bg-blue-500">{{ trans('message.students.create_button') }}</button>
    </fieldset>
</form>
@endsection
