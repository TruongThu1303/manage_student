<?php

namespace App\Repositories;

interface StudentsRepositoryInterface
{
    public function getAllStudents();

    public function getStudentById($id);

    public function createStudent(array $data);

    public function updateStudent($id, array $data);

    public function deleteStudent($id);
}
