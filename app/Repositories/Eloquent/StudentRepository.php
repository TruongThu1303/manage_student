<?php

namespace App\Repositories\Eloquent;

use App\Models\Students as ModelsStudents;
use App\Repositories\StudentsRepositoryInterface;

class StudentRepository implements StudentsRepositoryInterface
{
    protected   $student;
    public function __construct(ModelsStudents $student)
    {
        $this->student = $student;
    }

    public function getAllStudents()
    {
        return $this->student->all();
    }

    public function getStudentById($id)
    {
        return $this->student->findStudentById($id);
    }

    public function createStudent($data)
    {
        return $this->student->createStudent($data);
    }

    public function updateStudent($id, $data)
    {
        $student = $this->student->findStudentById($id);
        if (!$student) {
            return false; 
        }
        return $student->updateStudent($data);
    }

    public function deleteStudent($id)
    {
        $student = $this->student->findStudentById($id);
        if (!$student) {
            return false; 
        }
        return $student->deleteStudent();
    }
}
