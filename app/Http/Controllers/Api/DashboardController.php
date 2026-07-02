<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        // Single optimized query using aggregation
        $ticketStats = Ticket::where('user_id', $user->id)
            ->selectRaw('
                COUNT(*) as total_ticket,
                SUM(CASE WHEN status_id = 1 THEN 1 ELSE 0 END) as open_ticket,
                SUM(CASE WHEN status_id = 2 THEN 1 ELSE 0 END) as assigned_ticket,
                SUM(CASE WHEN status_id = 3 THEN 1 ELSE 0 END) as in_progress_ticket,
                SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as resolved_ticket,
                SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as closed_ticket
            ')
            ->first();

        // Get recent tickets with eager loading
        $recentTickets = Ticket::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with('status')
            ->select('id', 'status_id', 'ticket_number', 'subject', 'created_at')
            ->limit(5)
            ->get();

        // Get recent activities (ticket history) with eager loading
        $recentActivities = Ticket::where('user_id', $user->id)
            ->with(['histories' => fn ($q) => $q->latest()->limit(1)])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        // Get resolved tickets today
        $resolvedToday = Ticket::where('user_id', $user->id)
            ->where('status_id', 4)
            ->whereDate('updated_at', today())
            ->count();

        // Calculate progress percentage
        $totalActive = $ticketStats->open_ticket + $ticketStats->assigned_ticket + $ticketStats->in_progress_ticket + $ticketStats->resolved_ticket;
        $progressPercentage = $totalActive > 0
            ? round(($ticketStats->resolved_ticket / $totalActive) * 100)
            : 0;

        return response()->json([
            'message' => 'Dashboard loaded successfully',
            'data' => [
                'user' => $user->only('id', 'name', 'email', 'phone', 'avatar'),
                'summary' => [
                    'total_tickets' => $ticketStats->total_ticket,
                    'open' => intval($ticketStats->open_ticket),
                    'assigned' => intval($ticketStats->assigned_ticket),
                    'in_progress' => intval($ticketStats->in_progress_ticket),
                    'resolved' => intval($ticketStats->resolved_ticket),
                    'closed' => intval($ticketStats->closed_ticket),
                    'resolved_today' => $resolvedToday,
                    'completion_percentage' => $progressPercentage,
                ],
                'recent_tickets' => $recentTickets,
                'recent_activities' => $recentActivities,
            ]
        ], 200);
    }
}
