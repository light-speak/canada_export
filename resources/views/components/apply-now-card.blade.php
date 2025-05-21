{{-- Apply Now Card Component --}}
<div class="bg-gray-50 dark:bg-[#232323] rounded-lg shadow-sm p-8 {{ $class ?? 'mt-8' }}">
    <div class="max-w-3xl mx-auto text-center">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
            {{ $title ?? 'Need to Apply for New Export Documents?' }}
        </h3>
        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
            {{ $description ?? 'CanadaExport offers a simple, fast online application process to help you obtain the export documents you need.' }}
        </p>
        <div class="flex justify-center">
            <a href="{{ $url ?? '/register' }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                {{ $buttonText ?? 'Apply Now' }}
            </a>
        </div>
    </div>
</div> 