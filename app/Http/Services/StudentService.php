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

    public function storeTestimonial($params)
    {
        $testimonial = Testimonial::create([
            'contact_id' => array_get($params, 'contact_id'),
            'text_en' => array_get($params, 'text_en'),
            'text_jp' => array_get($params, 'text_jp'),
            'priority' => array_get($params, 'priority'),
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return $this->getOneTestimonial($testimonial);
    }

    public function updateTestimonial(Testimonial $testimonial, $params)
    {
        $testimonial->update([
            'contact_id' => array_get($params, 'contact_id'),
            'text_en' => array_get($params, 'text_en'),
            'text_jp' => array_get($params, 'text_jp'),
            'priority' => array_get($params, 'priority'),
            'created_at' => array_get($params, 'created_at'),
        ]);

        return $testimonial;
    }

    public function getOneTestimonial(Testimonial $testimonial)
    {
        return $testimonial;
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
