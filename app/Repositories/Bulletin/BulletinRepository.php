<?php
namespace App\Repositories\Bulletin;

use App\Models\Bulletin;
use App\Repositories\Bulletin\BulletinRepositoryInterface;

class BulletinRepository implements BulletinRepositoryInterface {

    public function getAllBulletin()
    {
        return Bulletin::all();
    }

    public function getBulletinById($id)
    {
        return Bulletin::find($id);
    }

    public function createBulletin($data)
    {
        return Bulletin::create([
            'update_date' => $data->update_date,            
            'title' => $data->title,
            'content' => $data->content,
            'user_update' => $data->user_update
        ]);
    }

    public function updateBulletin($data)
    {
        return Bulletin::find($data->id)->update([
            'update_date' => $data->update_date,            
            'title' => $data->title,
            'content' => $data->content,
            'user_update' => $data->user_update
        ]);
    }

    public function deleteBulletinById($id)
    {
        return Bulletin::find($id)->delete();
    }
}