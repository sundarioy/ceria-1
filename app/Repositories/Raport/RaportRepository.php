<?php
namespace App\Repositories\Raport;

use App\Repositories\Raport\RaportRepositoryInterface;
use App\Models\Raport;

class RaportRepository implements RaportRepositoryInterface {
    public function getAllRaport()
    {
        return Raport::all();
    }

    public function getRaportById($id)
    {
        return Raport::find($id);
    }

    public function createRaport($data)
    {
        return Raport::create([
            'nilai' => $data->title,
            'date_created' => $data->id_tema,
            'nis' => $data->title,
            'id_tema' => $data->title,
            'id_subtema' => $data->title,
            'id_indicator' => $data->title
        ]);
    }

    public function updateRaport($data)
    {
        return Raport::find($data->id)->update([
            'nilai' => $data->title,
            'date_created' => $data->id_tema,
            'nis' => $data->title,
            'id_tema' => $data->title,
            'id_subtema' => $data->title,
            'id_indicator' => $data->title
        ]);
    }

    public function deleteRaportById($id)
    {
        return Raport::find($id)->delete();
    }
}
