<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketReplyResource;
use App\Http\Resources\TicketResource;
use App\Models\SupportTicket;
use App\Models\TicketCategory;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function tickets(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = SupportTicket::with(['user', 'assignedTo'])
            ->orderBy('created_at', 'desc');

        if (!$user->hasRole('admin')) {
            $query->where('user_id', $user->id);
        } else {
            if ($status = $request->get('status')) {
                $query->where('status', $status);
            }
            if ($priority = $request->get('priority')) {
                $query->where('priority', $priority);
            }
            if ($category = $request->get('category')) {
                $query->where('category', $category);
            }
        }

        $tickets = $query->paginate(20);

        return response()->json(['success' => true, 'data' => TicketResource::collection($tickets)]);
    }

    public function show(SupportTicket $ticket, Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user->hasRole('admin') && $ticket->user_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $ticket->load(['user', 'assignedTo', 'replies.user']);
        return response()->json(['success' => true, 'data' => new TicketResource($ticket)]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string',
            'priority' => 'nullable|string|in:low,medium,high,urgent',
            'attachments' => 'nullable|array',
            'attachments.*' => 'string',
            'metadata' => 'nullable|array',
        ]);

        $ticket = SupportTicket::createTicket(
            $request->user()->id,
            $data['subject'],
            $data['description'],
            $data['category'] ?? 'general',
            $data['priority'] ?? 'medium',
            'mobile_app',
            $data['metadata'] ?? []
        );

        if (!empty($data['attachments'])) {
            $ticket->update(['attachments' => $data['attachments']]);
        }

        return response()->json(['success' => true, 'message' => 'Ticket created', 'data' => new TicketResource($ticket)], 201);
    }

    public function reply(Request $request, SupportTicket $ticket): JsonResponse
    {
        $user = $request->user();
        if (!$user->hasRole('admin') && $ticket->user_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'message' => 'required|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'string',
            'is_internal' => 'nullable|boolean',
        ]);

        $isInternal = (bool)($data['is_internal'] ?? false);
        if ($isInternal && !$user->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $reply = $ticket->addReply(
            $user->id,
            $data['message'],
            'reply',
            $isInternal,
            $data['attachments'] ?? null
        );

        return response()->json(['success' => true, 'message' => 'Reply added', 'data' => new TicketReplyResource($reply)], 201);
    }

    public function assign(Request $request, SupportTicket $ticket): JsonResponse
    {
        $user = $request->user();
        if (!$user->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'admin_id' => 'required|exists:users,id',
        ]);

        $assignee = User::find($data['admin_id']);
        if (!$assignee || !$assignee->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Assignee must be admin'], 422);
        }

        $ticket->assignTo($assignee->id, $user->id);

        return response()->json(['success' => true, 'message' => 'Ticket assigned', 'data' => new TicketResource($ticket->fresh('assignedTo'))]);
    }

    public function changeStatus(Request $request, SupportTicket $ticket): JsonResponse
    {
        $user = $request->user();
        if (!$user->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'status' => 'required|string|in:open,in_progress,pending_customer,resolved,closed',
        ]);

        $ticket->updateStatus($data['status'], $user->id);

        return response()->json(['success' => true, 'message' => 'Status updated', 'data' => new TicketResource($ticket->fresh())]);
    }

    public function categories(): JsonResponse
    {
        $categories = TicketCategory::getActiveCategories();
        return response()->json(['success' => true, 'data' => $categories]);
    }

    public function storeCategory(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:ticket_categories,slug',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'auto_assignment_rules' => 'nullable|array',
        ]);

        $category = TicketCategory::create(array_merge([
            'is_active' => true,
        ], $data));

        return response()->json(['success' => true, 'message' => 'Category created', 'data' => $category], 201);
    }

    public function updateCategory(Request $request, TicketCategory $category): JsonResponse
    {
        $user = $request->user();
        if (!$user->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:100',
            'slug' => 'sometimes|string|max:100|unique:ticket_categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'auto_assignment_rules' => 'nullable|array',
        ]);

        $category->update($data);

        return response()->json(['success' => true, 'message' => 'Category updated', 'data' => $category]);
    }

    public function destroyCategory(Request $request, TicketCategory $category): JsonResponse
    {
        $user = $request->user();
        if (!$user->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $category->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted']);
    }
}
