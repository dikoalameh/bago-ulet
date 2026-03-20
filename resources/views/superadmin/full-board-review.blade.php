@section('title', 'Full Board Review')
<x-superadmin-layout>
    <div id="filterModal" onclick="outsideClick(event)"
        class="fixed inset-0 bg-black z-[9999] bg-opacity-50 hidden items-center justify-center overflow-auto overscroll-contain">
        <div class="relative flex items-center justify-center bg-white w-[400px] p-6 rounded-[10px] shadow-md">
            <form action="" class="w-full px-2">
                <div class="flex justify-between items-center mb-2">
                    <div class="text-xl font-bold">Filter</div>
                    <button type="button" onclick="closeModal('filterModal')" class="material-symbols-outlined">
                        close
                    </button>
                </div>
                <div class="w-full">
                    <!-- CALENDAR FILTERING FOR THE COUNT OF SUBMISSION -->
                    <div class="mt-4">
                        <label for="fromDate">From:</label>
                        <input type="date" id="fromDate" class="w-full max-md:text-sm h-[35px] text-sm max-sm:h-[31px]">
                    </div>
                    <div class="mt-4">
                        <label for="toDate">To:</label>
                        <input type="date" id="toDate" class="w-full max-md:text-sm h-[35px] text-sm max-sm:h-[31px]">
                    </div>
                </div>
                <button type="button" onclick="updateTable(); closeModal('filterModal')"
                    class="mt-4 bg-primary text-white tracking-widest uppercase px-4 py-2 rounded">
                    Apply
                </button>
            </form>
        </div>
    </div>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            FULL BOARD REVIEW
        </h2>
        <br>

        <!-- CSS NG FILTER + SEARCH BAR -->
        <div class="top-controls flex items-center justify-between max-md:flex-col">
            <!-- FUNCTIONALITY TO DISPLAY THE DATAS BASED ON DATE -->
            <div class="filter-box">
                Total Submission Count:
                <span class="font-bold" id="submissionCount"></span>
            </div>
            <div class="flex items-center max-sm:block max-sm:text-center max-md:mt-2">
                <button type="button" onclick="openModal('filterModal')"
                    class="material-symbols-outlined bg-primary text-white p-1.5 rounded">filter_alt</button>
                <div class="search-wrapper max-sm:mt-3 max-sm:justify-center max-sm:items-center"></div>
            </div>
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
                    <tr data-date="{{ $protocol->created_at->format('Y-m-d') }}">
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
                        <td>
                            {{ $protocol->created_at->format('m/d/Y') }}<br>
                            {{ $protocol->created_at->format('h:i:s A') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</x-superadmin-layout>
<script>
    // calendar filtering
    const fromDate = document.getElementById('fromDate');
    const toDate = document.getElementById('toDate');
    const rows = document.querySelectorAll("#myTable tbody tr");
    const countSpan = document.getElementById("submissionCount");

    function updateTable(selectedDate = "") {
        const from = fromDate.value;
        const to = toDate.value;

        let count = 0;

        rows.forEach(row => {
            const rowDate = row.getAttribute("data-date");

            let showRow = true;

            if (from && rowDate < from) {
                showRow = false;
            }

            if (to && rowDate > to) {
                showRow = false;
            }

            if (showRow) {
                row.style.display = "";
                count++;
            } else {
                row.style.display = "none";
            }
        });

        countSpan.textContent = count;
    }

    // Initial load
    updateTable();
</script>