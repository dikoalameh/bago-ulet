@section('title','Submitted Inquiries')
<x-erb-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            SUBMITTED INQUIRIES
        </h2>
        <br>

        <!-- CSS NG SEARCH BAR -->
        <div class="top-controls">
            <div class="search-wrapper mt-1 flex max-sm:justify-center max-sm:items-center"></div>
        </div>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th class="w-[20%]">P.I. Name</th>
                    <th class="w-[20%]">Research Title</th>
                    <th class="w-[20%]">Subject</th>
                    <th class="w-[20%]">Date Submitted</th>
                    <th class="w-[20%]">View</th>
                </tr>
            </thead>
            <tbody class="text-base/7 max-lg:text-sm/6">
                @forelse($inquiries as $inquiry)
                <tr>
                    <td>{{ $inquiry['pi_name'] }}</td>
                    <td>{{ $inquiry['research_title'] }}</td>
                    <td>{{ $inquiry['subject'] }}</td>
                    <td>
                        {!! $inquiry['date_submitted'] !!}
                    </td>
                    <td>
                        <a href="{{ url('erb/tickets/' . $inquiry['ticket_id']) }}">
                            <button type="button" class="border-2 p-[5px] hover:bg-gray">
                                View
                            </button>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No submitted inquiries found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</x-erb-layout>