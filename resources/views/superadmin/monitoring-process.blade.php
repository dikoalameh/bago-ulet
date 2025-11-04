@section('title', 'Monitoring Process')
<x-superadmin-layout>
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
                    <th class="w-[17%]">User Name</th>
                    <th class="w-[13%]">Research Title</th>
                    <th class="w-[17%]">Type of Account</th>
                    <th class="w-[13%]">Process Date</th>
                    <th class="w-[40%]">Description</th>
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
                        <td class="break-normal">
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
</x-superadmin-layout>