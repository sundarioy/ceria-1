<?php

namespace App\Repositories\Bulletin;

interface BulletinRepositoryInterface {
    public function getAllBulletin();
    public function getBulletinById($id);
    public function createBulletin($data);
    public function updateBulletin($data);
    public function deleteBulletinById($id);
}