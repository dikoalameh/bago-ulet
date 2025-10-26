<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessMonitoring;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProcessMonitoringController extends Controller
{
    public function index()
    {
        $processes = ProcessMonitoring::with(['actionBy.researchInformation', 'affectedUser.researchInformation'])
            ->orderBy('timestamp', 'desc')
            ->get()
            ->map(function ($process) {
                $piUser = $process->affectedUser ?? $process->actionBy;
                
                return [
                    'pi_name' => $piUser ? $piUser->user_Fname . ' ' . $piUser->user_Lname : 'System',
                    'research_title' => $piUser && $piUser->researchInformation ? 
                        $piUser->researchInformation->research_title : 'N/A',
                    'account_type' => $piUser ? $piUser->user_Access : 'System',
                    'date' => $process->timestamp->format('m/d/y'),
                    'time' => $process->timestamp->format('H:i:s'),
                    'description' => $process->process_description,
                ];
            });

        return view('superadmin.monitoring-process', compact('processes'));
    }

    public function erbindex()
    {
        // Get only ERB-related processes
        $processes = ProcessMonitoring::with(['actionBy.researchInformation', 'affectedUser.researchInformation'])
            ->where('user_type', 'admin_erb') // Only show ERB admin processes
            ->orWhere('user_type', 'reviewer_erb') // Include ERB reviewer processes
            ->orWhere(function($query) {
                $query->where('user_type', 'pi')
                      ->where('process_code', 'LIKE', 'ERB%'); // PI processes related to ERB
            })
            ->orderBy('timestamp', 'desc')
            ->get()
            ->map(function ($process) {
                $piUser = $process->affectedUser ?? $process->actionBy;
                
                return [
                    'pi_name' => $piUser ? $piUser->user_Fname . ' ' . $piUser->user_Lname : 'System',
                    'research_title' => $piUser && $piUser->researchInformation ? 
                        $piUser->researchInformation->research_title : 'N/A',
                    'date' => $process->timestamp->format('m/d/y'),
                    'time' => $process->timestamp->format('H:i:s'),
                    'description' => $process->process_description,
                ];
            });

        return view('erb.monitoring-process', compact('processes'));
    }

    public function erbReviewerIndex()
    {
       $reviewerId = Auth::user()->user_ID;

    // Get processes where reviewer is either the action taker OR the affected user
        $processes = ProcessMonitoring::with(['actionBy.researchInformation', 'affectedUser.researchInformation'])
            ->where(function($query) use ($reviewerId) {
                // Processes where reviewer performed the action
                $query->where('action_by_user_id', $reviewerId)
                    ->where('action_by_user_type', 'reviewer_erb');
            })
            ->orWhere(function($query) use ($reviewerId) {
                // Processes where reviewer is the affected user
                $query->where('affected_user_id', $reviewerId)
                    ->where('affected_user_type', 'reviewer_erb');
            })
            ->orderBy('timestamp', 'desc')
            ->get()
            ->map(function ($process) {
                return [
                    'description' => $process->process_description,
                    'date' => $process->timestamp->format('m/d/y'),
                    'time' => $process->timestamp->format('H:i:s'),
                ];
            });

        return view('erb-reviewer.monitoring-process', compact('processes'));
    }

    public function piIndex(){
        $studentId = Auth::user()->user_ID;

        // Get processes where student is either the action taker OR the affected user
        $processes = ProcessMonitoring::with(['actionBy.researchInformation', 'affectedUser.researchInformation'])
            ->where(function($query) use ($studentId) {
                // Processes where student performed the action
                $query->where('action_by_user_id', $studentId)
                      ->where('action_by_user_type', 'pi');
            })
            ->orWhere(function($query) use ($studentId) {
                // Processes where student is the affected user
                $query->where('affected_user_id', $studentId)
                      ->where('affected_user_type', 'pi');
            })
            ->orderBy('timestamp', 'desc')
            ->get()
            ->map(function ($process) {
                return [
                    'description' => $process->process_description,
                    'date' => $process->timestamp->format('m/d/y'),
                    'time' => $process->timestamp->format('H:i:s'),
                ];
            });

        return view('student.monitoring-process', compact('processes'));
    }
}
