<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index() {
		$attendances = $this->attendanceService->getAllAttendance();
		return response([
			'success' => true,
			'message' => 'List attendances',
			'data' => $attendances
		],200);
	}

    public function store(Request $request) {
		$attendance = $this->attendanceService->createAttendance($request);

		if ($attendance) {
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
    	$attendance = $this->attendanceService->getAttendanceById($id);

    	if($attendance) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Attendance',
    			'data' => $attendance
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Attendance with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$attendance = $this->attendanceService->updateAttendance($request);

		if ($attendance) {
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
		$attendance = $this->attendanceService->deleteAttendanceById($id);
		
    	if ($attendance) {
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
