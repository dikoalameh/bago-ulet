@section('title', 'Approved Accounts')
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
                    <!-- CALENDAR FILTERING FOR THE COUNT OF SUBMISSION -->
                    <div class="mt-4">
                        <label for="fromDate">From:</label>
                        <input type="date" id="fromDate" class="w-full max-md:text-sm h-[35px] text-sm max-sm:h-[31px]">
                    </div>
                    <div class="mt-4">
                        <label for="toDate">To:</label>
                        <input type="date" id="toDate" class="w-full max-md:text-sm h-[35px] text-sm max-sm:h-[31px]">
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
            APPROVED ACCOUNTS
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
                <button type="button" onclick="openSettingsModal('filterModal')"
                    class="material-symbols-outlined bg-primary text-white p-1.5 rounded">filter_alt</button>
                <div class="search-wrapper max-sm:mt-3 max-sm:justify-center max-sm:items-center"></div>
            </div>
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
                    <tr data-date="{{ $user->created_at ? $user->created_at->format('Y-m-d') : '' }}"
                        data-user-id="{{ $user->user_ID }}"
                        data-assigned-forms="{{ $user->forms->pluck('form_id')->toJson() }}">
                        <td>
                            <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="{{ $user->user_ID }}"
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
                            {{ $user->created_at ? $user->created_at->format('h:i:s A') : '' }}
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
                <div class="forms-assign bg-lightgray p-4 shadow-md rounded-md">
                    <h3 class="text-lg font-semibold max-md:text-base mb-3">Assignment of Forms</h3>
                    <div
                        class="flex h-40 max-md:h-28 overflow-y-auto grid grid-cols-3 max-sm:grid-cols-2 gap-y-3 gap-x-3 font-semibold max-md:text-sm">
                        @foreach ($selectForms as $form)
                            <div class="room cursor-pointer bg-gray hover:bg-darkgray px-3 py-2 rounded-md"
                                data-room="{{ $form->form_id }}" data-view="{{ $form->form_view }}">
                                {{ $form->form_code }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Display -->
                <div class="assigned-formsbg-lightgray p-4 shadow-md rounded-md">
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
    // calendar filtering
    const fromDate = document.getElementById('fromDate');
    const toDate = document.getElementById('toDate');
    const rows = document.querySelectorAll("#myTable tbody tr");
    const countSpan = document.getElementById("submissionCount");

    function updateTable(selectedDate = "") {
        const from = fromDate.value;
        const to = toDate.value;

        let count = 0;

        rows.forEach(row => {
            const rowDate = row.getAttribute("data-date");

            let showRow = true;

            if (from && rowDate < from) {
                showRow = false;
            }

            if (to && rowDate > to) {
                showRow = false;
            }

            if (showRow) {
                row.style.display = "";
                count++;
            } else {
                row.style.display = "none";
            }
        });

        countSpan.textContent = count;
    }

    // Initial load
    updateTable();

    const rooms = document.querySelectorAll(".room");
    const assignedList = document.getElementById("assignedList");
    const submitBtn = document.getElementById("submitBtn");

    // Store already assigned forms and forms to be assigned
    let alreadyAssignedForms = [];
    let formsToAssign = [];
    let selectedUsers = [];

    // Add/remove forms to the assigned list
    rooms.forEach(room => {
        room.addEventListener("click", () => {
            // ✅ CHECK: Don't allow clicking if form is disabled
            if (room.classList.contains('disabled-form')) {
                return;
            }

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
            validateSubmitButton(); // ✅ ADDED: Validate button state
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

    // ✅ ADDED: Validate submit button state
    function validateSubmitButton() {
        const hasSelectedUsers = selectedUsers.length > 0;
        const hasFormsToAssign = formsToAssign.length > 0;

        submitBtn.disabled = !(hasSelectedUsers && hasFormsToAssign);
    }

    // ✅ ADDED: Disable forms that are already assigned to selected users
    function updateFormAvailability() {
        // Reset all forms first
        rooms.forEach(room => {
            room.classList.remove('disabled-form', 'cursor-not-allowed', 'opacity-50');
            room.style.pointerEvents = 'auto';
        });

        // If users are selected, disable their already assigned forms
        if (selectedUsers.length > 0) {
            const assignedFormIds = alreadyAssignedForms.map(form => form.id);

            rooms.forEach(room => {
                const formId = room.dataset.room;
                if (assignedFormIds.includes(formId)) {
                    room.classList.add('disabled-form', 'cursor-not-allowed', 'opacity-50');
                    room.style.pointerEvents = 'none';

                    // Also remove from formsToAssign if it was previously selected
                    const index = formsToAssign.findIndex(form => form.id === formId);
                    if (index > -1) {
                        formsToAssign.splice(index, 1);
                        room.classList.remove("bg-darkgray");
                        room.classList.add("bg-gray");
                    }
                }
            });
        }

        updateAssignedFormsDisplay();
        validateSubmitButton();
    }

    // Submit assigned forms
    submitBtn.addEventListener("click", (e) => {
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
                    selectedUsers = [];

                    // Reset form colors and enable all forms
                    rooms.forEach(room => {
                        room.classList.remove("bg-darkgray", "disabled-form", "cursor-not-allowed", "opacity-50");
                        room.classList.add("bg-gray");
                        room.style.pointerEvents = 'auto';
                    });

                    // Update display
                    updateAssignedFormsDisplay();

                    // Uncheck all users
                    document.querySelectorAll(".user-checkbox").forEach(cb => {
                        cb.checked = false;
                    });

                    // Update button state
                    validateSubmitButton();
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
                // Add user to selected users
                selectedUsers.push(userId);

                // Load already assigned forms for this user from data attribute
                const assignedFormsJson = cb.getAttribute('data-assigned-forms');
                const assignedFormIds = assignedFormsJson ? JSON.parse(assignedFormsJson) : [];

                // Get form details for assigned form IDs
                loadAlreadyAssignedForms(assignedFormIds);
            } else {
                // Remove user from selected users
                selectedUsers = selectedUsers.filter(id => id !== userId);

                // Clear already assigned forms if no users are selected
                if (selectedUsers.length === 0) {
                    alreadyAssignedForms = [];
                } else {
                    // Recalculate already assigned forms for remaining selected users
                    recalculateAlreadyAssignedForms();
                }
            }

            // ✅ ADDED: Update form availability based on selected users
            updateFormAvailability();
        });
    });

    // Function to load already assigned forms
    function loadAlreadyAssignedForms(assignedFormIds) {
        // Add new assigned forms to the list
        assignedFormIds.forEach(formId => {
            const formElement = document.querySelector(`.room[data-room="${formId}"]`);
            if (formElement && !alreadyAssignedForms.some(form => form.id === formId)) {
                alreadyAssignedForms.push({
                    id: formId,
                    code: formElement.textContent
                });
            }
        });
    }

    // ✅ ADDED: Recalculate already assigned forms when users are deselected
    function recalculateAlreadyAssignedForms() {
        alreadyAssignedForms = [];

        // Get all selected users' assigned forms
        const selectedCheckboxes = document.querySelectorAll(".user-checkbox:checked");
        selectedCheckboxes.forEach(cb => {
            const assignedFormsJson = cb.getAttribute('data-assigned-forms');
            const assignedFormIds = assignedFormsJson ? JSON.parse(assignedFormsJson) : [];

            assignedFormIds.forEach(formId => {
                const formElement = document.querySelector(`.room[data-room="${formId}"]`);
                if (formElement && !alreadyAssignedForms.some(form => form.id === formId)) {
                    alreadyAssignedForms.push({
                        id: formId,
                        code: formElement.textContent
                    });
                }
            });
        });
    }

    // ✅ ADDED: Initialize button state
    validateSubmitButton();
</script>

<style>
    /* ✅ ADDED: Styles for disabled forms */
    .disabled-form {
        background-color: #d1d5db !important;
        /* gray-300 */
        color: #9ca3af !important;
        /* gray-400 */
        cursor: not-allowed !important;
        opacity: 0.5;
    }

    .disabled-form:hover {
        background-color: #d1d5db !important;
        /* gray-300 */
        color: #9ca3af !important;
        /* gray-400 */
    }
</style>