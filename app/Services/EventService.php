<?php
namespace App\Services;

use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Http\Request;

class EventService {

    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents() {
        return $this->eventRepository->getAllEvents();
    }

    public function getEventById($id) {
        return $this->eventRepository->getEventById($id);
    }

    public function createEvent(Request $request) {
        return $this->eventRepository->createEvent($request);
    }

    public function updateEvent(Request $request) {
        return $this->eventRepository->updateEvent($request);
    }

    public function deleteEventById($id) {
        return $this->eventRepository->deleteEventById($id);
    }
}