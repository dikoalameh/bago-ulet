@section('title','Final Completion')
<x-erb-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            FINAL COMPLETION
        </h2>
        <br>

        <!-- CSS NG SEARCH BAR -->
        <div class="top-controls">
            <div class="search-wrapper mt-1 flex max-sm:justify-center max-sm:items-center"></div>
        </div>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th class="w-[16.66%]">Protocol ID</th>
                    <th class="w-[16.66%]">P.I. Name</th>
                    <th class="w-[16.66%]">Co-I. Name(s)</th>
                    <th class="w-[16.66%]">Research Title</th>
                    <th class="w-[16.66%]">Status</th>
                    <th class="w-[16.66%]">Date and Time</th>
                </tr>
            </thead>
            <tbody class="text-base/7 max-lg:text-sm/6">
                @foreach($principalInvestigators as $investigator)
                @php
                    // Get the latest submission date from research files
                    $latestSubmission = $investigator->researchFiles
                        ->whereIn('form_id', [37, 38, 39, 40, 41, 42])
                        ->sortByDesc('submitted_at')
                        ->first();
                    
                    // Use latest submission date or fallback to research info updated date
                    $displayDate = $latestSubmission->submitted_at ?? $investigator->researchInformation->updated_at ?? now();
                @endphp
                <tr>
                    <td>{{ $investigator->protocol->protocol_ID ?? 'N/A' }}</td>
                    <td>{{ $investigator->user_Fname }} {{ $investigator->user_Lname }}</td>
                    <td>{{ $investigator->researchInformation->research_CoInvestigator ?? 'N/A' }}</td>
                    <td>{{ $investigator->researchInformation->research_title ?? 'N/A' }}</td>
                    <td>
                        @if($investigator->status === 'Completed')
                            <span class>Completed</span>
                        @else
                            <span class>Pending</span>
                        @endif
                    </td>
                    <td>{{ $displayDate->format('m/d/Y') }}<br>{{ $displayDate->format('H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</x-erb-layout>