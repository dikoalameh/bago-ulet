@section('title','Monitoring Process')
<x-erb-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            MONITORING PROCESS
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
                    <th class="w-[20%]">User Name</th>
                    <th class="w-[20%]">Research Title</th>
                    <th class="w-[15%]">User Type</th>
                    <th class="w-[20%]">Process Date</th>
                    <th class="w-[25%]">Description</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                @forelse($processes as $process)
                <tr>
                    <td>{{ $process['pi_name'] }}</td>
                    <td>{{ $process['research_title'] }}</td>
                    <td>{{ $process['account_type'] }}</td>
                    <td>
                        {{ $process['date'] }}<br>
                        {{ $process['time'] }}
                    </td>
                    <td>
                        {{ $process['description'] }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No process records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</x-erb-layout>