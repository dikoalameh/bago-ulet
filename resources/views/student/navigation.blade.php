<nav class="bg-primary h-screen text-white fixed top-0 left-0 hidden xl:flex flex-col overflow-y-auto w-[335px]">
    <header
        class="hidden lg:flex justify-center bg-primary align-center p-2 overflow-hidden overscroll-contain border-darkergray border-b">
        <img src="{{ asset('images/mcu-logo-white.png') }}" alt="STUDENT MAS BAGO" class="w-44">
    </header>
    <div class="nav-items overflow-y-auto overscroll-contain px-0 flex-1 bg-primary [&::-webkit-scrollbar]:w-[4px] [&::-webkit-scrollbar-thumb]:bg-[#666666]">
        <ul class="m-4 text-lg p-0 bg-primary">
            <li>
                <a href="{{ url('/student/dashboard') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('student/dashboard') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined text-sm">dashboard</i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('/student/submit-forms') }}"
                    class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('student/submit-forms') || Request::is('student/forms/*') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined text-sm">send</i>
                    Submit Forms
                </a>
            </li>
            <li>
                <a href="{{ url('/student/submit-documents') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('student/submit-documents') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined text-sm">attach_file</i>
                    Submit Documents
                </a>
            </li>
            <li>
                <a href="{{ url('/student/submit-inquiries') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('student/submit-inquiries') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined text-sm">topic</i>
                    Submit Inquiries
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined text-sm">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/settings') }}" class="w-full flex items-center px-2 py-3 border-none no-underline gap-x-3 hover:text-secondary transition-all duration-300 
                    {{ Request::is('student/settings') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined text-sm">settings</i>
                    Settings
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
                <div class="whitespace-nowrap text-sm">Student</div>
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
        class="text-white fixed top-0 left-0 w-[335px] bg-primary h-[100dvh] z-[999] flex flex-col overflow-hidden border-darkergray border-r">
        <header
            class="flex justify-center items-center p-2 overflow-hidden border-darkergray border-b h-[90px] max-sm:h-[80px]">
            <img src="{{ asset('images/mcu-logo-white.png') }}" alt="STUDENT MAS BAGO"
                class="w-[160px] h-[55px] max-sm:w-[140px] max-sm:h-[50px]">
        </header>
        <div class="overflow-auto overscroll-contain flex-1">
            <ul class="m-2 p-0 bg-primary">
                <li>
                    <a href="{{ url('/student/dashboard') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('student/dashboard') }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">dashboard</i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ url('/student/submit-forms') }}"
                        class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('student/submit-forms') || Request::is('student/forms/*') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">send</i>
                        Submit Forms
                    </a>
                </li>
                <li>
                    <a href="{{ url('/student/submit-documents') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('student/submit-documents') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">attach_file</i>
                        Submit Documents
                    </a>
                </li>
                <li>
                    <a href="{{ url('/student/submit-inquiries') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('student/submit-inquiries') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">topic</i>
                        Submit Inquiries
                    </a>
                </li>
                <li>
                    <a href="{{ url('/student/monitoring-process') }}" class="flex items-center max-sm:text-[15px] px-2 py-3 max-sm:py-2.5 border-0 no-underline gap-x-2 cursor-pointer transition-all duration-300 hover:text-secondary 
                        {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                        <i class="material-symbols-outlined max-sm:text-[15px]">monitor</i>
                        Process Monitoring
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
                    <div class="whitespace-nowrap max-sm:text-xs text-sm">Student</div>
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