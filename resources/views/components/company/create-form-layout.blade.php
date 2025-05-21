@props([
    'step' => 1, 
    'title' => 'Basic Information',
    'progressPercentage' => 20,
    'currentStep' => 'basic_info'
])

<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step {{ $step }} of 5: {{ $title }}</p>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-[#FF0000]">Step {{ $step }} of 5</span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $progressPercentage }}% complete</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#FF0000] h-2.5 rounded-full" style="width: {{ $progressPercentage }}%"></div>
        </div>
    </div>
    
    <!-- Step Navigation -->
    <div class="flex mb-6 overflow-x-auto">
        <a href="{{ route('companies.create.basic_info') }}" class="px-4 py-2 border-b-2 {{ $currentStep === 'basic_info' ? 'border-[#FF0000] text-[#FF0000] font-medium' : 'border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400' }} text-sm">
            Basic Info
        </a>
        <a href="{{ route('companies.create.legal_info') }}" class="px-4 py-2 border-b-2 {{ $currentStep === 'legal_info' ? 'border-[#FF0000] text-[#FF0000] font-medium' : 'border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400' }} text-sm">
            Legal Info
        </a>
        <a href="{{ route('companies.create.contacts') }}" class="px-4 py-2 border-b-2 {{ $currentStep === 'contacts' ? 'border-[#FF0000] text-[#FF0000] font-medium' : 'border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400' }} text-sm">
            Contacts
        </a>
        <a href="{{ route('companies.create.documents') }}" class="px-4 py-2 border-b-2 {{ $currentStep === 'documents' ? 'border-[#FF0000] text-[#FF0000] font-medium' : 'border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400' }} text-sm">
            Documents
        </a>
        <a href="{{ route('companies.create.summary') }}" class="px-4 py-2 border-b-2 {{ $currentStep === 'summary' ? 'border-[#FF0000] text-[#FF0000] font-medium' : 'border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400' }} text-sm">
            Summary
        </a>
    </div>
    
    <!-- Form Content -->
    <div class="bg-white dark:bg-[#1a1a1a] shadow-md rounded-lg p-8">
        {{ $slot }}
    </div>
</div> 