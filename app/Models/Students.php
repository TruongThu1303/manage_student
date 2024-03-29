<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students_update';
    protected $primaryKey = 'id'; 
    protected $fillable = ['id','fullname','image','masv','email','phone'];

    public static function findStudentById($id)
    {
        return static::find($id);
    }

    public static function createStudent($data)
    {
        return static::create($data);
    }

    public function updateStudent($data)
    {
        $this->update($data);
    }

    public function deleteStudent()
    {
        $this->delete();
    }


}
