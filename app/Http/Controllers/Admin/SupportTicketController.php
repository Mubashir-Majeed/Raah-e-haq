<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = SupportTicket::with(['user', 'assignedTo']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by assigned admin
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get statistics
        $stats = SupportTicket::getTicketStats();

        // Get admins for assignment filter
        $admins = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->get();

        return view('admin.support-tickets.index', compact('tickets', 'stats', 'admins'));
    }

    public function show(SupportTicket $supportTicket)
    {
        $supportTicket->load(['user', 'assignedTo', 'replies.user']);
        return view('admin.support-tickets.show', compact('supportTicket'));
    }

    public function create()
    {
        \Log::info('Support ticket create page accessed');
        
        $users = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['driver', 'passenger']);
        })->get();

        $admins = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->get();

        \Log::info('Users loaded for ticket creation', [
            'users_count' => $users->count(),
            'admins_count' => $admins->count()
        ]);

        return view('admin.support-tickets.create', compact('users', 'admins'));
    }

    public function store(Request $request)
    {
        \Log::info('=== TICKET FORM SUBMITTED ===');
        \Log::info('All request data:', $request->all());
        
        // Basic validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:technical,billing,account,ride_issue,driver_issue,general,complaint,suggestion',
            'priority' => 'required|in:low,medium,high,urgent',
            'source' => 'required|in:web,mobile_app,email,phone,chat',
        ]);

        \Log::info('Validation passed, creating ticket...');

        // Create ticket
        $ticket = SupportTicket::createTicket(
            $request->user_id,
            $request->subject,
            $request->description,
            $request->category,
            $request->priority,
            $request->source,
            []
        );

        \Log::info('Ticket created successfully!', ['ticket_id' => $ticket->id]);

        return redirect()->route('admin.support-tickets.show', $ticket)
            ->with('success', 'Support ticket created successfully!');
    }

    public function updateStatus(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,pending_customer,resolved,closed',
        ]);

        $supportTicket->updateStatus($request->status, auth()->id());

        return redirect()->back()->with('success', 'Ticket status updated successfully');
    }

    public function assign(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $supportTicket->assignTo($request->assigned_to, auth()->id());

        return redirect()->back()->with('success', 'Ticket assigned successfully');
    }

    public function reply(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'message' => 'required|string',
            'is_internal' => 'boolean',
        ]);

        $supportTicket->addReply(
            auth()->id(),
            $request->message,
            'reply',
            $request->boolean('is_internal')
        );

        // Update ticket status to in_progress if it was open
        if ($supportTicket->status === 'open') {
            $supportTicket->updateStatus('in_progress', auth()->id());
        }

        return redirect()->back()->with('success', 'Reply added successfully');
    }

    public function addNote(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $supportTicket->addReply(
            auth()->id(),
            $request->message,
            'note',
            true // Internal note
        );

        return redirect()->back()->with('success', 'Internal note added successfully');
    }

    public function analytics()
    {
        // Get ticket analytics
        $analytics = [
            'total_tickets' => SupportTicket::count(),
            'open_tickets' => SupportTicket::whereIn('status', ['open', 'in_progress', 'pending_customer'])->count(),
            'resolved_tickets' => SupportTicket::where('status', 'resolved')->count(),
            'closed_tickets' => SupportTicket::where('status', 'closed')->count(),
            'urgent_tickets' => SupportTicket::where('priority', 'urgent')->whereIn('status', ['open', 'in_progress'])->count(),
        ];

        // Get monthly ticket data
        $monthlyTickets = SupportTicket::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Get category distribution
        $categoryStats = SupportTicket::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        // Get priority distribution
        $priorityStats = SupportTicket::selectRaw('priority, COUNT(*) as count')
            ->groupBy('priority')
            ->get();

        // Get status distribution
        $statusStats = SupportTicket::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Get admin performance
        $adminStats = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->withCount(['assignedTickets as open_tickets_count' => function($q) {
            $q->whereIn('status', ['open', 'in_progress', 'pending_customer']);
        }])->withCount(['assignedTickets as resolved_tickets_count' => function($q) {
            $q->where('status', 'resolved');
        }])->get();

        return view('admin.support-tickets.analytics', compact('analytics', 'monthlyTickets', 'categoryStats', 'priorityStats', 'statusStats', 'adminStats'));
    }

    public function categories()
    {
        $categories = TicketCategory::orderBy('sort_order')->get();
        return view('admin.support-tickets.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ticket_categories',
            'slug' => 'required|string|max:255|unique:ticket_categories',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
        ]);

        TicketCategory::create($request->all());

        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function updateCategory(Request $request, TicketCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ticket_categories,name,' . $category->id,
            'slug' => 'required|string|max:255|unique:ticket_categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $category->update($request->all());

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function deleteCategory(TicketCategory $category)
    {
        // Check if category has tickets
        if ($category->tickets()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category with existing tickets');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
