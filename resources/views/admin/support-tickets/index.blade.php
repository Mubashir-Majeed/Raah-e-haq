@extends('layouts.admin')

@section('title', 'Support Tickets')

@section('content')
<div class="fade-in">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Support Tickets</h1>
            <p class="text-gray-600 mt-2">Manage customer support tickets and inquiries</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.support-tickets.analytics') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-chart-bar mr-2"></i>Analytics
            </a>
            <a href="{{ route('admin.support-tickets.categories') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-tags mr-2"></i>Categories
            </a>
            <a href="{{ route('admin.support-tickets.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-plus mr-2"></i>Create Ticket
            </a>
        </div>
    </div>

    <!-- Support Ticket Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['total_tickets'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Tickets</p>
                </div>
                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-ticket-alt text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-warning" style="color: #ce0a0aff;">{{ $stats['open_tickets'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Open Tickets</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-success" style="color: #058a0bee;">{{ $stats['resolved_tickets'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Resolved</p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-danger" style="color: #dc2626;">{{ $stats['urgent_tickets'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Urgent</p>
                </div>
                <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-fire text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="stat-card rounded-2xl p-6 mb-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="GET" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search tickets, users, or subjects..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="pending_customer" {{ request('status') == 'pending_customer' ? 'selected' : '' }}>Pending Customer</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div>
                <select name="priority" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Priority</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>
            <div>
                <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Technical</option>
                    <option value="billing" {{ request('category') == 'billing' ? 'selected' : '' }}>Billing</option>
                    <option value="account" {{ request('category') == 'account' ? 'selected' : '' }}>Account</option>
                    <option value="ride_issue" {{ request('category') == 'ride_issue' ? 'selected' : '' }}>Ride Issue</option>
                    <option value="driver_issue" {{ request('category') == 'driver_issue' ? 'selected' : '' }}>Driver Issue</option>
                    <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>General</option>
                    <option value="complaint" {{ request('category') == 'complaint' ? 'selected' : '' }}>Complaint</option>
                    <option value="suggestion" {{ request('category') == 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                </select>
            </div>
            <div>
                <select name="assigned_to" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Admins</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ request('assigned_to') == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
        </form>
    </div>

    <!-- Support Tickets Table -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Ticket</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">User</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Subject</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Category</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Priority</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Assigned To</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Created</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <code class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-sm font-mono">{{ $ticket->ticket_number }}</code>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-xs">{{ substr($ticket->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $ticket->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $ticket->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="max-w-xs">
                                    <p class="font-medium text-gray-900 truncate">{{ $ticket->subject }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ Str::limit($ticket->description, 50) }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $ticket->getCategoryLabel() }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $ticket->getPriorityColor() }}-100 text-{{ $ticket->getPriorityColor() }}-800">
                                    {{ $ticket->getPriorityLabel() }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $ticket->getStatusColor() }}-100 text-{{ $ticket->getStatusColor() }}-800">
                                    {{ $ticket->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @if($ticket->assignedTo)
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-xs">{{ substr($ticket->assignedTo->name, 0, 1) }}</span>
                                        </div>
                                        <span class="text-sm text-gray-900">{{ $ticket->assignedTo->name }}</span>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Unassigned</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <p class="text-sm text-gray-900">{{ $ticket->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $ticket->created_at->format('H:i') }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.support-tickets.show', $ticket) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                    @if($ticket->isOpen())
                                        <form method="POST" action="{{ route('admin.support-tickets.update-status', $ticket) }}" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="in_progress">
                                            <button type="submit" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-colors text-sm">
                                                <i class="fas fa-play mr-1"></i>Start
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-ticket-alt text-4xl mb-4"></i>
                                <p>No support tickets found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tickets->hasPages())
            <div class="mt-6">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
