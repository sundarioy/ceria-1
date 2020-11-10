<?php

namespace App\Repositories\Grade;

interface GradeRepositoryInterface {
    public function getAllGrade();
    public function getGradeById($id);
    public function createGrade($data);
    public function updateGrade($data);
    public function deleteGradeById($id);
}