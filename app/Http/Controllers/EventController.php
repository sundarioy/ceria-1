<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index() {
		$events = $this->eventService->getAllEvents();
		return response([
			'success' => true,
			'message' => 'List events',
			'data' => $events
		],200);
	}

    public function store(Request $request) {
		$event = $this->eventService->createEvent($request);

		if ($event) {
			return response()->json([
				'success' => true,
				'message' => 'Item berhasil disimpan',
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
		}
    }

    public function show($id) {
    	$event = $this->eventService->getEventById($id);

    	if($event) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Event',
    			'data' => $event
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Event with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$event = $this->eventService->updateEvent($request);

		if ($event) {
			return response()->json([
				'success' => true,
				'message' => 'Berhasil diupdate',
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Gagal diupdate',
			], 401);
		}
    }

    public function destroy($id) {
		$event = $this->eventService->deleteEventById($id);
		
    	if ($event) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Item berhasil dihapus',
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Item gagal dihapus',
    		], 401);
    	}
    }
}
