@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
            <p class="text-gray-600 mt-2">Update user information and roles</p>
        </div>
        <a href="{{ route('admin.users.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Users
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Information Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">User Information</h3>
                
                <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}" id="user-update-form">
                    @csrf
                    @method('PUT')
                    
                    
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="cnic" class="block text-sm font-medium text-gray-700 mb-2">CNIC</label>
                            <input type="text" id="cnic" name="cnic" value="{{ old('cnic', $user->cnic) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cnic') border-red-500 @enderror">
                            @error('cnic')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea id="address" name="address" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" name="status" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Roles</h4>
                        <div class="space-y-3">
                            @foreach($roles as $role)
                            <div class="flex items-center">
                                <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}" 
                                       {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="role_{{ $role->id }}" class="ml-3 text-sm text-gray-700">
                                    <span class="font-medium">{{ $role->display_name }}</span>
                                    <span class="text-gray-500">- {{ $role->description }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('admin.users.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                id="update-btn"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale"
                                onclick="this.disabled=true; this.innerHTML='<i class=\'fas fa-spinner fa-spin mr-2\'></i>Updating...'; const f=this.closest('form'); if(f){ f.submit(); } return false;">
                            <i class="fas fa-save mr-2"></i>Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">User Profile</h3>
                
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-medium">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h4>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($user->status === 'active') bg-green-100 text-green-800
                            @elseif($user->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Phone</span>
                        <span class="text-sm text-gray-900">{{ $user->phone ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">CNIC</span>
                        <span class="text-sm text-gray-900">{{ $user->cnic ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Joined</span>
                        <span class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="py-2">
                        <span class="text-sm text-gray-600 block mb-2">Roles</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($user->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($role->name === 'admin') bg-red-100 text-red-800
                                    @elseif($role->name === 'driver') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800
                                    @endif">
                                    {{ $role->display_name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced form styling */
.hover-scale {
    transition: all 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
}

.form-input {
    transition: all 0.3s ease;
}

.form-input:focus {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
}

.role-checkbox {
    transition: all 0.3s ease;
}

.role-checkbox:hover {
    transform: scale(1.1);
}

#update-btn {
    position: relative;
    overflow: hidden;
}

#update-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

#update-btn:hover::before {
    left: 100%;
}

/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spin {
    animation: spin 1s linear infinite;
}

/* Success message styling */
.alert-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

/* Error message styling */
.text-red-500 {
    color: #ef4444 !important;
    font-weight: 500;
    font-size: 0.875rem;
}
</style>

<script>
// No interception; rely on native submit. Button onclick calls form.submit().
</script>
@endsection
