@extends('layouts.dashboard')

@section('title', 'Add Company - Documents')

@push('scripts')
<script>
    function fileUpload() {
        return {
            files: {},
            
            handleFileSelect(event, fieldName) {
                const file = event.target.files[0];
                if (!file) return;
                
                this.files[fieldName] = {
                    name: file.name,
                    size: this.formatFileSize(file.size),
                    type: file.type,
                    preview: null
                };
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.files[fieldName].preview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            
            removeFile(fieldName) {
                const input = document.getElementById(fieldName);
                input.value = '';
                delete this.files[fieldName];
            },
            
            formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        }
    }
</script>
@endpush

@section('dashboard-content')
<div x-data="fileUpload()">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 4 of 5: Upload Documents</p>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-[#FF0000]">Step 4 of 5</span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">80% complete</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#FF0000] h-2.5 rounded-full" style="width: 80%"></div>
        </div>
    </div>

    <!-- Step Navigation -->
    <div class="flex mb-6 overflow-x-auto">
        <a href="{{ route('companies.create.basic_info') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Basic Info
        </a>
        <a href="{{ route('companies.create.legal_info') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Legal Info
        </a>
        <a href="{{ route('companies.create.contacts') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Contacts
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-[#FF0000] text-[#FF0000] font-medium text-sm">
            Documents
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Summary
        </a>
    </div>
    
    <!-- Form -->
    <div class="bg-white dark:bg-[#1a1a1a] shadow-md rounded-lg p-8">
        <form action="{{ route('companies.store.documents') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Business License -->
            <div class="mb-8">
                <label for="business_licence" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Business License</label>
                <div class="mt-1">
                    <input type="file" 
                           name="business_licence" 
                           id="business_licence" 
                           class="block w-full text-sm text-gray-500 dark:text-gray-400
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0
                               file:text-sm file:font-medium
                               file:bg-[#FF0000] file:text-white
                               hover:file:bg-[#CC0000]
                               file:cursor-pointer"
                           accept=".pdf,.jpg,.jpeg,.png"
                           @change="handleFileSelect($event, 'business_licence')" />
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload a scanned copy of your business license (PDF, JPG, PNG, max 50MB)</p>
                    
                    <!-- File Preview -->
                    <template x-if="files.business_licence">
                        <div class="mt-4 p-4 bg-gray-50 dark:bg-[#121212] rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="flex-shrink-0" x-show="files.business_licence.preview">
                                    <img :src="files.business_licence.preview" class="h-16 w-16 object-cover rounded">
                                </div>
                                <div class="flex-shrink-0" x-show="!files.business_licence.preview">
                                    <svg class="h-16 w-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="files.business_licence.name"></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400" x-text="files.business_licence.size"></div>
                                    <div class="text-sm text-green-600 dark:text-green-400">File ready to upload</div>
                                </div>
                                <button type="button" @click="removeFile('business_licence')" class="ml-4 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                    <span class="sr-only">Remove file</span>
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                @error('business_licence')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>

            @if(session('company_legal_info.company_types') && in_array('manufacturer', session('company_legal_info.company_types')))
            <!-- Manufacturing License -->
            <div class="mb-8">
                <label for="manufacturing_licence" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Manufacturing License</label>
                <div class="mt-1">
                    <input type="file" 
                           name="manufacturing_licence" 
                           id="manufacturing_licence" 
                           class="block w-full text-sm text-gray-500 dark:text-gray-400
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0
                               file:text-sm file:font-medium
                               file:bg-[#FF0000] file:text-white
                               hover:file:bg-[#CC0000]
                               file:cursor-pointer"
                           accept=".pdf,.jpg,.jpeg,.png"
                           @change="handleFileSelect($event, 'manufacturing_licence')" />
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload your valid manufacturing license (PDF, JPG, PNG, max 50MB)</p>
                    
                    <!-- File Preview -->
                    <template x-if="files.manufacturing_licence">
                        <div class="mt-4 p-4 bg-gray-50 dark:bg-[#121212] rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="flex-shrink-0" x-show="files.manufacturing_licence.preview">
                                    <img :src="files.manufacturing_licence.preview" class="h-16 w-16 object-cover rounded">
                                </div>
                                <div class="flex-shrink-0" x-show="!files.manufacturing_licence.preview">
                                    <svg class="h-16 w-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="files.manufacturing_licence.name"></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400" x-text="files.manufacturing_licence.size"></div>
                                    <div class="text-sm text-green-600 dark:text-green-400">File ready to upload</div>
                                </div>
                                <button type="button" @click="removeFile('manufacturing_licence')" class="ml-4 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                    <span class="sr-only">Remove file</span>
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                @error('manufacturing_licence')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>

            <!-- GMP Certificate -->
            <div class="mb-8">
                <label for="gmp_certificate" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Good Manufacturing Practices (GMP) Certificate</label>
                <div class="mt-1">
                    <input type="file" 
                           name="gmp_certificate" 
                           id="gmp_certificate" 
                           class="block w-full text-sm text-gray-500 dark:text-gray-400
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0
                               file:text-sm file:font-medium
                               file:bg-[#FF0000] file:text-white
                               hover:file:bg-[#CC0000]
                               file:cursor-pointer"
                           accept=".pdf,.jpg,.jpeg,.png"
                           @change="handleFileSelect($event, 'gmp_certificate')" />
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload your GMP certificate (PDF, JPG, PNG, max 50MB)</p>
                    
                    <!-- File Preview -->
                    <template x-if="files.gmp_certificate">
                        <div class="mt-4 p-4 bg-gray-50 dark:bg-[#121212] rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="flex-shrink-0" x-show="files.gmp_certificate.preview">
                                    <img :src="files.gmp_certificate.preview" class="h-16 w-16 object-cover rounded">
                                </div>
                                <div class="flex-shrink-0" x-show="!files.gmp_certificate.preview">
                                    <svg class="h-16 w-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="files.gmp_certificate.name"></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400" x-text="files.gmp_certificate.size"></div>
                                    <div class="text-sm text-green-600 dark:text-green-400">File ready to upload</div>
                                </div>
                                <button type="button" @click="removeFile('gmp_certificate')" class="ml-4 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                    <span class="sr-only">Remove file</span>
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                @error('gmp_certificate')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            @endif

            <div class="flex justify-between mt-8">
                <a href="{{ route('companies.create.contacts') }}" class="inline-flex items-center px-5 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Contacts
                </a>
                <button type="submit" class="inline-flex items-center px-5 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Summary
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 