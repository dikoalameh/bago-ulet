@section('title', 'Research Records')
<x-iacuc-layout>
    <div id="filterModal" onclick="outsideClick(event)"
        class="fixed inset-0 bg-black z-[9999] bg-opacity-50 hidden items-center justify-center overflow-auto overscroll-contain">
        <div class="relative flex items-center justify-center bg-white w-[400px] p-6 rounded-[10px] shadow-md">
            <form action="" class="w-full px-2">
                <div class="flex justify-between items-center mb-2">
                    <div class="text-xl font-bold">Filter</div>
                    <button type="button" onclick="closeSettingsModal('filterModal')" class="material-symbols-outlined">
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
                <button type="button" onclick="updateTable(); closeSettingsModal('filterModal')"
                    class="mt-4 bg-primary text-white tracking-widest uppercase px-4 py-2 rounded">
                    Apply
                </button>
            </form>
        </div>
    </div>
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            RESEARCH RECORDS
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
                <button type="button" onclick="openSettingsModal('filterModal')"
                    class="material-symbols-outlined bg-primary text-white p-1.5 rounded">filter_alt</button>
                <div class="search-wrapper max-sm:mt-3 max-sm:justify-center max-sm:items-center"></div>
            </div>
        </div>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <!-- Table header -->
            <thead class="bg-primary text-white text-lg/7 max-sm:text-base/7">
                <tr class="header-table">
                    <th class="w-[10%]">Research Title</th>
                    <th class="w-[10%]">P.I. Name</th>
                    <th class="w-[10%]">Date of Submission</th>
                    <th class="w-[10%]">Protocol No.</th>
                    <th class="w-[10%]">Review Type</th>
                    <th class="w-[10%]">Reviewer no. 1</th>
                    <th class="w-[10%]">Status of Review</th>
                    <th class="w-[10%]">Reviewer no. 2</th>
                    <th class="w-[10%]">Status of Review</th>
                    <th class="w-[10%]">Decision</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                @foreach($researchRecords as $research)
                    @php
                        $firstReview = optional($research->user->initialReviews->first());
                        $protocol = optional($firstReview->protocol)->protocol_ID ?? 'N/A';
                        $reviewType = optional($firstReview->protocol)->review_type ?? 'N/A';
                        $reviewer1 = optional($firstReview->reviewer1)->full_name ?? 'N/A';
                        $status1 = $firstReview->status ?? 'Ongoing';
                        $reviewer2 = optional($firstReview->reviewer2)->full_name ?? 'N/A';
                        $status2 = optional($research->user->initialReviews->skip(1)->first())->status ?? 'Ongoing';
                        $decision = optional($research->user->approved->first())->Decision ?? 'Ongoing';
                        $latestSubmission = $research->user->researchFiles->max('submitted_at');
                    @endphp

                    <tr>
                        <td>{{ $research->research_title }}</td>
                        <td>
                            <a href="{{ route('iacuc.submitted-documents', $research->user->user_ID) }}">{{ $research->user->full_name }}</a>
                        </td>
                        <td>
                            @if($latestSubmission)
                                {{ \Carbon\Carbon::parse($latestSubmission)->timezone(config('app.timezone'))->format('m/d/Y') }}<br>
                                {{ \Carbon\Carbon::parse($latestSubmission)->timezone(config('app.timezone'))->format('h:i:s A') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $protocol }}</td>
                        <td>{{ $reviewType }}</td>
                        <td>{{ $reviewer1 }}</td>
                        <td>{{ $status1 }}</td>
                        <td>{{ $reviewer2 }}</td>
                        <td>{{ $status2 }}</td>
                        <td>{{ $decision }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</x-iacuc-layout>
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