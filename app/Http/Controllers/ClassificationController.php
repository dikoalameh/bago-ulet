<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classification;
use App\Mail\UserCredentialMail;
use App\Models\User;
use App\Notifications\UserClassified;
use Illuminate\Support\Facades\Mail;

class ClassificationController extends Controller
{
    // Display all classifications
    public function index() {
        // Keep variable as $pi, but fetch classifications with user info
        $pi = User::with(['researchInformation','classifications'])
        ->where('user_Access', 'Principal Investigator')
        ->whereDoesntHave('classifications', function($query) {
            $query->where('classificationStatus', 'Approved');
        })   
        ->get();
        return view('superadmin.accounts-classifications', compact('pi'));
    }

    public function bulkUpdate(Request $request) {
        $request->validate([
            'user_ids' => 'required|array',
            'reviewClassification' => 'required|string|max:255',
        ]);

        $userIds = $request->user_ids;
        $classificationType = $request->reviewClassification;

        // Get ERB admins to notify
        $erbAdmins = User::where('user_Access', 'ERB Admin')->get();

        foreach ($userIds as $id) {
            // Find or create classification for each user
            $classification = Classification::firstOrCreate(
                ['user_ID' => $id],
                ['classificationStatus' => 'Pending']
            );

            // Update classification
            $classification->update([
                'reviewClassification' => $classificationType,
                'classificationStatus' => 'Approved',
                'classificationDate' => now()
            ]);

            // Send email to user
            $user = User::find($id);
            if ($user) {
                Mail::to($user->user_Email)->queue(new UserCredentialMail($user, $classificationType));
                
                // Send notification to all ERB admins
                foreach ($erbAdmins as $admin) {
                    $admin->notify(new UserClassified($user, $classificationType));
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Selected users have been classified and credentials sent!'
        ]);
    }
}