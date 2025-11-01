@section('title', 'Approved Accounts')
<x-erb-layout>
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
            <!-- Main Layout -->
            <div class="flex mx-4 gap-6 grid grid-cols-2 max-md:grid-cols-1">
                <!-- Left Selection -->
                <div class="bg-lightgray p-4 shadow-md rounded-md">
                    <h3 class="text-lg font-semibold max-md:text-base mb-3">Assignment of Forms</h3>
                    <div class="flex h-40 max-md:h-28 overflow-y-auto grid grid-cols-3 max-sm:grid-cols-2 gap-y-3 gap-x-3 font-semibold max-md:text-sm">
                        @foreach ($selectForms as $form)
                            <div class="room cursor-pointer bg-gray hover:bg-darkgray px-3 py-2 rounded-md"
                                data-room="{{ $form->form_id }}" data-view="{{ $form->form_view }}">
                                {{ $form->form_code }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Display -->
                <div class="bg-lightgray p-4 shadow-md rounded-md">
                    <h3 class="text-lg font-semibold max-md:text-base mb-3">Assigned Forms</h3>
                    <ul id="assignedList"
                        class="list-disc h-40 max-md:h-28 overflow-y-auto mx-2 pl-6 pt-2 flex grid grid-cols-3 max-sm:grid-cols-2 gap-x-2 gap-y-3 max-md:text-sm">
                        <!-- Already assigned forms and forms to be assigned will appear here -->
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
</x-erb-layout>
<script>
    const rooms = document.querySelectorAll(".room");
    const assignedList = document.getElementById("assignedList");
    const submitBtn = document.getElementById("submitBtn");

    // Store already assigned forms and forms to be assigned
    let alreadyAssignedForms = [];
    let formsToAssign = [];

    // Add/remove forms to the assigned list
    rooms.forEach(room => {
        room.addEventListener("click", () => {
            const formId = room.dataset.room;
            const formCode = room.textContent;
            
            // Check if form is already in formsToAssign
            const existingIndex = formsToAssign.findIndex(form => form.id === formId);
            
            if (existingIndex > -1) {
                // Remove from forms to assign
                formsToAssign.splice(existingIndex, 1);
                room.classList.remove("bg-darkgray");
                room.classList.add("bg-gray");
            } else {
                // Add to forms to assign
                formsToAssign.push({ id: formId, code: formCode });
                room.classList.add("bg-darkgray");
                room.classList.remove("bg-gray");
            }
            
            updateAssignedFormsDisplay();
        });
    });

    // Update the assigned forms display
    function updateAssignedFormsDisplay() {
        assignedList.innerHTML = '';
        
        // Display already assigned forms (gray color)
        alreadyAssignedForms.forEach(form => {
            const li = document.createElement("li");
            li.textContent = form.code;
            li.classList.add('text-gray-500'); // Gray color for already assigned
            li.setAttribute('data-room', form.id);
            assignedList.appendChild(li);
        });
        
        // Display forms to be assigned (normal color)
        formsToAssign.forEach(form => {
            const li = document.createElement("li");
            li.textContent = form.code;
            li.setAttribute('data-room', form.id);
            assignedList.appendChild(li);
        });
    }

    // Submit assigned forms
    submitBtn.addEventListener("click", (e) => {
        const selectedUsers = [...document.querySelectorAll(".user-checkbox:checked")].map(cb => cb.value);
        const selectedForms = formsToAssign.map(form => form.id);

        if (selectedUsers.length === 0 || selectedForms.length === 0) {
            alert("Please select at least one user and one form.");
            return;
        }

        fetch("{{ route('assign.forms.ajax') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                user_ids: selectedUsers,
                form_ids: selectedForms
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);

                    // Reset everything
                    formsToAssign = [];
                    alreadyAssignedForms = [];
                    
                    // Reset form colors
                    rooms.forEach(room => {
                        room.classList.remove("bg-darkgray");
                        room.classList.add("bg-gray");
                    });
                    
                    // Update display
                    updateAssignedFormsDisplay();
                    
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

    // When user checkbox is clicked, load their already assigned forms
    const userCheckboxes = document.querySelectorAll(".user-checkbox");
    userCheckboxes.forEach(cb => {
        cb.addEventListener("change", () => {
            const userId = cb.value;
            
            if (cb.checked) {
                // Load already assigned forms for this user from data attribute
                const assignedFormsJson = cb.getAttribute('data-assigned-forms');
                const assignedFormIds = assignedFormsJson ? JSON.parse(assignedFormsJson) : [];
                
                // Get form details for assigned form IDs
                loadAlreadyAssignedForms(assignedFormIds);
            } else {
                // Clear already assigned forms if no users are selected
                const selectedUsers = [...document.querySelectorAll(".user-checkbox:checked")].map(cb => cb.value);
                if (selectedUsers.length === 0) {
                    alreadyAssignedForms = [];
                    updateAssignedFormsDisplay();
                }
            }
        });
    });

    // Function to load already assigned forms
    function loadAlreadyAssignedForms(assignedFormIds) {
        alreadyAssignedForms = [];
        
        // Find form details for each assigned form ID
        assignedFormIds.forEach(formId => {
            const formElement = document.querySelector(`.room[data-room="${formId}"]`);
            if (formElement) {
                alreadyAssignedForms.push({
                    id: formId,
                    code: formElement.textContent
                });
            }
        });
        
        updateAssignedFormsDisplay();
    }
</script>