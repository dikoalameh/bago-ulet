@section('title', 'Assigned Forms')
<x-erb-layout>
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
                    <!-- FILTER BY COLUMN -->
                    <div class="filter-box mt-4">
                        <label for="filter">Filter:</label>
                        <select id="filter"
                            class="w-full max-md:text-sm h-[35px] leading-[15px] max-sm:h-[31px] max-sm:leading-[11px]">
                            <option value="" selected disabled>All</option>
                            <option value="Date Registered">Date Registered</option>
                            <option value="Assigned Date">Assigned Date</option>
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
                <button type="button" onclick="updateTable(); closeSettingsModal('filterModal')"
                    class="mt-4 bg-primary text-white tracking-widest uppercase px-4 py-2 rounded">
                    Apply
                </button>
            </form>
        </div>
    </div>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            ASSIGNED FORMS
        </h2>
        <br>

        <!-- CSS NG FILTER + SEARCH BAR -->
        <div class="top-controls flex items-center justify-between max-md:flex-col">
            <!-- FUNCTIONALITY TO DISPLAY THE DATAS BASED ON DATE -->
            <div class="filter-box">
                Total Count:
                <span class="font-bold" id="submissionCount"></span>
            </div>
            <div class="flex items-center max-sm:block max-sm:text-center max-md:mt-2">
                <button type="button" onclick="openSettingsModal('filterModal')"
                    class="material-symbols-outlined bg-primary text-white p-1.5 rounded">filter_alt</button>
                <div class="search-wrapper max-sm:mt-3 max-sm:justify-center max-sm:items-center"></div>
            </div>
        </div>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th class="w-[25%]">P.I. Name</th>
                    <th class="w-[25%]">Date Registered</th>
                    <th class="w-[25%]">Assigned Forms</th> <!-- New column -->
                    <th class="w-[25%]">Assigned Date/Time</th> <!-- New column -->
                </tr>
            </thead>
            <tbody class="text-base/7 max-lg:text-sm/6">
                @foreach($approvedAccounts as $user)
                    <tr data-user-id="{{ $user->user_ID }}" data-date="{{ optional($user->created_at)->format('Y-m-d') }}"
                        data-assigned-date="{{ $user->forms && $user->forms->count() > 0 ? optional($user->forms->max(fn($form) => $form->pivot->created_at))->format('Y-m-d') : '' }}">
                        <td>{{ $user->user_Fname }} {{ $user->user_MI ? $user->user_MI : '' }} {{ $user->user_Lname }}</td>
                        <td>{{ optional($user->created_at)->format('m/d/Y h:i:s A') }}</td>
                        <td>
                            @if($user->forms && $user->forms->count() > 0)
                                <ul class="list-disc pl-5">
                                    @foreach($user->forms as $form)
                                        <li>{{ $form->form_code }}</li>
                                    @endforeach
                                </ul>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($user->forms && $user->forms->count() > 0)
                                @php
                                    // Get the latest timestamp from pivot table
                                    $latestTimestamp = $user->forms->max(function ($form) {
                                        return $form->pivot->created_at;
                                    });
                                @endphp
                                {{ $latestTimestamp ? \Carbon\Carbon::parse($latestTimestamp)->format('m/d/Y h:i:s A') : 'N/A' }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
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

    function updateTable() {
        const from = fromDate.value;
        const to = toDate.value;
        const filterColumn = document.getElementById("filter").value; // Get selected filter
        let count = 0;

        rows.forEach(row => {
            let rowDate;

            if (filterColumn === "Assigned Date") {
                rowDate = row.getAttribute("data-assigned-date");
            } else {
                // Default to Date Registered
                rowDate = row.getAttribute("data-date");
            }

            let showRow = true;

            if (from && rowDate < from) {
                showRow = false;
            }

            if (to && rowDate > to) {
                showRow = false;
            }

            row.style.display = showRow ? "" : "none";
            if (showRow) count++;
        });

        countSpan.textContent = count;
    }
    // Initial load
    updateTable();
</script>