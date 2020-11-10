<?php

namespace App\Repositories\Event;

interface EventRepositoryInterface {
    public function getAllEvents();
    public function getEventById($id);
    public function createEvent($data);
    public function updateEvent($data);
    public function deleteEventById($id);
}