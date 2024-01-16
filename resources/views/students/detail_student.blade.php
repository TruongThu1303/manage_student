@extends('index')
@section('content')
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
          @php
                $imageExtensions = ['png', 'jpeg', 'jpg'];
                $fileExtension = pathinfo($student->image, PATHINFO_EXTENSION);
                @endphp
                @if (in_array($fileExtension, $imageExtensions))
                <img class="profile_img" src="{{ Storage::url($student->image) }}" alt="Avatar" width="150px">
                @endif  
          </div>
          <div class="card-body">
            <p class="mb-0"><strong class="pr-1">{{ trans('message.students.fullname') }}:</strong> {{ $student->fullname }}</p>
            <p class="mb-0"><strong class="pr-1">{{ trans('message.students.masv') }}:</strong>{{ $student->masv }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>{{ trans('message.students.general_information')}}</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">ID</th>
                <td width="2%">:</td>
                <td>{{ $student->id }}</td>
              </tr>
              <tr>
                <th width="30%">Email</th>
                <td width="2%">:</td>
                <td>{{ $student->email }}</td>
              </tr>
              <tr>
                <th width="30%">{{ trans('message.students.phone')}}</th>
                <td width="2%">:</td>
                <td>{{ $student->phone }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection