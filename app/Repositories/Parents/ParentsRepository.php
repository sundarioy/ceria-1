<?php
namespace App\Repositories\Parents;

use App\Models\Parents;
use App\Repositories\Parents\ParentsRepositoryInterface;

class ParentsRepository implements ParentsRepositoryInterface {
    
    public function getAllParents()
    {
        return Parents::all();
    }

    public function getParentById($id)
    {
        return Parents::find($id);
    }

    public function createParent($data)
    {
        return Parents::create([
			'nik' => $data->nik,
			'username' => $data->username,
			'password' => $data->password,
			'nama' => $data->nama
		]);
    }

    public function updateParent($data)
    {
        return Parents::find($data->nik)->update([
			'nik' => $data->nik,
			'username' => $data->username,
			'password' => $data->password,
			'nama' => $data->nama
		]);
    }

    public function deleteParentById($id)
    {
        $parent = Parents::find($id);
        $parent->delete();
        return $parent;
    }
}