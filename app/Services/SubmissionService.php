<?php
namespace App\Services;

use App\Repositories\Document\DocumentRepositoryInterface;
use App\Repositories\Submission\SubmissionRepositoryInterface;
use Illuminate\Http\Request;

class SubmissionService {
    
    protected $submissionRepository;
    protected $documentRepository;

    public function __construct(SubmissionRepositoryInterface $submissionRepository, DocumentRepositoryInterface $documentRepository)
    {
        $this->submissionRepository = $submissionRepository;
        $this->documentRepository = $documentRepository;
    }

    public function getAllSubmissions() {
        return $this->submissionRepository->getAllSubmission();
    }

    public function getSubmissionById($id) {
        return $this->submissionRepository->getSubmissionById($id);
    } 

    public function createSubmission(Request $request) {
        $submission = $this->submissionRepository->createSubmission($request);
        if($request->file('lampiran')) {
            $this->documentRepository->createDocumentSubmission($request, $submission);
        }
        return $submission;
    }

    public function updateSubmission(Request $request) {
        return $this->submissionRepository->updateSubmission($request);
    }

    public function deleteSubmissionById($id) {
        return $this->submissionRepository->deleteSubmissionById($id);
    }

    public function checkSubmissionExists($nis, $id_kelas, $id_assignment) {
        $submission = $this->submissionRepository->checkSubmission($nis, $id_kelas, $id_assignment);
        if($submission === null) {
            return false;
        } else {
            return true;
        }
    }

    public function getSubmission($nis, $id_kelas, $id_assignment) {
        return $this->submissionRepository->checkSubmission($nis, $id_kelas, $id_assignment);
    }

    public function getSubmissionByAssigmentId($id_assignment) {
        return $this->submissionRepository->getSubmissionByAssigmentId($id_assignment);
    }
}