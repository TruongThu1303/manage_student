<?php

namespace App\Http\Controllers;
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

    public function index() {
        $perPage = 10;
        $students = DB::table('students')->paginate($perPage);
        $tittle = Lang::get('message.students.list');
        return view('students.students', compact('students','tittle'));
    }

    public function create() {
        $tittle = Lang::get('message.students.create');
        return view('students.create_student', compact('tittle'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $rules = [
            'fullname' => 'required|string|max:255'
            ,'email' => 'required|string|max:255'
            ,'masv' => 'required|string|max:255'
            ,'phone' => 'required|string|max:20'
            
        ];

        $messages = [
            'fullname.required' => trans('validation.students.fullname_required')
            ,'fullname.string' => trans('validation.students.fullname_string')
            ,'fullname.max' => trans('validation.students.fullname_max')
            ,'email.required' => trans('validation.students.email_required')
            ,'email.string' => trans('validation.students.email_string')
            ,'email.max' => trans('validation.students.email_max')
            ,'masv.required' => trans('validation.students.masv_required')
            ,'masv.string' => trans('validation.students.masv_string')
            ,'masv.max' => trans('validation.students.masv_max')
            ,'phone.required' => trans('validation.students.phone_required')
            ,'phone.max' => trans('validation.students.phone_max')
        ];
        $validatedData = $request->validate($rules, $messages);
        $this->studentRepository->createStudent($validatedData);
        return redirect()->route('students.index')->with('Success', 'Tạo thành công.');
    }

    public function show($id) {
        $student = $this->studentRepository->getStudentById($id);
        $title = Lang::get('message.students.detail');
       return view('students.detail_student', compact('student'),['tittle' => $title]);
    }

    public function edit($id) {
        $student = $this->studentRepository->getStudentById($id);
       if(!$student){
           return view('notfound');
       }else
       $title = Lang::get('message.students.edit');
        return view('students.update_student', compact('student'),['tittle' => $title]);
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $rules = [
            'fullname' => 'required|string|max:255'
            ,'email' => 'required|string|max:255'
            ,'masv' => 'required|string|max:255'
            ,'phone' => 'required|string|max:20'
        ];
        $messages = [
            'fullname.required' => trans('validation.students.fullname_required')
            ,'fullname.string' => trans('validation.students.fullname_string')
            ,'fullname.max' => trans('validation.students.fullname_max')
            ,'email.required' => trans('validation.students.email_required')
            ,'email.string' => trans('validation.students.email_string')
            ,'email.max' => trans('validation.students.email_max')
            ,'masv.required' => trans('validation.students.masv_required')
            ,'masv.string' => trans('validation.students.masv_string')
            ,'masv.max' => trans('validation.students.masv_max')
            ,'phone.required' => trans('validation.students.phone_required')
            ,'phone.max' => trans('validation.students.phone_max')
        ];
        $validatedData = $request->validate($rules, $messages);
        $this->studentRepository->updateStudent($id,$validatedData);
        $student = $this->studentRepository->getStudentById($id);
        if(!$student){
            return redirect()->route('students.index')->with('Fail', 'Sinh viên không tồn tại.');
        }else{
            return redirect()->route('students.index')->with('Success', 'Cập nhật thành công.');
        }
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
{
    $this->studentRepository->deleteStudent($id);
    return redirect()->route('students.index')->with('Success', 'Xóa thành công.');
}

}
