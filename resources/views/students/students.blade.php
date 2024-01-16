@extends('index')
<Style>
</Style>
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

    <thead>
        <tr>
            <th scope="col">{{ trans('message.students.id') }}</th>
            <th scope="col">{{ trans('message.students.fullname') }}</th>
            <th scope="col">{{ trans('message.students.image') }}</th>
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
            <td>
                @php
                $imageExtensions = ['png', 'jpeg', 'jpg'];
                $fileExtension = pathinfo($student->image, PATHINFO_EXTENSION);
                @endphp
                @if (in_array($fileExtension, $imageExtensions))
                <img src="{{ Storage::url($student->image) }}" alt="Avatar" width="150px">
                @endif
            </td>
            <td>{{ $student->masv}}</td>
            <td>{{ $student->email}}</td>
            <td>{{ $student->phone}}</td>
            <td class="flex gap-x-2">
                <a href="{{route('students.edit', $student->id)}}" class="border-2 rounded-lg px-2 py-1 bg-green-500 border-green-500 h-8">{{ trans('message.students.edit_button') }}</a>
                <form method="POST" action="{{ route('students.destroy', $student->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="border-2 rounded-lg px-2 py-1 bg-red-500 border-red-500" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa đại lý này không?')">{{ trans('message.students.delete_button') }}</button>
                </form>
                <a href="{{ route('students.show', $student->id) }}" class="border-2 rounded-lg px-2 py-1 bg-yellow-500 border-yellow-500 h-8">{{ trans('message.students.detail_button') }}</a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
<div class="Paginate" align="center">
{{ $students->links() }}
</div>
<!-- <div class="container">
    <span>
        <div class="index">1</div>
        <div class="index">2</div>
        <div class="index">3</div>
        <div class="index">4</div>
        <div class="index">5</div>
    </span>

    <svg viewBox="0 0 100 100">
        <path d="m 7.1428558,49.999998 c -1e-7,-23.669348 19.1877962,-42.8571447 42.8571442,-42.8571446 23.669347,0 42.857144,19.1877966 42.857144,42.8571446" />
    </svg>
    <svg viewBox="0 0 100 100">
        <path d="m 7.1428558,49.999998 c -1e-7,23.669347 19.1877962,42.857144 42.8571442,42.857144 23.669347,0 42.857144,-19.187797 42.857144,-42.857144" />
    </svg>
</div>


<script>
    const c = document.querySelector('.container')
    const indexs = Array.from(document.querySelectorAll('.index'))
    let cur = -1
    indexs.forEach((index, i) => {
        index.addEventListener('click', (e) => {
            // clear
            c.className = 'container'
            void c.offsetWidth; // Reflow
            c.classList.add('open')
            c.classList.add(`i${i + 1}`)
            if (cur > i) {
                c.classList.add('flip')
            }
            cur = i
        })
    })
</script> -->
@endsection