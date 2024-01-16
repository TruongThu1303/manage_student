<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Repositories\Eloquent\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class Student extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $perPage = 10;
        $students = DB::table('students_update')->paginate($perPage);
        $tittle = Lang::get('message.students.list');
        return view('students.students', compact('students', 'tittle'));
    }

    public function create()
    {
        $tittle = Lang::get('message.students.create');
        return view('students.create_student', compact('tittle'));
    }

    public function store(StudentRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->only(['fullname', 'image', 'masv', 'email', 'phone']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/image');
        }
        $dataInsert = [
            'fullname' => $data['fullname']
            , 'image' => $data['image']
            , 'masv' => $data['masv']
            , 'email' => $data['email']
            , 'phone' => $data['phone']
        ];
        $this->studentRepository->createStudent($dataInsert);
        return redirect()->route('students.index')->with('Success', 'Tạo thành công.');
    }

    public function show($id)
    {
        $student = $this->studentRepository->getStudentById($id);
        $title = Lang::get('message.students.detail');
        return view('students.detail_student', compact('student'), ['tittle' => $title]);
    }

    public function edit($id)
    {
        $student = $this->studentRepository->getStudentById($id);
        if (!$student) {
            return view('notfound');
        } else
            $title = Lang::get('message.students.edit');
        return view('students.update_student', compact('student'), ['tittle' => $title]);
    }

    public function update(StudentRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $data = $request->only(['fullname', 'image', 'masv', 'email', 'phone']);
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('public/images');
        }
        $dataUpdate =[
            'fullname' => $data['fullname']
            , 'image' => $data['image']
            , 'masv' => $data['masv']
            , 'email' => $data['email']
            , 'phone' => $data['phone']
        ];
        $this->studentRepository->updateStudent($id, $dataUpdate);
        $student = $this->studentRepository->getStudentById($id);
        if (!$student) {
            return redirect()->route('students.index')->with('Fail', 'Sinh viên không tồn tại.');
        } else {
            return redirect()->route('students.index')->with('Success', 'Cập nhật thành công.');
        }
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->studentRepository->deleteStudent($id);
        return redirect()->route('students.index')->with('Success', 'Xóa thành công.');
    }
}
