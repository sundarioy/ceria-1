<?php

namespace App\Http\Controllers;

use App\Services\ChildService;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use App\Services\SubmissionService;

class SubmissionController extends Controller
{
	protected $submissionService;
	protected $childService;
	protected $documentService;

    public function __construct(
		SubmissionService $submissionService, 
		ChildService $childService, 
		DocumentService $documentService
	){
		$this->submissionService = $submissionService;
		$this->childService = $childService;
		$this->documentService = $documentService;
    }

    public function index() {
		$submission = $this->submissionService->getAllSubmissions();
		return response([
			'success' => true,
			'message' => 'List submission',
			'data' => $submission
		],200);
	}

    public function store(Request $request) {
		$submission = $this->submissionService->createSubmission($request);

		if ($submission) {
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
    	$submission = $this->submissionService->getSubmissionById($id);

    	if($submission) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Submission',
    			'data' => $submission
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Submission with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$submission = $this->submissionService->updateSubmission($request);

		if ($submission) {
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
		$submission = $this->submissionService->deleteSubmissionById($id);
		
    	if ($submission) {
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
	
	public function getCollectSubmission($id_assignment, $nip) {
		$data = array();
		$submissions = $this->submissionService->getSubmissionByAssigmentId($id_assignment);
		foreach($submissions as $submission) {
			$child = $this->childService->getChildById($submission->user_update);
			$document = $this->documentService->getDocumentSubmission($submission->id);
			$data[] = array(
				'id' => $submission->id,
				'nama' => $child->nama,
				'nis' => $child->nomor_induk,
				'date_created' => $submission->date_created,
				'grade' => $submission->grade,
				'file' => $document,
			);
		}

		return response()->json([
			'success' => true,
			'message' => 'Submission collected',
			'data' => $data
		], 200);
	}

	public function gradingSubmission(Request $request) {
		$grade = $this->submissionService->gradingSubmission($request);

		if($grade) {
			return response()->json([
				'success' => true,
				'message' => 'Submission graded',
			], 200);
		} else {
			return response()->json([
				'success' => true,
				'message' => 'Submission not graded',
			], 401);
		}
	}
}
