<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FullBoardModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\FullBoardAssignedMail;
use App\Notifications\FullBoardAssignedNotification;

class FullBoardReview extends Controller
{
    public function index()
    {
        $protocols = Protocol::where('review_type', 'Full Board')
        ->with([
            'user', 
            'researchInformation',
            'fullBoardAssignments.reviewer'
        ])
        ->get();

        // Fetch users with ERB Reviewers role
        $reviewers = User::where('user_Access', 'ERB Reviewer')
            ->get(['user_ID', 'user_Fname', 'user_Lname', 'user_MI']);

        return view('erb.full-board-review', compact('protocols', 'reviewers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'protocols' => 'required|array',
            'protocols.*' => 'exists:tbl_protocol,protocol_ID',
            'reviewers' => 'required|array',
            'reviewers.*' => 'exists:tbl_users,user_ID',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $assignedBy = auth()->user();
                
                foreach ($request->protocols as $protocolId) {
                    foreach ($request->reviewers as $reviewerId) {
                        // Generate unique assignment ID
                        $assignmentId = 'FBA-' . uniqid();
                        
                        FullBoardModel::create([
                            'assignment_ID' => $assignmentId,
                            'protocol_ID' => $protocolId,
                            'reviewer_ID' => $reviewerId,
                            'assigned_by' => $assignedBy->user_ID,
                        ]);

                        // Get reviewer details
                        $reviewer = User::find($reviewerId);
                        
                        // Send notifications if reviewer exists and has email
                        if ($reviewer) {
                            // Send system notification
                            $reviewer->notify(new FullBoardAssignedNotification($protocolId, $assignmentId, $assignedBy));
                            
                            // Send email notification
                            if (!empty($reviewer->user_Email)) {
                                Mail::to($reviewer->user_Email)->queue(new FullBoardAssignedMail($protocolId, $assignmentId, $assignedBy));
                            }
                        }
                    }
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Reviewers assigned successfully for full board review.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to assign full board reviewers: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign reviewers: ' . $e->getMessage()
            ], 500);
        }
    }
}
