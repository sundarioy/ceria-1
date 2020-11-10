<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BulletinService;

class BulletinController extends Controller
{
    protected $bulletinService;

    public function __construct(BulletinService $bulletinService)
    {
        $this->bulletinService = $bulletinService;
    }

    public function index() {
		$bulletin = $this->bulletinService->getAllBulletin();
		return response([
			'success' => true,
			'message' => 'List bulletin',
			'data' => $bulletin
		],200);
	}

    public function store(Request $request) {
		$bulletin = $this->bulletinService->createBulletin($request);

		if ($bulletin) {
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
    	$bulletin = $this->bulletinService->getBulletinById($id);

    	if($bulletin) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Bulletin',
    			'data' => $bulletin
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Bulletin with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$bulletin = $this->bulletinService->updateBulletin($request);

		if ($bulletin) {
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
		$bulletin = $this->bulletinService->deleteBulletinById($id);
		
    	if ($bulletin) {
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
