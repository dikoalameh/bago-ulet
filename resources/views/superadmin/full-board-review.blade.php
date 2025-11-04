@section('title','Full Board Review')
<x-superadmin-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            FULL BOARD REVIEW
        </h2>
        <br>

        <!-- CSS NG SEARCH BAR -->
        <div class="top-controls">
            <div class="search-wrapper mt-1 flex max-sm:justify-center max-sm:items-center"></div>
        </div>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <!-- Table header -->
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th class="w-[16.66%]">Research Protocol</th>
                    <th class="w-[16.66%]">Reviewer(s)</th>
                    <th class="w-[16.66%]">P.I. Name</th>
                    <th class="w-[16.66%]">Co-I. Name(s)</th>
                    <th class="w-[16.66%]">Research Title</th>
                    <th class="w-[16.66%]">Date Assigned</th>
                </tr>
            </thead>
            <tbody class="text-base/7 max-lg:text-sm/6">
                @foreach($protocols as $protocol)
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <input type="checkbox" class="protocol-checkbox w-[14px] h-[14px]"
                                    value="{{ $protocol->protocol_ID }}"
                                    data-title="{{ $protocol->researchInformation ? $protocol->researchInformation->research_title : 'N/A' }}"
                                    data-user="{{ $protocol->user ? $protocol->user->user_Fname . ' ' . $protocol->user->user_Lname : 'N/A' }}">
                                <span>{{ $protocol->protocol_ID }}</span>
                            </div>
                        </td>
                        <td>
                            @if($protocol->fullBoardAssignments && $protocol->fullBoardAssignments->count() > 0)
                                                {{ $protocol->fullBoardAssignments->map(function ($assignment) {
                                    return $assignment->reviewer ? $assignment->reviewer->user_Fname . ' ' . $assignment->reviewer->user_Lname : '';
                                })->join(', ') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($protocol->user)
                                {{ $protocol->user->user_Fname }} {{ $protocol->user->user_Lname }}
                            @endif
                        </td>
                        <td>
                            @if($protocol->researchInformation)
                                {{ $protocol->researchInformation->research_CoInvestigator }}
                            @endif
                        </td>
                        <td>
                            @if($protocol->researchInformation)
                                {{ $protocol->researchInformation->research_title }}
                            @endif
                        </td>
                        <td>{{ $protocol->created_at->format('m/d/Y\ H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</x-superadmin-layout>