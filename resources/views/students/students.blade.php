@extends('index')
@section('content')

    @if(session('deleteSuccess'))
        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show">
            <h6 class="alert alert-success">
                {{ session('deleteSuccess') }}
            </h6>
        </div>
    @endif
<div class="flex justify-between">
   <div>
       <a href="{{route('students.create')}}" class="border-2 rounded-lg px-2 py-1 bg-blue-400 border-blue-400">{{ trans('message.students.create_button')}}</a>
   </div>
  <div>
      @if(session('Success'))
          <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show">
              <h6 class="alert alert-success">
                  {{ session('Success') }}
              </h6>
          </div>
      @endif
          @if(session('Fail'))
              <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show">
                  <h6 class="alert alert-danger ">
                      {{ session('Fail') }}
                  </h6>
              </div>
          @endif
  </div>
</div>
<table class="table mx-auto mt-10">

    <thead  >
    <tr>
        <th scope="col">ID</th>
        <th scope="col">{{ trans('message.students.fullname') }}</th>
        <th scope="col">{{ trans('message.students.masv') }}</th>
        <th scope="col">{{ trans('message.students.email') }}</th>
        <th scope="col">{{ trans('message.students.phone') }}</th>
        <th scope="col">{{ trans('message.students.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($students as $student)
    <tr>
        <td>{{ $student->id}}</td>
        <td>{{ $student->fullname}}</td>
        <td>{{ $student->masv}}</td>
        <td>{{ $student->email}}</td>
        <td>{{ $student->phone}}</td>
        <td class="flex gap-x-2">
            <a href="{{route('students.edit', $student->id)}}" class="border-2 rounded-lg px-2 py-1 bg-green-500 border-green-500">{{ trans('message.students.edit_button') }}</a>
            <form method="POST" action="{{ route('students.destroy', $student->id) }}">
                @csrf
                @method('DELETE')
                <button class="border-2 rounded-lg px-2 py-1 bg-red-500 border-red-500" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa đại lý này không?')" >{{ trans('message.students.delete_button') }}</button>
            </form>
            <a href="{{ route('students.show', $student->id) }}" class="border-2 rounded-lg px-2 py-1 bg-yellow-500 border-yellow-500">{{ trans('message.students.detail_button') }}</a>
        </td>

    </tr>
    @endforeach
    </tbody>
</table>
{{ $students->links() }}
@endsection
