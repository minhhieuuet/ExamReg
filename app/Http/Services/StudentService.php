<?php

namespace App\Http\Services;

use App\Models\Student;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StudentService
{
    public function getStudents($params)
    {
        $limit = array_get($params, 'limit', 10);
        return Student::when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('username', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function storeStudent($params)
    {
        $student = Student::create([
            'name' => array_get($params, 'name'),
            'username' => array_get($params, 'username'),
            'email' => array_get($params, 'email'),
            'password' => bcrypt(array_get($params, 'password')),
        ]);

        return $this->getOneStudent($student);
    }

    public function updateStudent(Student $student, $params)
    {
        $student->update([
          'name' => array_get($params, 'name'),
          'username' => array_get($params, 'username'),
          'email' => array_get($params, 'email'),
        ]);
        if(array_get($params, 'password')) {
          $student->update(['password' => bcrypt(array_get($params, 'password'))]);
        }
        return $student;
    }

    public function getOneStudent(Student $student)
    {
        $student->makeHidden('password');
        return $student;
    }

    public function deleteOneStudent(Student $student)
    {
        $student->delete();

        return 'ok';
    }

    public function deleteManyStudent($params)
    {
        $studentIds = array_get($params, 'ids', []);
        if (count($studentIds) > 0) {
            Student::whereIn('id', $studentIds)->delete();
        }
        return 'ok';
    }
}
