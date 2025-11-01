@section('title', 'Resubmission')
<x-iacuc-layout>
    <!-- Main Content -->
    <main class="xl:ml-[335px] max-xl:ml-auto p-4 max-md:p-2">
        <h2 class="max-xl:hidden text-left bg-[#f2f2f2] shadow-lg p-[35px] rounded-[30px] font-medium text-[28px]">
            RESUBMISSION
        </h2>
        <br>

        <!-- CSS NG SEARCH BAR -->
        <div class="top-controls">
            <div class="search-wrapper mt-1 flex max-sm:justify-center max-sm:items-center"></div>
        </div>

        <table id="myTable" class="display overflow-scroll border-collapse w-full">
            <thead class="bg-primary text-white text-lg/7 max-lg:text-base/7">
                <tr class="header-table">
                    <th class="w-[33.33%]">P.I. Name</th>
                    <th class="w-[33.33%]">Research Title</th>
                    <th class="w-[33.33%]">Date Assigned</th>
                </tr>
            </thead>
            <tbody class="text-base/7 max-lg:text-sm/6">
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="1"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="2"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="3"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="4"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="5"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="6"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="7"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="user-checkbox w-[14px] h-[14px] mb-1" value="8"
                            data-name="Alfreds Futterkiste">
                        <span>Alfreds Futterkiste</span>
                    </td>
                    <td>Foods for Health: Personalized Food and Nutritional Metabolic Profiling to Improve
                        Health
                    </td>
                    <td>
                        10/22/25<br>
                        22:30:23
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Selected Users -->
        <div class="flex mx-4 gap-6 grid mt-6">
            <!-- Selected Users -->
            <div class="bg-lightgray p-4 shadow-md rounded-md">
                <h3 class="font-semibold text-lg max-md:text-base mb-3">LISTS OF USERS</h3>
                <div class="h-16 overflow-y-auto">
                    <ul id="selectedUsers"
                        class="list-disc pl-5 flex grid grid-cols-4 max-md:grid-cols-1 max-md:text-sm"></ul>
                </div>
            </div>
            <div class="flex justify-start mx-4">
                <button id="submitBtn"
                    class="bg-secondary hover:bg-primary text-primary hover:text-secondary px-4 py-3 rounded-md uppercase tracking-widest duration-200"
                    type="button">
                    Assign
                </button>
            </div>
        </div>
    </main>
</x-iacuc-layout>
<script>
    // Modal controls
    const userCheckboxes = document.querySelectorAll(".user-checkbox");
    const selectedUsersList = document.getElementById("selectedUsers");

    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            const userId = checkbox.value;
            const userName = checkbox.dataset.name;

            const existing = selectedUsersList.querySelector(`[data-user-id="${userId}"]`);

            if (checkbox.checked && !existing) {
                // Add to list
                const li = document.createElement("li");
                li.textContent = userName;
                li.setAttribute("data-user-id", userId);
                selectedUsersList.appendChild(li);
            } else if (!checkbox.checked && existing) {
                // Remove from list
                existing.remove();
            }
        });
    });
</script>