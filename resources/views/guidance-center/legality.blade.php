@extends('guidance-center.layout')

@section('title', 'Legality')

@section('page-title', 'Legality')

@section('page-description')
Ensuring the legal validity and compliance of your export documentation in today's global trade environment.
@endsection

@section('content')
<div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Regulatory Compliance
        </h2>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
            Our years of experience assure your documentation is compliant with all recent trade guidelines.
        </p>
        
        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
            Our team deals with international embassies and consulates daily and closely monitors changes to global policies. Rest assured that the CanadaExport platform reflects ongoing regulation changes so you avoid costly delays and penalties.
        </p>
    </div>
</div>

<div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg mt-6">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Legality of E-Signatures
        </h2>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
            In an industry where authenticity and compliance are absolutely vital, digital signatures may seem strange to those accustomed to the traditional wet-ink signature.
        </p>
        
        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
            CanadaExport implements the highest level of secure E-Signatures available; nevertheless, most still ask the burning question: "Are e-signatures legal?". The following is a statement by Adobe Sign, one of the engines that drive our security.
        </p>
        
        <p class="text-base text-gray-700 dark:text-gray-300 font-bold mb-6">
            "The simple answer is, yes, e-signatures are legal."
        </p>
        
        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
            "On June 30, 2000, President Bill Clinton signed the Electronic Signatures in Global and National Commerce Act (ESIGN Act) into law without a pen. Instead, he used an electronic signature. This ground-breaking law addresses e-signatures as well as electronic records, both of which are commonly used in commerce today. An e-signature was granted the same status as a written signature under the terms of this legislation; however, it is important to note that simply placing a symbol on a document does not, in and of itself, create an enforceable contract. Those who are concerned about the question of legality must be well informed about the various requirements associated with the use of e-signatures."
        </p>
    </div>
</div>

@include('components.apply-now-card', [
    'title' => 'Ready to experience compliant, secure export documentation?',
    'description' => 'CanadaExport provides legally valid documentation that meets international standards.',
    'buttonText' => 'Get Started Today'
])
@endsection 