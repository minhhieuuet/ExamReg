<?php

namespace App\Http\Services;
use Rap2hpoutre\FastExcel\FastExcel;
use App\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StudentService
{
    public function getStudents($params)
    {
        $limit = array_get($params, 'limit', 10);
        return User::where('role', 1)->when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('full_name', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function storeStudent($params)
    {
        $student = User::create([
            'full_name' => array_get($params, 'full_name'),
            'name' => array_get($params, 'name'),
            'email' => array_get($params, 'email'),
            'password' => bcrypt(array_get($params, 'password')),
            'role' => 1
        ]);

        return $this->getOneStudent($student);
    }

    public function updateStudent(User $student, $params)
    {
        $student->update([
          'full_name' => array_get($params, 'full_name'),
          'name' => array_get($params, 'name'),
          'email' => array_get($params, 'email'),
        ]);
        if(array_get($params, 'password')) {
          $student->update(['password' => bcrypt(array_get($params, 'password'))]);
        }
        return $student;
    }

    public function getOneStudent(User $student)
    {
        $student->makeHidden('password');
        return $student;
    }

    public function deleteOneStudent(User $student)
    {
        $student->delete();

        return 'ok';
    }

    public function deleteManyStudents($params)
    {
        $studentIds = array_get($params, 'ids', []);
        if (count($studentIds) > 0) {
            User::whereIn('id', $studentIds)->delete();
        }
        return 'ok';
    }

    public function importExel($request) {
      $file = $request->file('file');
      $rows = (new FastExcel)->import($file)->toArray();
      foreach($rows as $student) {
        $value = array_values($student);
        $username = preg_replace('/[^0-9]/', '', $value[1]);
        $password = preg_replace('/[\s]+/mu', ' ', $value[2]);
        $email = preg_replace('/[\s]+/mu', ' ', $value[3]);
        $full_name = preg_replace('/[\s]+/mu', ' ', $value[4]);
        
        User::updateOrCreate(['name'=> $username], [
          'name' => $username,
          'full_name' => $full_name,
          'password' => bcrypt($password),
          'email' => $email,
          'role' => 1
        ]);
      }
      return 'ok';
    }
}
