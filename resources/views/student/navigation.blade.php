<nav class="bg-primary h-screen text-white fixed top-0 left-0 hidden xl:flex flex-col overflow-y-auto w-[335px]">
    <header class="hidden lg:flex justify-center bg-primary align-center p-2 overflow-hidden overscroll-contain">
        <img src="{{ asset('images/mcu-logo-white.png') }}" alt="STUDENT MAS BAGO" class="w-44">
    </header>
    <div class="overflow-y-auto overscroll-contain px-0 flex-1 bg-primary">
        <ul class="m-4 text-lg p-0 bg-primary">
            <!-- DASHBOARD -->
            <li>
                <a href="{{ url('/student/dashboard') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/dashboard') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">dashboard</i>
                    Dashboard
                </a>
            </li>
            <!-- SUBMIT FORMS -->
            <li>
                <a href="{{ url('/student/download-forms') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/download-forms') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">send</i>
                    Submit Forms
                </a>
            </li>
            <!-- SUBMIT DOCUMENTS -->
            <li>
                <a href="{{ url('/student/download-forms') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/download-forms') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">attach_file</i>
                    Submit Documents
                </a>
            </li>
            <!-- SUBMIT INQUIRIES -->
            <li>
                <a href="{{ url('/student/submit-tickets') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/submit-tickets') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">topic</i>
                    Submit Inquiries
                </a>
            </li>
            <!-- PROCESS MONITORING -->
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
            <li>
                <a href="{{ url('/student/monitoring-process') }}"
                    class="w-100 flex items-center px-2 py-3 border-none no-underline gap-x-3 {{ Request::is('student/monitoring-process') ? 'text-secondary' : '' }}">
                    <i class="material-symbols-outlined">monitor</i>
                    Process Monitoring
                </a>
            </li>
        </ul>
    </div>
    <footer class="flex items-center px-3 py-3">
        <div class="flex items-center">
            <img src="" alt="PFP" class="w-30 h-30 rounded-[50%] mx-2">
            <div>
                <div class="whitespace-nowrap">
                    {{ Auth::user()->user_Fname }} {{ Auth::user()->user_MI }} {{ Auth::user()->user_Lname }}
                </div>
                <div class="whitespace-nowrap text-sm">Admin</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="duration-200 hover:text-secondary p-0 m-0 bg-transparent border-0">
                    <i class="material-symbols-outlined text-2xl absolute right-6 bottom-2 -translate-y-1/2">logout</i>
                </button>
            </form>
        </div>
    </footer>
</nav>