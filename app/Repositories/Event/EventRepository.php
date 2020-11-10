<?php
namespace App\Repositories\Event;

use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface {

    public function getAllEvents()
    {
        return Event::all();
    }

    public function getEventById($id)
    {
        return Event::find($id);
    }

    public function createEvent($data)
    {
        return Event::create([
            'name' => $data->name,
            'description' => $data->description,
            'location' => $data->location
        ]);
    }

    public function updateEvent($data)
    {
        return Event::find($data->id)->update([
            'name' => $data->name,
            'description' => $data->description,
            'location' => $data->location
        ]);
    }

    public function deleteEventById($id)
    {
        return $event = Event::find($id)->delete();
    }
}