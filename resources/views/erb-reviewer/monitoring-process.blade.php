@section('title','Monitoring Process')
<x-erb-reviewer>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            MONITORING PROCESS
        </h2>
        <br>

        <!-- CSS NG FILTER + SEARCH BAR -->
        <div class="top-controls flex items-center max-md:flex-col">
            <div class="search-wrapper max-sm:mt-3 max-sm:justify-center max-sm:items-center"></div>
        </div>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <!-- Table header -->
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th>Description</th>
                    <th>Process Date</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                @forelse($processes as $process)
                <tr>
                    <td>{{ $process['description'] }}</td>
                    <td>
                        {{ $process['date'] }}<br>
                        {{ $process['time'] }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center py-4">No process records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</x-erb-reviewer>
<script>
     $(document).ready(function () {
        // Only initialize if not already initialized
        if (!$.fn.dataTable.isDataTable('#myTable')) {
            const table = new DataTable('#myTable', {
                responsive: true,
                paging: false,
                scrollY: '300px',
                order: [[1, 'desc']] // Sort by Process Date descending
            });

            // ✅ Move the DataTables search bar into our custom search-wrapper
            const dtSearch = $('div.dt-search');
            $('.search-wrapper').append(dtSearch);

            // ✅ Build dropdown filter dynamically
            const descriptions = [...new Set(table.column(0).data().toArray())].sort();
            const select = $('#officeFilter');
            descriptions.forEach(d => select.append(`<option value="${d}">${d}</option>`));

            // ✅ Apply filter to Description column
            select.on('change', function () {
                const val = $.fn.dataTable.util.escapeRegex($(this).val());
                table.column(0).search(val ? '^' + val + '$' : '', true, false).draw();
            });
        }
    });
</script>