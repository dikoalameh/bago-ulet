@section('title','Final Completion')
<x-superadmin-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            FINAL COMPLETION
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
                    <th class="w-[16.66%]">Protocol ID</th>
                    <th class="w-[16.66%]">P.I. Name</th>
                    <th class="w-[16.66%]">Co-I. Name(s)</th>
                    <th class="w-[16.66%]">Research Title</th>
                    <th class="w-[16.66%]">Status</th>
                    <th class="w-[16.66%]">Date and Time</th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                <tr>
                    <td>001</td>
                    <td>John Doe</td>
                    <td>Cardo Dalisay, Juan Dela Cruz</td>
                    <td>MCU-RRS</td>
                    <td>Pending</td>
                    <td>10/21/25<br>22:05:20</td>
                </tr>
            </tbody>
        </table>
    </main>
</x-superadmin-layout>