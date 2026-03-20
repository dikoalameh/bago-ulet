@section('title', 'Protocol Decision')
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
                    <!-- FILTER BY COLUMN -->
                    <div class="filter-box mt-4">
                        <label for="filter">Filter:</label>
                        <select id="filter"
                            class="w-full max-md:text-sm h-[35px] leading-[15px] max-sm:h-[31px] max-sm:leading-[11px]">
                            <option value="" selected disabled>All</option>
                            <option value="Date Submitted">Date Submitted</option>
                            <option value="Review Date">Review Date</option>
                        </select>
                    </div>
                    <!-- CALENDAR FILTERING FOR THE COUNT OF SUBMISSION -->
                    <div class="filter-box mt-4 flex items-center gap-x-2">
                        <div>
                            <label for="fromDate">From:</label>
                            <input type="date" id="fromDate"
                                class="w-full max-md:text-sm h-[35px] text-sm max-sm:h-[31px]">
                        </div>
                        <div>
                            <label for="toDate">To:</label>
                            <input type="date" id="toDate"
                                class="w-full max-md:text-sm h-[35px] text-sm max-sm:h-[31px]">
                        </div>
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
            PROTOCOL DECISION
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
                    <th class="w-[14.28%]">Protocol ID</th>
                    <th class="w-[14.28%]">Research Title</th>
                    <th class="w-[14.28%]">P.I. Name</th>
                    <th class="w-[14.28%]">Co-Investigator</th>
                    <th class="w-[14.28%]">Status</th>
                    <th class="w-[14.28%]">Date Submitted</th>
                    <th class="w-[14.28%]">Review Date</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                @forelse($evaluatedProtocols as $review)
                    <tr data-submitted="{{ $review->date_submitted }}" data-review="{{ $review->review_date }}">
                        <!-- Protocol ID with checkbox (moved to first column) -->
                        <td>
                            <span>{{ $review->protocol_ID }}</span>
                        </td>

                        <!-- Research Title -->
                        <td>{{ $review->research_title }}</td>

                        <!-- Principal Investigator Name -->
                        <td>{{ $review->user_Fname }}</td>

                        <td>{{ $review->co_investigator }}</td>

                        <!-- Status -->
                        <td>{{ $review->status ?? 'Pending' }}</td>

                        <!-- Date Submitted -->
                        <td>
                            @if($review->date_submitted)
                                {{ \Carbon\Carbon::parse($review->date_submitted)->format('m/d/Y') }}<br>
                                {{ \Carbon\Carbon::parse($review->date_submitted)->format('h:i:s A') }}
                            @else
                                N/A
                            @endif
                        </td>

                        <!-- Review Date -->
                        <td>
                            @if($review->review_date)
                                {{ \Carbon\Carbon::parse($review->review_date)->format('m/d/Y') }}<br>
                                {{ \Carbon\Carbon::parse($review->review_date)->format('h:i:s A') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </main>
</x-superadmin-layout>
<script>
    function updateTable() {

        const filterType = document.getElementById("filter").value;
        const from = document.getElementById("fromDate").value;
        const to = document.getElementById("toDate").value;
        const rows = document.querySelectorAll("#myTable tbody tr");

        rows.forEach(row => {

            let rowDate = "";

            if (filterType === "Date Submitted") {
                rowDate = row.getAttribute("data-submitted");
            }

            if (filterType === "Review Date") {
                rowDate = row.getAttribute("data-review");
            }

            if (!rowDate) {
                row.style.display = "none";
                return;
            }

            const date = rowDate.split(" ")[0]; // remove time

            let showRow = true;

            if (from && date < from) {
                showRow = false;
            }

            if (to && date > to) {
                showRow = false;
            }

            if (showRow) {
                row.style.display = "";
                count++; // ✅ increment visible rows
            } else {
                row.style.display = "none";
            }

        });
    }
    document.addEventListener("DOMContentLoaded", function () {
        const rows = document.querySelectorAll("#myTable tbody tr");
        document.getElementById("submissionCount").textContent = rows.length
    })
</script>