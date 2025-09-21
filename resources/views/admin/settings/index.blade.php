@extends('layouts.admin')

@section('title', 'App Settings')

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
            <h1 class="text-3xl font-bold text-gray-900">App Settings</h1>
            <p class="text-gray-600 mt-2">Configure app settings, fare parameters, and system preferences</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.settings.notifications') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-bell mr-2"></i>Notifications
            </a>
            <a href="{{ route('admin.settings.banners') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-image mr-2"></i>Banners
            </a>
        </div>
    </div>

    <!-- Settings Form -->
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
        @csrf
        
        @foreach($categories as $category)
            <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-primary capitalize" style="color: #011c72ff;">
                        <i class="fas fa-{{ $category === 'fare' ? 'dollar-sign' : ($category === 'notification' ? 'bell' : ($category === 'app' ? 'mobile-alt' : ($category === 'security' ? 'shield-alt' : 'cog'))) }} mr-2"></i>
                        {{ ucfirst($category) }} Settings
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($settings[$category] as $setting)
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ $setting->description ?: ucfirst(str_replace('_', ' ', $setting->key)) }}
                            </label>
                            
                            @if($setting->type === 'boolean')
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           name="settings[{{ $setting->key }}]" 
                                           value="1" 
                                           {{ $setting->value ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="text-sm text-gray-600">Enable {{ $setting->description ?: $setting->key }}</span>
                                </div>
                            @elseif($setting->type === 'number')
                                <input type="number" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="{{ $setting->value }}"
                                       step="0.01"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @elseif($setting->type === 'json')
                                <textarea name="settings[{{ $setting->key }}]" 
                                          rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                          placeholder="Enter JSON data">{{ is_string($setting->value) ? $setting->value : json_encode($setting->value, JSON_PRETTY_PRINT) }}</textarea>
                            @else
                                <input type="text" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="{{ $setting->value }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @endif
                            
                            @if($setting->description)
                                <p class="text-xs text-gray-500">{{ $setting->description }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-8 text-gray-500">
                            <i class="fas fa-cog text-4xl mb-4"></i>
                            <p>No {{ $category }} settings found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 gradient-primary text-white rounded-lg font-semibold hover:opacity-90 transition-opacity duration-200 hover-scale">
                <i class="fas fa-save mr-2"></i>Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
