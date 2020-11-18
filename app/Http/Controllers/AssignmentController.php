<?php

namespace App\Http\Controllers;


use App\Models\Assignments;
use App\Models\Submissions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class AssignmentController extends Controller
{
	public function index() {

		$asmts = Assignments::all();
		return $asmts->toJson();

		// $asmts = Assignments::all();
		// return response([
		// 	'success' => true,
		// 	'message' => 'List Semua tugas',
		// 	'data' => $asmts
		// ], 200);
	}

	
	public function asmtCreate(Request $request) {

		$request['data'] = json_decode($request['data']);

		
		$fileName = $request->{'title'}.'_'.time().'.'.$request->file->getClientOriginalExtension();
		$path = "upload/assignments/".$request->{'title'};
		$request->file->move(public_path($path), $fileName);	
		

		$validatedData = $request->validate([
			'title' => 'required',
			'class' => 'required',
			'duedate' => 'required',
			'duetime' => 'required',
			
		]);

		$asmt = Assignments::create([
			'title' => $request->{'title'},
			'description' => $request->{'description'},
			'duedate' => $request->{'duedate'},
			'duetime' => $request->{'duetime'},
			'file' => $fileName,
			'teacher' => "Jane Waber",
			'class' => $request->{'class'},
		]);

		$msg = [
			'success' => true,
			'message' => 'Article created successfully!'
		];

		return response()->json($asmt);
	}

	public function asmtShow($id) {

		$asmts = Assignments::whereId($id)->first();

		if ($asmts) {
			// return response()->json([
			// 	'success' => true,
			// 	'message' => 'Detail tugas',
			// 	'data' => $asmts
			// ], 200);			
			return $asmts->toJson();
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Detail tugas tidak ditemukan',
				'data' => ''
			], 404);
		}

	}

	public function asmtStudentSubms($id) {
		$asmts = DB::table('assignments')
		->join('submissions', 'submissions.id_assignment', '=', 'assignments.id')
		->join('students', 'submissions.id_student', '=', 'students.id')
		->select('submissions.file', 'submissions.updated_at')
		->where('assignments.id', $id)
		->where('students.id',1)
		->get();	

		if ($asmts) {	
			return $asmts->toJson();
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Detail tugas tidak ditemukan',
				'data' => ''
			], 404);
		}
	}

	public function asmtSubmit(Request $request)
	{
		$request['data'] = json_decode($request['data']);
		$fileName = $request->{'asmt_id'}.'_'.$request->{'student_id'}.'_'.time().'.'.$request->file->getClientOriginalExtension();
		$path = "upload/submissions/".$request->{'asmt_id'};
		$request->file->move(public_path($path), $fileName);

		$subms = Submissions::create([
			'id_assignment' => $request->{'asmt_id'},
			'id_student' => $request->{'student_id'},
			'file' => $request->file->getClientOriginalName(),
			'path' => $path.'/'.$fileName,
		]);

		return response()->json(['success'=>'You have successfully upload file.']);
		
	}


	public function asmtSubmission($id) {
		$subms = DB::table('submissions')
		->join('assignments', 'submissions.id_assignment', '=', 'assignments.id')		
		->join('students', 'submissions.id_student', '=', 'students.id')		
		->select('assignments.*', 'submissions.*', 'students.*')
		->get();	

		return response()->json($subms);

	}

}
