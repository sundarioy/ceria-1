<?php
namespace App\Services;

use App\Repositories\Teacher\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherService {
    protected $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function getAllTeachers() {
        return $this->teacherRepository->getAllTeachers();
    }

    public function getTeacherById($id) {
        return $this->teacherRepository->getTeacherById($id);
    }

    public function createTeacher(Request $request) {
        return $this->teacherRepository->createTeacher($request);
    }

    public function updateTeacher(Request $request) {
        return $this->teacherRepository->updateTeacher($request);
    }

    public function deleteTeacherById($id) {
        return $this->teacherRepository->deleteTeacherById($id);
    }
}