@section('title', 'Approved Accounts')
<x-iacuc-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            APPROVED ACCOUNTS
        </h2>
        <br>

        <!-- CSS NG FILTER + SEARCH BAR -->
        <div class="top-controls flex items-center max-md:flex-col">
            <div class="filter-wrapper items-center gap-x-2 max-sm:justify-center max-sm:items-center">
                <label for="officeFilter">Filter:</label>
                <select id="officeFilter"
                    class="w-32 max-md:text-sm h-[35px] leading-[15px] max-sm:h-[31px] max-sm:leading-[11px]">
                    <option value="">All</option>
                </select>
            </div>
            <div class="search-wrapper max-sm:mt-3 max-sm:justify-center max-sm:items-center"></div>
        </div>
        
        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <!-- Table header -->
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th class="w-[20.00%]">P.I. Name</th>
                    <th class="w-[20.00%]">Department</th>
                    <th class="w-[20.00%]">Research Title</th>
                    <th class="w-[20.00%]">Registration Date</th>
                    <th class="w-[20.00%]">Status</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-base/7 max-lg:text-sm/6">
                @foreach($approvedAccounts as $user)
                    <tr data-user-id="{{ $user->user_ID }}" data-assigned-forms="{{ $user->forms->pluck('form_id')->toJson() }}">
                        <td>
                            <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1"
                                value="{{ $user->user_ID }}" 
                                data-name="{{ $user->user_Fname }} {{ $user->user_Lname }}"
                                data-assigned-forms="{{ $user->forms->pluck('form_id')->toJson() }}">
                            <span>{{ $user->user_Fname }} {{ $user->user_Lname }}</span>
                            @if($user->forms->isNotEmpty())
                                <span class="text-xs text-green-600">(Has {{ $user->forms->count() }} forms)</span>
                            @endif
                        </td>
                        <td>{{ $user->researchInformation?->research_department ?? 'N/A' }}</td>
                        <td>{{ $user->researchInformation?->research_title ?? 'N/A' }}</td>
                        <td>
                            {{ $user->created_at ? $user->created_at->format('m/d/Y') : 'N/A' }}<br>
                            {{ $user->created_at ? $user->created_at->format('H:i:s') : '' }}
                        </td>
                        <td>{{ $user->classifications?->classificationStatus ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Main Layout -->
        @if($approvedAccounts->isNotEmpty())
            <!-- Main Layout - Single column now -->
            <div class="flex mx-4 gap-6">
                <!-- Selected Students Display Only -->
                <div class="bg-lightgray p-4 shadow-md rounded-md w-full">
                    <h3 class="text-lg font-semibold max-md:text-base mb-3">Selected Students</h3>
                    <ul id="selectedStudentsList"
                        class="list-disc h-40 max-md:h-28 overflow-y-auto mx-2 pl-6 pt-2 flex flex-col gap-y-2 max-md:text-sm">
                        <!-- Selected students will appear here -->
                    </ul>
                </div>
            </div>

            <!-- Button Outside, Right-Aligned -->
            <div class="flex justify-end mt-4 mx-4">
                <button id="submitBtn"
                    class="bg-secondary hover:bg-primary text-primary hover:text-secondary px-4 py-3 rounded-md uppercase tracking-widest duration-200"
                    type="button">
                    Submit
                </button>
            </div>
        @else
            <div class="text-center p-6 bg-lightgray rounded-md text-gray-500 mt-6">
                ⚠ No approved accounts available for form assignment.
            </div>
        @endif
    </main>
</x-iacuc-layout>

<script>
    const selectedStudentsList = document.getElementById("selectedStudentsList");
    const submitBtn = document.getElementById("submitBtn");

    // Store selected students
    let selectedStudents = [];

    // Update the selected students display
    function updateSelectedStudentsDisplay() {
        selectedStudentsList.innerHTML = '';
        
        // Display selected students
        selectedStudents.forEach(student => {
            const li = document.createElement("li");
            li.textContent = student.name;
            li.setAttribute('data-user-id', student.id);
            selectedStudentsList.appendChild(li);
        });
    }

    // Submit functionality (you may need to adjust this based on what you want to do with selected students)
    submitBtn.addEventListener("click", (e) => {
        const selectedUsers = [...document.querySelectorAll(".user-checkbox:checked")].map(cb => cb.value);

        if (selectedUsers.length === 0) {
            alert("Please select at least one student.");
            return;
        }

        // You can modify this part based on what you want to do with the selected students
        fetch("{{ route('assign.default.forms.ajax') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                user_ids: selectedUsers
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);

                    // Reset everything
                    selectedStudents = [];
                    
                    // Update display
                    updateSelectedStudentsDisplay();
                    
                    // Uncheck all users
                    document.querySelectorAll(".user-checkbox").forEach(cb => {
                        cb.checked = false;
                    });
                } else {
                    alert("Something went wrong.");
                }
            })
            .catch(err => console.error("Fetch error:", err));
    });

    // When user checkbox is clicked, update selected students list
    const userCheckboxes = document.querySelectorAll(".user-checkbox");
    userCheckboxes.forEach(cb => {
        cb.addEventListener("change", () => {
            const userId = cb.value;
            const userName = cb.getAttribute('data-name');
            
            if (cb.checked) {
                // Add to selected students
                selectedStudents.push({
                    id: userId,
                    name: userName
                });
            } else {
                // Remove from selected students
                selectedStudents = selectedStudents.filter(student => student.id !== userId);
            }
            
            updateSelectedStudentsDisplay();
        });
    });
</script>