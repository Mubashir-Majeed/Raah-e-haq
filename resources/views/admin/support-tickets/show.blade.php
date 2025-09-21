@extends('layouts.admin')

@section('title', 'Support Ticket Details')

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
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.support-tickets.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-arrow-left mr-2"></i>Back to Tickets
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $supportTicket->ticket_number }}</h1>
                <p class="text-gray-600 mt-2">{{ $supportTicket->subject }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $supportTicket->getStatusColor() }}-100 text-{{ $supportTicket->getStatusColor() }}-800">
                {{ $supportTicket->getStatusLabel() }}
            </span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $supportTicket->getPriorityColor() }}-100 text-{{ $supportTicket->getPriorityColor() }}-800">
                {{ $supportTicket->getPriorityLabel() }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Ticket Information -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Ticket Details</h2>
                    <span class="text-sm text-gray-500">{{ $supportTicket->created_at->format('M d, Y H:i') }}</span>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $supportTicket->description }}</p>
                        </div>
                    </div>

                    @if($supportTicket->metadata)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Additional Information</label>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    @foreach($supportTicket->metadata as $key => $value)
                                        <div>
                                            <span class="font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                            <span class="text-gray-900 ml-2">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Replies -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Conversation</h2>
                
                <div class="space-y-4">
                    @forelse($supportTicket->replies as $reply)
                        <div class="flex space-x-4 {{ $reply->is_internal ? 'opacity-75' : '' }}">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr($reply->user->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium text-gray-900">{{ $reply->user->name }}</span>
                                            @if($reply->is_internal)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-lock mr-1"></i>Internal
                                                </span>
                                            @endif
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $reply->getTypeColor() }}-100 text-{{ $reply->getTypeColor() }}-800">
                                                {{ $reply->getTypeLabel() }}
                                            </span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $reply->created_at->format('M d, Y H:i') }}</span>
                                    </div>
                                    <p class="text-gray-900 whitespace-pre-wrap">{{ $reply->message }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-comments text-4xl mb-4"></i>
                            <p>No replies yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Reply Form -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Add Reply</h2>
                
                <form method="POST" action="{{ route('admin.support-tickets.reply', $supportTicket) }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea name="message" id="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Type your reply here..." required></textarea>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="is_internal" id="is_internal" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_internal" class="ml-2 block text-sm text-gray-700">
                                Internal note (not visible to customer)
                            </label>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale">
                                <i class="fas fa-paper-plane mr-2"></i>Send Reply
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Ticket Actions -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <!-- Status Update -->
                    <form method="POST" action="{{ route('admin.support-tickets.update-status', $supportTicket) }}">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <select name="status" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="open" {{ $supportTicket->status === 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $supportTicket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="pending_customer" {{ $supportTicket->status === 'pending_customer' ? 'selected' : '' }}>Pending Customer</option>
                                <option value="resolved" {{ $supportTicket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $supportTicket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Assignment -->
                    <form method="POST" action="{{ route('admin.support-tickets.assign', $supportTicket) }}">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <select name="assigned_to" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Unassigned</option>
                                @foreach(\App\Models\User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->get() as $admin)
                                    <option value="{{ $admin->id }}" {{ $supportTicket->assigned_to === $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ticket Information -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ticket Information</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ticket Number:</span>
                        <span class="font-medium">{{ $supportTicket->ticket_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Category:</span>
                        <span class="font-medium">{{ $supportTicket->getCategoryLabel() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Priority:</span>
                        <span class="font-medium">{{ $supportTicket->getPriorityLabel() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Source:</span>
                        <span class="font-medium">{{ $supportTicket->getSourceLabel() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium">{{ $supportTicket->created_at->format('M d, Y') }}</span>
                    </div>
                    @if($supportTicket->resolved_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Resolved:</span>
                            <span class="font-medium">{{ $supportTicket->resolved_at->format('M d, Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Customer Information</h3>
                
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">{{ substr($supportTicket->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $supportTicket->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $supportTicket->user->email }}</p>
                    </div>
                </div>
                
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Phone:</span>
                        <span class="font-medium">{{ $supportTicket->user->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium">{{ ucfirst($supportTicket->user->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Role:</span>
                        <span class="font-medium">{{ ucfirst($supportTicket->user->roles->first()->name ?? 'N/A') }}</span>
                    </div>
                </div>
            </div>

            <!-- Assigned Admin -->
            @if($supportTicket->assignedTo)
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Assigned To</h3>
                    
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr($supportTicket->assignedTo->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $supportTicket->assignedTo->name }}</p>
                            <p class="text-sm text-gray-500">{{ $supportTicket->assignedTo->email }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
