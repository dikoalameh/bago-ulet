<?php

namespace App\Http\Controllers;

use App\Models\FormsTable;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResearchFiles;
use App\Notifications\FormsAssigned;
use Illuminate\Support\Facades\Notification;

class FormAssignment extends Controller
{
    public function approvedAccounts()
    {
        // Get approved accounts - both with and without forms for reassignment capability
        $approvedAccounts = User::with(['forms', 'researchInformation', 'classifications'])
            ->whereHas('classifications', function ($q) {
                $q->where('classificationStatus', 'Approved')
                ->whereIn('reviewClassification', ['ERB', 'BOTH']);
            })
            ->get()
            ->sortBy(function($user) {
                // Sort by whether user has forms (users without forms come first)
                return $user->forms->isNotEmpty() ? 1 : 0;
            });

        $selectForms = FormsTable::whereIn('form_code', [
            'Form 2(A)',
            'Form 2(B)',
            'Form 2(C)',
            'Form 2(D)',
            'Form 5(E)',
            'FORM 2(A) Soft Copy',
            'FORM 2(B) Soft Copy',
            'Proof of Enrollment',
            'Technical Review Letter',
            'Study Protocol',
            'Form 2(C) Soft Copy - ENG',
            'Form 2(C) Soft Copy - FIL',
            'Data Collection Tools',
            'Certificates of Validators',
            'Child Assent for Children Ages 7-12 years - ENG',
            'Child Assent for Children Ages 7-12 years - FIL',
            'Child Assent for Children Ages 13-17 years - ENG',
            'Child Assent for Children Ages 13-17 years - FIL',
            'Recruitment advertisement',
            'Curriculum Vitae',
            'Good Clinical Practice (GCP) or Health Research Ethics Training Certificate',
            'Gantt chart',
        ])->get();

        return view('erb.iro-approved-accounts', compact('selectForms','approvedAccounts'));
    }

    public function IACUCapprovedAccounts()
    {
        // Get approved accounts - both with and without forms for reassignment capability
        $approvedAccounts = User::with(['forms', 'researchInformation', 'classifications'])
            ->whereHas('classifications', function ($q) {
                $q->where('classificationStatus', 'Approved')
                ->whereIn('reviewClassification', ['IACUC', 'BOTH']);
            })
            ->get()
            ->sortBy(function($user) {
                // Sort by whether user has forms (users without forms come first)
                return $user->forms->isNotEmpty() ? 1 : 0;
            });

        $selectForms = FormsTable::whereIn('form_code', [
            'Form 2(A)',
            'Form 2(B)',
        ])->get();

        return view('iacuc.iro-approved-accounts', compact('selectForms','approvedAccounts'));
    }

    public function assignFormsAjax(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'form_ids' => 'required|array',
        ]);

        foreach ($request->user_ids as $userId) {
            $user = User::find($userId);

            if ($user) {
                // Save to tbl_forms_user (pivot)
                $user->forms()->syncWithoutDetaching($request->form_ids);
                
                // Send notification ONLY to this specific user
                $user->notify(new FormsAssigned($request->form_ids));
            }
        }

        return response()->json(['success' => true, 'message' => 'Forms assigned successfully!']);
    }

    public function assignDefaultFormsAjax(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
        ]);

        $defaultFormIds = [45, 46, 53];

        foreach ($request->user_ids as $userId) {
            $user = User::find($userId);

            if ($user) {
                // Save to tbl_forms_user (pivot) with default forms
                $user->forms()->syncWithoutDetaching($defaultFormIds);
                
                // Send notification ONLY to this specific user
                $user->notify(new FormsAssigned($defaultFormIds));
            }
        }

        return response()->json(['success' => true, 'message' => 'Default forms assigned successfully!']);
    }

    public function assignedFormsDisplay(){
        $student = auth()->user();
        
        $assignedForms = $student->forms()
        ->where('form_type','Forms')
        ->get();

        return view('student.download-forms', compact('assignedForms'));
    }

    public function assignedSubmissionDisplay(){
    $student = auth()->user();

    $submissionForms = $student->forms()
        ->where('form_type', 'Submission')
        ->get()
        ->map(function($form) use ($student) {
            // Check if this form has been submitted by the student with ACTIVE status
            $submission = ResearchFiles::where('user_ID', $student->user_ID)
                ->where('form_id', $form->form_id)
                ->where('status', 'active')
                ->latest()
                ->first();
            
            // Add the submission status to the form object
            $form->is_submitted = !is_null($submission);
            
            // Get the submission date if exists (only from active submissions)
            if ($form->is_submitted) {
                $form->submitted_at = $submission->submitted_at;
            } else {
                $form->submitted_at = null;
            }
            
            return $form;
        });
    
    return view('student.submit-forms', compact('submissionForms'));
}

    public function assignedFormsLogs()
    {
        $approvedAccounts = User::with(['forms', 'researchInformation', 'classifications'])
            ->whereHas('classifications', function ($q) {
                $q->where('classificationStatus', 'Approved');
            })
            ->get();

        $selectForms = FormsTable::whereIn('form_code', [
            'Form 2(A)','Form 2(B)','Form 2(C)','Form 2(D)','Form 5(E)',
            'FORM 2(A) Soft Copy','FORM 2(B) Soft Copy','Proof of Enrollment',
            'Technical Review Letter','Study Protocol','Form 2(C) Soft Copy - ENG',
            'Form 2(C) Soft Copy - FIL','Data Collection Tools','Certificates of Validators',
            'Child Assent for Children Ages 7-12 years - ENG',
            'Child Assent for Children Ages 7-12 years - FIL',
            'Child Assent for Children Ages 13-17 years - ENG',
            'Child Assent for Children Ages 13-17 years - FIL',
            'Recruitment advertisement','Curriculum Vitae',
            'Good Clinical Practice (GCP) or Health Research Ethics Training Certificate',
            'Gantt chart',
        ])->get();

        return view('erb.approved-accounts', compact('approvedAccounts','selectForms'));
    }
}
