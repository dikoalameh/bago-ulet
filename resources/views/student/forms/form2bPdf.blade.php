<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FORM-2B</title>
    @vite('resources/css/app.css') {{-- loads Tailwind --}}
</head>
<style>
    .page-break {
        break-before: page;
    }
</style>
<body class="p-8 text-sm font-arial">
    <h1 class="text-xl font-times font-black text-center mb-6">MCUERB FORM 2(B): APPLICATION FOR INITIAL REVIEW</h1>

    <x-formbanner>MCUERB FORM 2(B): Application for Initial Review</x-formbanner>

    <h1 class = "text-base font-bold text-center underline mb-4">APPLICATION FOR INITIAL REVIEW</h1>

    <div class ="flex flex-col border">
        <div class ="flex items-center">
            <div class = "w-full border-b">
                <p class = "text-sm font-bold text-center m-1">SECTION I: APPLICATION INFORMATION</p>
            </div>
        </div>
        <div class ="flex items-center">
            <div class = "w-full border-b">
                <p class = "text-sm font-bold text-center m-1">TO BE FILLED UP BY MCUERB STAFF</p>
            </div>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/3 border-r">
                <p class = "text-sm font-bold text-l mb-2">Study Protocol Code:</p>
            </div>
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">MCUERB CODE:</p>
            </div>
            <p class = "text-sm text-l mb-2"><!---{{ $protocol->mcuerb_code }}--></p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l mb-2">Date of Submission:</p>
            </div>
            <p class = "text-sm text-l mb-2"><!---{{ $protocol->mcuerb_code }}--></p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "w-full">
                <p class = "text-sm font-bold text-center m-1">TO BE FILLED UP BY PRINCIPAL INVESTIGATOR (PI)</p>
            </div>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Study Protocol Title</p>
            </div>
            <p class="text-sm text-l mb-2">{{ $protocol->protocol }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Principal Investigator (PI)</p>
            </div>
            <p class="text-sm text-l mb-2">{{ $protocol->pi_name }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">PI Contact Numbers</p>
            </div>
            <p class="text-sm text-l mb-2">{{ $protocol->pi_contact }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">PI Email Address</p>
            </div>
            <p class="text-sm text-l mb-2">{{ $protocol->pi_email }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Co-Investigator(s)</p>
            </div>
            <p class="text-sm text-l mb-2">{{ $protocol->researchInfo?->research_CoInvestigator }}</p>
        </div>
        <div class ="flex items-stretch border-b">
            <div class = "px-2 w-1/4 flex items-center border-r">
                <p class = "text-sm font-bold text-l mb-2">Category of Investigator</p>
            </div>
            <div class = "flex flex-col items-start px-2">
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->investigator_type === 'MCU Undergraduate Student')✓@endif
                    </div>
                    <span class="text-sm ml-2">5.1 MCU Undergraduate Student(s)</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->investigator_type === 'MCU Graduate Student')✓@endif
                    </div>
                    <span class = "text-sm ml-2">5.2 MCU Graduate Student (MA, MS, PhD, Medical Student)</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->investigator_type === 'MCU Faculty')✓@endif
                    </div>
                    <span class="text-sm ml-2">5.3 MCU Faculty</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->investigator_type === 'MCU Non-Teaching Staff')✓@endif
                    </div>
                    <span class="text-sm ml-2">5.4 MCU Non-Teaching Staff</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->investigator_type === 'MCU Administrative Staff')✓@endif
                    </div>
                    <span class="text-sm ml-2">5.5 MCU Administrative Staff</span>
                </div>
            </div>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Endorsing/College/ Unit/ Institution</p>
            </div>
            <p class="text-sm text-l mb-2">{{ $protocol->college_institution }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Submitted by:</p>
            </div>
             <p class="text-sm text-l mb-2">{{ $protocol->submitted_by }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Principal investigator (PI) Signature</p>
            </div>
        </div>
        <div class ="flex items-center border-b">
            <div class = "w-full">
                <p class = "text-sm font-bold text-center m-1">Section II: PROTOCOL INFORMATION</p>
            </div>
        </div>
        <div class ="flex items-stretch border-b">
            <div class = "px-2 w-1/4 flex items-center border-r">
                <p class = "text-sm font-bold text-l mb-2">Type of Study</p>
            </div>
            <div class = "flex flex-col items-start px-2">
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->study_type === 'Academic Requirement')✓@endif
                    </div>
                    <span class="text-sm ml-2">Academic Requirement (Thesis, Dissertation, Training Requirement)</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->study_type === 'Independent Research Work/Researcher Initiated')✓@endif
                    </div>
                    <span class = "text-sm ml-2">Independent Research Work/Researcher Initiated</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->study_type === 'Multi-Disciplinary, Multi-Institutional or Multi-Country collaboration')✓@endif
                    </div>
                    <span class="text-sm ml-2">Multi-Disciplinary, Multi-Institutional or Multi-Country collaboration</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->study_type === 'Others')✓@endif
                    </div>
                    <span class="text-sm ml-2">Others (specify): {{ $protocol->study_type_text }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class = "page-break"></div>

    <!----page 2--->
    <div class ="flex flex-col border">
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l mb-2">Study Protocol Title</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->researchInfo?->research_title }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l mb-2">Study Protocol Brief Description</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->protocol_description }}</p>
        </div>
        <div class ="flex items-stretch border-b">
            <div class = "px-2 w-1/4 flex items-center border-r">
                <p class = "text-sm font-bold text-l mb-2">Study Duration</p>
            </div>
            <div class = "flex flex-col items-start px-2">
                <div class = "flex items-center">
                    <span class="text-sm ml-2">Start Date: {{ $protocol->start_date }}</span>
                </div>
                <div class = "flex items-center">
                    <span class="text-sm ml-2">End Date: {{ $protocol->end_date }}</span>
                </div>
            </div>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Study Setting or Site/s</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->settings_site }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm font-bold text-l m-1">Number of Study Participants</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->study_participants }}</p>
        </div>
        <div class ="flex items-stretch border-b">
            <div class = "px-2 w-1/4 flex items-center border-r">
                <p class = "text-sm font-bold text-l mb-2">Source of Funding</p>
            </div>
            <div class = "flex flex-col items-start px-2">
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->funds === 'Self-Funded')✓@endif
                    </div>
                    <span class="text-sm ml-2">Self-Funded</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->funds === 'Government-Funded')✓@endif
                    </div>
                    <span class = "text-sm ml-2">Government-Funded</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->funds === 'Research Grant/Scholarship')✓@endif
                    </div>
                    <span class="text-sm ml-2">Research Grant/Scholarship</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->funds === 'Institution-Funded')✓@endif
                    </div>
                    <span class="text-sm ml-2">Institution-Funded</span>
                </div>
                <div class = "flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->funds === 'Pharmaceutical')✓@endif
                    </div>
                    <span class="text-sm ml-2">Sponsored by Pharmaceutical Company</span>
                </div>
                @if($protocol->funds === 'Pharmaceutical')
                    <div class="flex items-center">
                        <span class="text-sm ml-2">Specify: <span class="text-sm underline">{{ $protocol->funds_details }}</span></span>
                    </div>
                @endif

                <div class="flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->funds === 'Others')✓@endif
                    </div>
                    <span class="text-sm ml-2">Others</span>
                </div>
                @if($protocol->funds === 'Others')
                    <div class="flex items-center">
                        <span class="text-sm ml-2">Specify: <span class="text-sm underline">{{ $protocol->funds_details }}</span></span>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-stretch border-b">
            <div class="px-2 w-1/4 flex items-center border-r">
                <p class="text-sm font-bold text-l mb-2">Has the Research undergone Technical Review?</p>
            </div>
            <div class="flex flex-col items-start w-2/3 px-2">
                <div class="flex items-start mt-2">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->tech_review == 1)&#10003;@endif
                    </div>
                    <span class="text-sm ml-2 leading-snug">
                        Yes (please attach certification of technical review results and approval from Research Adviser noted by the Dean of the College)
                    </span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->tech_review == 0)&#10003;@endif
                    </div>
                    <span class="text-sm ml-2">No</span>
                </div>
            </div>
        </div>

        <div class="flex items-stretch border-b">
            <div class="px-2 w-1/4 flex items-center border-r">
                <p class="text-sm font-bold text-l mb-2">Has the Research been submitted to another ERB?</p>
            </div>
            <div class="flex flex-col items-start w-2/3 px-2">
                <div class="flex items-start mt-2">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->erb_submit == 1)&#10003;@endif
                    </div>
                    <span class="text-sm ml-2 leading-snug">Yes</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px] leading-none">
                        @if($protocol->erb_submit == 0)&#10003;@endif
                    </div>
                    <span class="text-sm ml-2">No</span>
                </div>
            </div>
        </div>
        <div class ="flex items-center">
            <div class = "w-full border-b">
                <p class = "text-sm font-bold text-center m-1">SECTION III: ETHICAL CONSIDERATIONS</p>
            </div>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l m-1">a. Protection of privacy and confidentiality of research information including data protection plan</p>
            </div>
            <p class = "text-sm italic w-[500px] text-l m-1">The section on ethical considerations should be stated in the study protocol. Please write a summary on protection of privacy and confidentiality of research information including data protection plan.</p>
        </div>
        <div class ="flex items-stretch border-b">
            <div class = "flex flex-col items-start px-2 w-1/3 border-r">
                <div class = "flex items-start">
                    <span class="text-sm ml-2">1.</span>
                </div>
                <div class = "flex items-center">
                    <span class="text-sm ml-2">2.</span>
                </div>
                <div class = "flex items-start">
                    <span class="text-sm ml-2">3.</span>
                </div>
                <div class = "flex items-center">
                    <span class="text-sm ml-2">4.</span>
                </div>
                <div class = "flex items-start">
                    <span class="text-sm ml-2">5.</span>
                </div>
                <div class = "flex items-center">
                    <span class="text-sm ml-2">6.</span>
                </div>
                <div class = "flex items-start">
                    <span class="text-sm ml-2">7.</span>
                </div>
                <div class = "flex items-center">
                    <span class="text-sm ml-2">8.</span>
                </div>
                <div class = "flex items-center">
                    <span class="text-sm ml-2">9.</span>
                </div>
            </div>
            <div class = "px-2 flex w-full items-center">
                <p class="text-sm text-l mb-2">{{ $protocol->information_confidentiality }}</p>
            </div>
        </div>
    </div>
    <div class = "page-break"></div>
    <!----page 3--->

    <div class ="flex flex-col border">
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">a. Vulnerability of research participants</p>
            </div>
            <p class="text-sm text-l mb-2">{{ $protocol->participants_vulnerability }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">b. Risks of the study</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->study_risks }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">c. Benefits of the study</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->study_benefits }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l m-1">a. Protection of privacy and confidentiality of research information including data protection plan</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->patient_related }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">e. Informed consent process and recruitment procedures</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->informed_consent_process }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">f. Community considerations</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->community_considerations }}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">g. Dissemination/data sharing plan</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->dissemination}}</p>
        </div>
        <div class ="flex items-center border-b">
            <div class = "px-2 w-1/4 border-r">
                <p class = "text-sm text-l mb-2">h. Terms of reference of collaborative study</p>
            </div>
            <p class = "text-sm text-l mb-2">{{ $protocol->collaborative_terms }}</p>
        </div>
        <div class="flex items-stretch">
    <div class="px-2 w-1/4 flex items-center border-r">
        <p class="text-sm font-bold text-l mb-2">Use of special populations or vulnerable groups</p>
    </div>

    <div class="flex flex-col items-start w-2/3 px-2">

        <div class="flex items-start mt-2">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Children')✓@endif
            </div>
            <span class="text-sm ml-2">11.1 Children (under 18)</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Indigenous people')✓@endif
            </div>
            <span class="text-sm ml-2">11.2 Indigenous people</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Elderly')✓@endif
            </div>
            <span class="text-sm ml-2">11.3 Elderly</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'People on welfare/social assistance')✓@endif
            </div>
            <span class="text-sm ml-2">11.4 People on welfare/social assistance</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Poor and unemployed')✓@endif
            </div>
            <span class="text-sm ml-2">11.5 Poor and unemployed</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Patients in emergency care')✓@endif
            </div>
            <span class="text-sm ml-2">11.6 Patients in emergency care</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Homeless persons')✓@endif
            </div>
            <span class="text-sm ml-2">11.7 Homeless persons</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Refugees or displaced persons')✓@endif
            </div>
            <span class="text-sm ml-2">11.8 Refugees or displaced persons</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Patients with incurable diseases')✓@endif
            </div>
            <span class="text-sm ml-2">11.9 Patients with incurable diseases</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'Others')✓@endif
            </div>
            <span class="text-sm ml-2">11.10 Others (indicate):</span>
            <span class="ml-1 underline">{{ $protocol->special_population_others }}</span>
        </div>

        <div class="flex items-center">
            <div class="w-4 h-4 border border-black flex items-center justify-center text-[10px]">
                @if($protocol->special_population === 'N/A')✓@endif
            </div>
            <span class="text-sm ml-2">11.11 Not applicable</span>
        </div>
    </div>
</div>


    <div class = "page-break"></div>
    <!---page 4-->

    <p class = "text-sm font-arial mt-8 font-bold">Noted by the Research Adviser:</p>

    <p class = "text-sm font-arial mt-8 font-bold">Approved by the Research Coordinator:</p>
</body>
</html>