@section('title','Monitoring Process')
<x-erb-layout>
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
                    <th class="w-[25%]">P.I. Name</th>
                    <th class="w-[25%]">Research Title</th>
                    <th class="w-[25%]">Process Date</th>
                    <th class="w-[25%]">Description</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                <tr>
                    <td>John Doe</td>
                    <td>MCU-RRS</td>
                    <td>
                        10/22/25<br>
                        22:30:50
                    </td>
                    <td>
                        Received classified (erb/iacuc)
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</x-erb-layout>