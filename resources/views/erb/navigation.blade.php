<nav class="bg-primary h-screen text-white fixed top-0 left-0 hidden xl:flex xl:flex-col overflow-y-auto w-[335px]">
<header
        class="hidden lg:flex justify-center bg-primary align-center p-2 overflow-hidden overscroll-contain border-darkergray border-b">
        <img src="{{ asset('images/mcu-logo-white.png') }}" alt="STUDENT MAS BAGO" class="w-44">
    </header>
    <div class="sidebar overflow-y-auto overscroll-contain px-0 flex-1 bg-primary [&::-webkit-scrollbar]:w-[4px] [&::-webkit-scrollbar-thumb]:bg-[#666666]">
        <ul class="m-4 text-lg p-0 bg-primary">
            <li>
                <a href="{{ url('/erb/dashboard') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/dashboard') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined text-sm">dashboard</i>
                    Dashboard
                </a>
            </li>
            <li>
                <button
                    class="dropdownToggle w-full flex items-center px-2 py-3 border-none gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/view-reviews') ? 'text-secondary' : '' }} {{ Request::is('erb/assign-reviewer') || Request::is('erb/view-review-files/*/*') || Request::is('erb/full-board-review') ? 'text-secondary' : '' }}">
                    <i class=" material-symbols-outlined">folder_eye</i>
                    <span class="mr-auto">View Documents</span>
                    <i class="material-symbols-outlined dropdownArrow transition-transform">keyboard_arrow_down</i>
                </button>
                <ul class="dropdownMenu ml-1 mt-1 hidden pl-5 w-full">
                    <li>
                        <a href="{{ url('/erb/view-reviews') }}"
                            class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                            {{ Request::is('erb/view-reviews') || Request::is('erb/view-review-files/*/*') ? 'text-secondary' : '' }}">
                            <i class="material-symbols-outlined">grading</i>
                            <span class="w-full flex justify-between items-center px-3">
                                View Reviews
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/erb/assign-reviewer') }}" class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                            {{ Request::is('erb/assign-reviewer') ? 'text-secondary' : '' }}">
                            <i class="material-symbols-outlined">person_edit</i>
                            <span class="w-full flex justify-between items-center px-3">
                                Assign Reviewer
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/erb/full-board-review') }}" class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                            {{ Request::is('erb/full-board-review') ? 'text-secondary' : '' }}">
                            <i class="material-symbols-outlined">present_to_all</i>
                            <span class="w-full flex justify-between items-center px-3">
                                Full Board Review
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/erb/iro-approved-accounts') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/iro-approved-accounts') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">person_check</i>
                    IRO Approved Accounts
                </a>
            </li>
            <li>
                <a href="{{ url('/erb/research-records') }}"
                    class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/research-records') || Request::is('erb/submitted-documents/*') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">document_search</i>
                    Research Records
                </a>
            </li>

            <li>
                <a href="{{ url('/erb/assigned-forms') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/assigned-forms') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">work_alert</i>
                    Assigned Forms
                </a>
            </li>
            <li>
                <a href="{{ url('/erb/protocol-decision') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/protocol-decision') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">avg_pace</i>
                    Protocol Decision
                </a>
            </li>
            <li>
                <a href="{{ url('/erb/submitted-tickets') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/submitted-tickets') || Request::is('erb/tickets/*') ? 'text-secondary' : ''}}">
                    <i class="material-symbols-outlined">topic</i>
                    Submitted Inquiries
                </a>
            </li>
            <li>
                <a href="{{ url('/erb/resubmission') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/resubmission') ? 'text-secondary' : ''}}">
                    <i class="material-symbols-outlined">edit_document</i>
                    Resubmission
                </a>
            </li>
            <li>
                <a href="{{ url('/erb/monitoring-process') }}"
                    class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/monitoring-process') ? 'text-secondary' : ''}}">
                    <i class="material-symbols-outlined">monitoring</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/erb/final-completion') }}"
                    class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('erb/final-completion') ? 'text-secondary' : ''}}">
                    <i class="material-symbols-outlined">clock_loader_80</i>
                    Final Completion
                </a>
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
                <div class="whitespace-nowrap text-sm">ERB Admin</div>
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
            <img src="{{ asset('images/mcu-logo-white.png') }}" alt="ERB MAS BAGO"
                class="w-[160px] h-[55px] max-sm:w-[140px] max-sm:h-[50px]">
        </header>
        <div class="overflow-auto overscroll-contain flex-1">
            <ul class="m-2 p-0 bg-primary">
                <li>
                    <a href="{{ url('/erb/dashboard') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/dashboard') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">dashboard</i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <button
                        class="dropdownToggle w-full flex items-center px-2 py-3 border-none gap-x-3 hover:text-secondary transition-all duration-300 text-[15px]
                        {{ Request::is('erb/view-reviews') ? 'text-secondary' : '' }} {{ Request::is('erb/assign-reviewer') || Request::is('erb/full-board-review') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined">folder_eye</i>
                        <span class="mr-auto">View Documents</span>
                        <i class="material-symbols-outlined dropdownArrow transition-transform">keyboard_arrow_down</i>
                    </button>
                    <ul class="dropdownMenu ml-1 mt-1 hidden pl-5 w-full">
                        <li>
                            <a href="{{ url('/erb/view-reviews') }}"
                                class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                                {{ Request::is('erb/view-reviews') || Request::is('erb/erb/view-review-files/*') ? 'text-secondary' : '' }}">
                                <i class="material-symbols-outlined max-sm:text-[15px]">grading</i>
                                <span class="w-full flex justify-between items-center px-3">
                                    View Reviews
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/erb/assign-reviewer') }}" class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                                {{ Request::is('erb/assign-reviewer') ? 'text-secondary' : '' }}">
                                <i class="material-symbols-outlined max-sm:text-[15px]">person_edit</i>
                                <span class="w-full flex justify-between items-center px-3">
                                    Assign Reviewer
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/erb/full-board-review') }}" class="block hover:text-secondary duration-200 px-2 py-1.5 flex
                                {{ Request::is('erb/full-board-review') ? 'text-secondary' : '' }}">
                                <i class="material-symbols-outlined max-sm:text-[15px]">present_to_all</i>
                                <span class="w-full flex justify-between items-center px-3">
                                    Full Board Review
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/erb/iro-approved-accounts') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/iro-approved-accounts') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">person_check</i>
                        IRO Approved Accounts
                    </a>
                </li>
                <li>
                    <a href="{{ url('/erb/research-records') }}"
                        class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary
                        {{ Request::is('erb/research-records') || Request::is('erb/submitted-documents/*') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">document_search</i>
                        Research Records
                    </a>
                </li>

                <li>
                    <a href="{{ url('/erb/assigned-forms') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/assigned-forms') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">work_alert</i>
                        Assigned Forms
                    </a>
                </li>
                <li>
                    <a href="{{ url('/erb/protocol-decision') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/protocol-decision') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">avg_pace</i>
                        Protocol Decision
                    </a>
                </li>
                <li>
                    <a href="{{ url('/erb/submitted-tickets') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/submitted-tickets') || Request::is('erb/tickets/*') ? 'text-secondary' : ''}}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">topic</i>
                        Submitted Inquiries
                    </a>
                </li>
                <li>
                    <a href="{{ url('/erb/resubmission') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/resubmission') ? 'text-secondary' : ''}}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">edit_document</i>
                        Resubmission
                    </a>
                </li>
                <li>
                    <a href="{{ url('/erb/monitoring-process') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/monitoring-process') ? 'text-secondary' : ''}}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">monitoring</i>
                        Process Monitoring
                    </a>
                </li>
                <li>
                    <a href="{{ url('/erb/final-completion') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('erb/final-completion') ? 'text-secondary' : ''}}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">clock_loader_80</i>
                        Final Completion
                    </a>
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
                    <div class="whitespace-nowrap max-sm:text-xs text-sm">ERB Admin</div>
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
<header
    class="h-[65px] xl:hidden bg-primary z-[99] shadow-md sticky top-0 left-0 flex items-center px-3 justify-between">
    <button id="menuBtn" class="text-white focus:outline-none text-xl pl-3">&#9776;</button>
    <img src="{{ asset('images/mcu-logo-white(2).png') }}" alt="" class="w-[55px] h-[55px]">
    <img src="{{ asset('images/profile-white.png') }}" alt="" class="rounded-[50%] w-[35px] h-[35px] border-none">
</header>