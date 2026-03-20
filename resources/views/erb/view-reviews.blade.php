@section('title', 'View Reviews')
<x-erb-layout>
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
                <button type="button" onclick="updateTable(); closeModal('filterModal')" class="mt-4 bg-primary text-white tracking-widest uppercase px-4 py-2 rounded">
                    Apply
                </button>
            </form>
        </div>
    </div>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            VIEW REVIEWS
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
                    <th class="w-[14%]">Research Protocol</th>
                    <th class="w-[20%]">Research Title</th>
                    <th class="w-[14%]">P.I. Name</th>
                    <th class="w-[16%]">Co-I. Name(s)</th>
                    <th class="w-[14%]">Reviewer</th>
                    <th class="w-[10%]">View</th>
                    <th class="w-[12%]">Date Submitted</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                @forelse ($evaluatedReviews as $review)
                    <tr data-date="{{ $review->created_at->format('Y-m-d') }}">
                        <td>{{ $review->protocol->protocol_ID ?? 'N/A' }}</td>

                        <td>{{ $review->protocol->researchInformation->research_title ?? 'Untitled' }}</td>

                        <td>
                            {{ $review->protocol->researchInformation->user->user_Fname ?? 'N/A' }}
                            {{ $review->protocol->researchInformation->user->user_Lname ?? '' }}
                        </td>

                        <td>
                            @php
                                $coInvestigators = $review->protocol->researchInformation->research_CoInvestigator;
                            @endphp
                            {{ $coInvestigators ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $review->reviewer->user_Fname ?? 'N/A' }}
                            {{ $review->reviewer->user_Lname ?? '' }}
                        </td>

                        <td>
                            @if($review->reviewer_ID)
                                <a
                                    href="{{ route('erb.view-review-files', ['protocolId' => $review->protocol_ID, 'reviewerId' => $review->reviewer_ID]) }}">
                                    <button class="border-2 p-[5px] hover:bg-gray">View</button>
                                </a>
                            @else
                                N/A
                            @endif
                        </td>

                        <td>
                            {{ $review->created_at->format('m/d/Y') }}<br>
                            {{ $review->created_at->format('h:i:s A') }}
                            <br>
                            <span class="text-sm text-gray-600 italic">
                                ({{ $review->status }})
                            </span>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </main>
</x-erb-layout>
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