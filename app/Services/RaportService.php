<?php
namespace App\Services;

use App\Repositories\Raport\RaportRepositoryInterface;
use Illuminate\Http\Request;

class RaportService {
    protected $raportRepository;

    public function __construct(RaportRepositoryInterface $raportRepository)
    {
        $this->raportRepository = $raportRepository;
    }

    public function getAllRaports() {
        return $this->raportRepository->getAllRaport();
    }

    public function getRaportById($id) {
        return $this->raportRepository->getRaportById($id);
    }

    public function createRaport(Request $request) {
        return $this->raportRepository->createRaport($request);
    }

    public function updateRaport(Request $request) {
        return $this->raportRepository->updateRaport($request);
    }

    public function deleteRaportById($id) {
        return $this->raportRepository->deleteRaportById($id);
    }
}
