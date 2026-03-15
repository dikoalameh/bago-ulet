<!-- EDIT PROFILE MODAL FORM -->
<div id="editProfileModal" onclick="outsideClick(event)"
    class="fixed inset-0 bg-black z-[9999] bg-opacity-50 hidden items-center justify-center overflow-auto overscroll-contain">
    <div class="relative flex items-center justify-center bg-white w-[500px] p-6 rounded-[10px] shadow-md">
        <form action="" class="w-full px-2">
            <div class="flex justify-between items-center mb-2">
                <div class="text-xl font-bold">Edit Profile</div>
                <button type="button" onclick="closeSettingsModal('editProfileModal')"
                    class="material-symbols-outlined">
                    close
                </button>
            </div>
            <!-- PROFILE IMAGE -->
            <div class="flex flex-col items-center mb-3">
                <div class="relative">
                    <img id="profilePreview" src="{{ asset('images/profile-black.png') }}"
                        class="w-[110px] h-[110px] rounded-full object-cover shadow-md">

                    <label for="profileImage"
                        class="material-symbols-outlined absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full cursor-pointer">
                        photo_camera
                    </label>
                </div>
                <input type="file" id="profileImage" accept="image/*" class="hidden" onchange="previewImage(event)">
                <button type="button" onclick="removeProfileImage()"
                    class="bg-secondary px-3 py-2 tracking-widest text-primary mt-2 rounded-[5px]">REMOVE
                    PHOTO</button>
            </div>
            <!-- INPUTS -->
            <div class="flex gap-4 w-full">
                <div class="relative w-1/2 border-b-[2px] mt-6">
                    <span class="absolute right-[8px] leading-[57px]">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <input type="text" required class="peer w-full h-[50px] bg-transparent border-0 focus:ring-0">
                    <label
                        class="absolute top-[50%] text-darkgray left-[8px] -translate-y-[50%] pointer-events-none transition-all duration-300 peer-focus:-top-[5px] peer-focus:text-[12px] peer-valid:-top-[5px] peer-valid:text-[12px]">
                        First Name
                    </label>
                </div>
                <div class="relative w-1/2 border-b-[2px] mt-6">
                    <span class="absolute right-[8px] leading-[57px]">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <input type="text" required class="peer w-full h-[50px] bg-transparent border-0 focus:ring-0">
                    <label
                        class="absolute top-[50%] text-darkgray left-[8px] -translate-y-[50%] pointer-events-none transition-all duration-300 peer-focus:-top-[5px] peer-focus:text-[12px] peer-valid:-top-[5px] peer-valid:text-[12px]">
                        Middle Initial
                    </label>
                </div>
            </div>
            <div class="relative border-b-[2px] mt-6 w-full">
                <span class="absolute right-[8px] leading-[57px]">
                    <i class="bi bi-person-fill"></i>
                </span>
                <input type="text" required class="peer w-full h-[50px] bg-transparent border-0 focus:ring-0">
                <label
                    class="absolute top-[50%] text-darkgray left-[8px] -translate-y-[50%] pointer-events-none transition-all duration-300 peer-focus:-top-[5px] peer-focus:text-[12px] peer-valid:-top-[5px] peer-valid:text-[12px]">
                    Last Name
                </label>
            </div>
            <div class="flex items-center gap-x-2 mt-2">
                <!-- RESET TO DEFAULT -->
                <button type="submit"
                    class="mt-4 bg-primary text-white hover:bg-secondary hover:text-primary font-normal rounded-[5px] px-4 py-1 tracking-widest uppercase transition-all duration-300">
                    Reset
                </button>
                <!-- SAVE ALL CHANGES -->
                <button type="submit"
                    class="mt-4 bg-secondary text-primary hover:bg-primary hover:text-white font-normal rounded-[5px] px-4 py-1 tracking-widest uppercase transition-all duration-300">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CHANGE PASSWORD MODAL FORM -->
<div id="changePasswordModal" onclick="outsideClick(event)"
    class="fixed inset-0 bg-black z-[9999] bg-opacity-50 hidden items-center justify-center overflow-auto overscroll-contain">
    <div onclick="event.stopPropagation()"
        class="relative flex items-center justify-center bg-white w-[500px] p-6 rounded-[10px] shadow-md">
        <form action="" class="w-full px-2">
            <div class="flex justify-between items-center mb-2">
                <div class="text-xl font-bold">Change Password</div>
                <button type="button" onclick="closeSettingsModal('changePasswordModal')"
                    class="material-symbols-outlined">
                    close
                </button>
            </div>
            <div class="relative border-b-[2px] mt-6">
                <span class="absolute right-[8px] leading-[57px]">
                    <i class="material-symbols-outlined">lock</i>
                </span>
                <input type="password" required class="peer w-full h-[50px] bg-transparent border-0 focus:ring-0">
                <label
                    class="absolute top-[50%] text-darkgray left-[8px] -translate-y-[50%] pointer-events-none transition-all duration-300 peer-focus:-top-[5px] peer-focus:text-[12px] peer-valid:-top-[5px] peer-valid:text-[12px]">
                    Old Password
                </label>
            </div>
            <div class="relative border-b-[2px] mt-6">
                <span class="absolute right-[8px] leading-[57px]">
                    <i class="material-symbols-outlined">lock</i>
                </span>
                <input type="password" required class="peer w-full h-[50px] bg-transparent border-0 focus:ring-0">
                <label
                    class="absolute top-[50%] text-darkgray left-[8px] -translate-y-[50%] pointer-events-none transition-all duration-300 peer-focus:-top-[5px] peer-focus:text-[12px] peer-valid:-top-[5px] peer-valid:text-[12px]">
                    New Password
                </label>
            </div>
            <div class="relative border-b-[2px] mt-6">
                <span class="absolute right-[8px] leading-[57px]">
                    <i class="material-symbols-outlined">lock</i>
                </span>
                <input type="password" required class="peer w-full h-[50px] bg-transparent border-0 focus:ring-0">
                <label
                    class="absolute top-[50%] text-darkgray left-[8px] -translate-y-[50%] pointer-events-none transition-all duration-300 peer-focus:-top-[5px] peer-focus:text-[12px] peer-valid:-top-[5px] peer-valid:text-[12px]">
                    Confirm New Password
                </label>
            </div>
            <div class="flex items-center gap-x-2 mt-2">
                <!-- RESET TO DEFAULT -->
                <button type="submit"
                    class="mt-4 bg-primary text-white hover:bg-secondary hover:text-secondary font-normal rounded-[5px] px-4 py-1 tracking-widest uppercase">
                    Reset
                </button>
                <!-- SAVE ALL CHANGES -->
                <button type="submit"
                    class="mt-4 bg-secondary text-primary hover:bg-primary hover:text-white font-normal rounded-[5px] px-4 py-1 tracking-widest uppercase">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<nav class="bg-primary h-screen text-white fixed top-0 left-0 hidden xl:flex xl:flex-col overflow-y-auto w-[335px]">
    <header
        class="hidden lg:flex justify-center bg-primary align-center p-2 overflow-hidden overscroll-contain border-darkergray border-b">
        <img src="{{ asset('images/mcu-logo-white.png') }}" alt="IACUC MAS BAGO" class="w-44">
    </header>
    <div class="overflow-y-auto overscroll-contain px-0 flex-1 bg-primary [&::-webkit-scrollbar]:w-[4px] [&::-webkit-scrollbar-thumb]:bg-[#666666]">
        <ul class="m-4 text-lg p-0 bg-primary">
            <li>
                <a href="{{ url('/iacuc/dashboard') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('iacuc/dashboard') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">dashboard</i>
                    Dashboard
                </a>
            </li>
            <li>
                <button
                    class="dropdownToggle w-full flex items-center px-2 py-3 border-none gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('iacuc/view-reviews') ? 'text-secondary' : '' }} {{ Request::is('iacuc/assign-reviewer') ? 'text-secondary' : '' }}">
                    <i class=" material-symbols-outlined">folder_eye</i>
                    <span class="mr-auto">View Documents</span>
                    <i class="material-symbols-outlined dropdownArrow transition-transform">keyboard_arrow_down</i>
                </button>
                <ul class="dropdownMenu ml-1 mt-1 hidden pl-5 w-full">
                    <li>
                        <a href="{{ url('/iacuc/view-reviews') }}"
                            class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                        {{ Request::is('iacuc/view-reviews') || Request::is('iacuc/viewing-file') ? 'text-secondary' : '' }}">
                            <i class="material-symbols-outlined">grading</i>
                            <span class="w-full flex justify-between items-center px-3">
                                View Reviews
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/iacuc/assign-reviewer') }}" class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                        {{ Request::is('iacuc/assign-reviewer') ? 'text-secondary' : '' }}">
                            <i class="material-symbols-outlined">person_edit</i>
                            <span class="w-full flex justify-between items-center px-3">
                                Assign Reviewer
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/iacuc/iro-approved-accounts') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('iacuc/iro-approved-accounts') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">person_check</i>
                    IRO Approved Accounts
                </a>
            </li>
            <li>
                <a href="{{ url('/iacuc/research-records') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('iacuc/research-records') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">document_search</i>
                    Research Records
                </a>
            </li>
            <li>
                <a href="{{ url('/iacuc/protocol-decision') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('iacuc/protocol-decision') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">avg_pace</i>
                    Protocol Decision
                </a>
            </li>
            <li>
                <a href="{{ url('/iacuc/monitoring-process') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('iacuc/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitoring</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <button onclick="openSettingsModal('editProfileModal')"
                    class="w-full flex items-center border-none px-2 py-3 gap-x-3 hover:text-secondary transition-all duration-300">
                    <i class="material-symbols-outlined text-sm">account_circle</i>
                    Edit Profile
                </button>
            </li>
            <li>
                <button onclick="openSettingsModal('changePasswordModal')"
                    class="w-full flex items-center border-none px-2 py-3 gap-x-3 hover:text-secondary transition-all duration-300">
                    <i class="material-symbols-outlined">password</i>
                    Change Password
                </button>
            </li>
        </ul>
    </div>
    <footer class="flex items-center px-3 py-3 border-darkergray border-t">
        <div class="flex items-center">
            <img src="{{ asset('images/profile-white.png') }}" alt="PFP" class="w-[45px] h-[45px] rounded-[50%] mx-1">
            <div>
                <div class="whitespace-nowrap">
                    {{ Auth::user()->user_Fname }} {{ Auth::user()->user_MI }} {{ Auth::user()->user_Lname }}
                </div>
                <div class="text-sm whitespace-nowrap">IACUC Admin</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="duration-200 hover:text-secondary p-0 m-0 bg-transparent border-0">
                    <i class="material-symbols-outlined text-2xl absolute right-4 bottom-[10px] -translate-y-[50%]">
                        logout
                    </i>
                </button>
            </form>
        </div>
    </footer>
</nav>

<div id="sidebar"
    class="fixed top-0 left-0 h-full w-[335px] bg-primary xl:hidden shadow transform -translate-x-full transition-transform duration-300 z-[999]">
    <nav
        class="bg-primary h-[100vh] text-white fixed top-0 left-0 max-xl:flex max-xl:flex-col overflow-y-auto w-[335px]">
        <header
            class="flex justify-center items-center p-2 overflow-hidden border-darkergray border-b h-[90px] max-sm:h-[80px]">
            <img src="{{ asset('images/mcu-logo-white.png') }}" alt="IACUC MAS BAGO"
                class="sm:w-[140px] md:w-[160px] max-sm:h-[50px] h-[55px]">
        </header>
        <div class="overflow-auto overscroll-contain flex-1">
            <ul class="m-2 p-0 bg-primary">
                <li>
                    <a href="{{ url('/iacuc/dashboard') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('iacuc/dashboard') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">dashboard</i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <button
                        class="dropdownToggle w-full flex items-center px-2 py-3 border-none gap-x-3 hover:text-secondary transition-all duration-300 text-[15px]
                        {{ Request::is('iacuc/view-reviews') ? 'text-secondary' : '' }} {{ Request::is('iacuc/assign-reviewer') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined">folder_eye</i>
                        <span class="mr-auto">View Documents</span>
                        <i class="material-symbols-outlined dropdownArrow transition-transform">keyboard_arrow_down</i>
                    </button>
                    <ul class="dropdownMenu ml-1 mt-1 hidden pl-5 w-full">
                        <li>
                            <a href="{{ url('/iacuc/view-reviews') }}"
                                class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                                {{ Request::is('iacuc/view-reviews') || Request::is('iacuc/viewing-file') ? 'text-secondary' : '' }}">
                                <i class="material-symbols-outlined max-sm:text-[15px]">grading</i>
                                <span class="w-full flex justify-between items-center px-3">
                                    View Reviews
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/iacuc/assign-reviewer') }}" class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                                {{ Request::is('iacuc/assign-reviewer') ? 'text-secondary' : '' }}">
                                <i class="material-symbols-outlined max-sm:text-[15px]">person_edit</i>
                                <span class="w-full flex justify-between items-center px-3">
                                    Assign Reviewer
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/iacuc/iro-approved-accounts') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('iacuc/iro-approved-accounts') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined">person_check</i>
                        IRO Approved Accounts
                    </a>
                </li>
                <li>
                    <a href="{{ url('/iacuc/research-records') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('iacuc/research-records') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined">document_search</i>
                        Research Records
                    </a>
                </li>
                <li>
                    <a href="{{ url('/iacuc/protocol-decision') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('iacuc/protocol-decision') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined">avg_pace</i>
                        Protocol Decision
                    </a>
                </li>
                <li>
                    <a href="{{ url('/iacuc/monitoring-process') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('iacuc/monitoring-process') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined">monitoring</i>
                        Process Monitoring
                    </a>
                </li>
                <li>
                    <button onclick="openSettingsModal('editProfileModal')"
                        class="w-full flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary">
                        <i class="material-symbols-outlined max-sm:text-[15px]">account_circle</i>
                        Edit Profile
                    </button>
                </li>
                <li>
                    <button onclick="openSettingsModal('changePasswordModal')"
                        class="w-full flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary">
                        <i class="material-symbols-outlined">password</i>
                        Change Password
                    </button>
                </li>
            </ul>
        </div>
        <footer class="flex items-center px-3 py-3 border-darkergray border-t">
            <div class="flex items-center">
                <img src="{{ asset('images/profile-white.png') }}" alt="PFP"
                    class="w-[40px] h-[40px] rounded-[50%] mx-0.5">
                <div class="pl-1">
                    <div class="whitespace-nowrap max-sm:text-sm">
                        {{ Auth::user()->user_Fname }} {{ Auth::user()->user_MI }} {{ Auth::user()->user_Lname }}
                    </div>
                    <div class="whitespace-nowrap max-sm:text-xs text-sm">IACUC Admin</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="duration-200 hover:text-secondary p-0 m-0 bg-transparent border-0">
                        <i
                            class="material-symbols-outlined text-2xl absolute right-3 max-sm:bottom-[5px] bottom-[10px] -translate-y-[50%]">
                            logout
                        </i>
                    </button>
                </form>
            </div>
        </footer>
    </nav>
</div>

<!-- HEADER FOR MOBILE VIEW -->
<header
    class="h-[65px] xl:hidden bg-primary z-[99] shadow-md sticky top-0 left-0 flex items-center px-3 justify-between">
    <button id="menuBtn" class="text-white focus:outline-none text-xl pl-3">&#9776;</button>
    <img src="{{ asset('images/mcu-logo-white(2).png') }}" alt="" class="w-[55px] h-[55px]">
    <img src="{{ asset('images/profile-white.png') }}" alt="" class="rounded-[50%] w-[35px] h-[35px] border-none">
</header>