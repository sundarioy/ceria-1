<?php

namespace App\Repositories\TemaIndicator;

interface TemaIndicatorRepositoryInterface {
    public function getAllTemaIndicator();
    public function getTemaIndicatorById($id);
    public function createTemaIndicator($data);
    public function updateTemaIndicator($data);
    public function deleteTemaIndicatorById($id);
}
