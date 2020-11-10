<?php
namespace App\Services;

use App\Repositories\Parents\ParentsRepositoryInterface;
use Illuminate\Http\Request;

class ParentsService {
    
    protected $parentsRepository;

    public function __construct(ParentsRepositoryInterface $parentsRepository)
    {
        $this->parentsRepository = $parentsRepository;
    }

    public function getAllParents() {
        return $this->parentsRepository->getAllParents();
    }

    public function getParentById($id) {
        return $this->parentsRepository->getParentById($id);
    }

    public function createParent(Request $request) {
        return $this->parentsRepository->createParent($request);
    }

    public function updateParent(Request $request) {
        return $this->parentsRepository->updateParent($request);
    }

    public function deleteParentById($id) {
        return $this->parentsRepository->deleteParentById($id);
    }
}