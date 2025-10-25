@section('title', 'Resubmission')
<x-erb-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            RESUBMISSION
        </h2>
        <br>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th class="w-[33.33%]">P.I. Name</th>
                    <th class="w-[33.33%]">Research Title</th>
                    <th class="w-[33.33%]">Date Assigned</th>
                </tr>
            </thead>
            <tbody class="text-base/7 max-lg:text-sm/6">
                @forelse($approvedProtocols as $approved)
                    <tr>
                        <td>
                            <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1"
                                data-user-id="{{ $approved->user_ID }}" 
                                data-protocol-id="{{ $approved->Protocol_ID }}"
                                data-user-name="{{ trim(($approved->user->user_Fname ?? '') . ' ' . ($approved->user->user_MI ?? '') . ' ' . ($approved->user->user_Lname ?? '')) }}">
                            <span>
                                {{ $approved->user->user_Fname ?? '' }}
                                {{ $approved->user->user_MI ?? '' }}
                                {{ $approved->user->user_Lname ?? '' }}
                            </span>
                        </td>
                        <td>
                            {{ $approved->protocol->researchInformation->research_title ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $approved->created_at->format('m/d/Y') }}<br>
                            {{ $approved->created_at->format('H:i:s') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No approved protocols found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Selected Users -->
        <div class="flex mx-4 gap-6 grid mt-6">
            <div class="bg-lightgray p-4 shadow-md rounded-md">
                <h3 class="font-semibold text-lg max-md:text-base mb-3">SELECTED PROTOCOLS FOR ASSIGNMENT</h3>
                <div class="h-24 overflow-y-auto">
                    <ul id="selectedUsers"
                        class="list-disc pl-5 flex grid grid-cols-4 max-md:grid-cols-1 max-md:text-sm"></ul>
                </div>
            </div>
            <div class="flex justify-start max-md:justify-center mx-4">
                <button id="submitBtn"
                    class="bg-secondary hover:bg-primary text-primary hover:text-secondary px-4 py-3 rounded-md uppercase tracking-widest duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                    type="button" disabled>
                    Assign
                </button>
            </div>
        </div>
    </main>
</x-erb-layout>

<script>
    $(document).ready(function () {
        const userCheckboxes = document.querySelectorAll(".user-checkbox");
        const selectedUsersList = document.getElementById("selectedUsers");
        const submitBtn = document.getElementById("submitBtn");

        // Function to update selected users list
        function updateSelectedList() {
            const selectedItems = Array.from(selectedUsersList.querySelectorAll('li[data-user-id]'));
            submitBtn.disabled = selectedItems.length === 0;

            if (selectedItems.length === 0) {
                selectedUsersList.innerHTML = '<li class="text-gray-500">No protocols selected</li>';
            }
        }

        // Add event listeners to checkboxes
        userCheckboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                const userId = this.getAttribute('data-user-id');
                const protocolId = this.getAttribute('data-protocol-id');
                const userName = this.getAttribute('data-user-name') || 
                               this.closest('td').querySelector('span').textContent.trim();
                
                console.log('Checkbox changed:', { userId, protocolId, userName });

                const existing = selectedUsersList.querySelector(`[data-user-id="${userId}"][data-protocol-id="${protocolId}"]`);

                if (this.checked && !existing) {
                    const li = document.createElement("li");
                    li.className = "text-sm mb-1";
                    li.textContent = `${userName} (Protocol: ${protocolId})`;
                    li.setAttribute("data-user-id", userId);
                    li.setAttribute("data-protocol-id", protocolId);

                    const emptyState = selectedUsersList.querySelector('.text-gray-500');
                    if (emptyState) {
                        emptyState.remove();
                    }

                    selectedUsersList.appendChild(li);
                    console.log('Added to list:', { userId, protocolId });
                } else if (!this.checked && existing) {
                    existing.remove();
                    console.log('Removed from list:', { userId, protocolId });
                }

                updateSelectedList();
            });
        });

        // Submit button functionality
        submitBtn.addEventListener('click', function () {
            const selectedItems = Array.from(selectedUsersList.querySelectorAll('li[data-user-id]'));

            if (selectedItems.length === 0) {
                alert('Please select at least one protocol to assign.');
                return;
            }

            // Prepare data - keep as strings since that's what your database uses
            const selectedData = selectedItems.map(li => {
                const userId = li.getAttribute('data-user-id');
                const protocolId = li.getAttribute('data-protocol-id');
                
                console.log('Processing item:', { userId, protocolId });
                
                // Validate that we have values
                if (!userId || !protocolId) {
                    console.error('Missing data:', { userId, protocolId });
                    return null;
                }
                
                return {
                    user_id: userId,
                    protocol_id: protocolId
                };
            }).filter(item => item !== null);

            console.log('Final data being sent:', selectedData);

            if (selectedData.length === 0) {
                alert('No valid protocols selected.');
                return;
            }

            // Disable button during processing
            const originalText = this.textContent;
            this.disabled = true;
            this.textContent = 'Assigning...';

            // Send via AJAX
            fetch('{{ route("assign.amendments") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    protocols: selectedData 
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || `Server error: ${response.status}`);
                    }).catch(() => {
                        throw new Error(`Network error: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Success response:', data);
                if (data.success) {
                    alert(data.message || 'Protocols assigned successfully!');
                    location.reload();
                } else {
                    throw new Error(data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error assigning protocols: ' + error.message);
            })
            .finally(() => {
                // Re-enable button
                this.disabled = false;
                this.textContent = originalText;
            });
        });

        // Initialize selected list state
        updateSelectedList();
    });
</script>