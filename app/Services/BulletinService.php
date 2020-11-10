<?php
namespace App\Services;

use App\Repositories\Bulletin\BulletinRepositoryInterface;
use Illuminate\Http\Request;

class BulletinService {

    protected $bulletinRepository;

    public function __construct(BulletinRepositoryInterface $bulletinRepository)
    {
        $this->bulletinRepository = $bulletinRepository;
    }

    public function getAllBulletin() {
        return $this->bulletinRepository->getAllBulletin();
    }

    public function getBulletinById($id) {
        return $this->bulletinRepository->getBulletinById($id);
    }

    public function createBulletin(Request $request) {
        return $this->bulletinRepository->createBulletin($request);
    }
    
    public function updateBulletin(Request $request) {
        return $this->bulletinRepository->updateBulletin($request);
    }

    public function deleteBulletinById($id) {
        return $this->bulletinRepository->deleteBulletinById($id);
    }
}