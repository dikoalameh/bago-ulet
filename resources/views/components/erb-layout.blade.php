<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default title')</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Fonts and Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <!-- Browser tab icon -->
    <link rel="icon" href="{{ asset('images/mculogo2.png') }}" type="image/x-icon">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.5/css/responsive.dataTables.css">
    <!-- DataTables and jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.5/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.5/js/responsive.dataTables.js"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('erb.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        $(document).ready(function () {
            // Only initialize if not already initialized
            if (!$.fn.dataTable.isDataTable('#myTable')) {
                const table = new DataTable('#myTable', {
                    responsive: true,
                    paging: false,
                    scrollY: '300px',
                    order: [],
                    // Tell DataTables not to auto-detect data sources
                    deferRender: true,
                    // Use the existing HTML as-is
                    columnDefs: [
                        { targets: '_all', defaultContent: '' }
                    ]
                });

                // ✅ Move the DataTables search bar into our custom search-wrapper
                const dtSearch = $('div.dt-search');
                $('.search-wrapper').append(dtSearch);

                // ✅ Build dropdown filter dynamically
                const offices = [...new Set(table.column(1).data().toArray())].sort();
                const select = $('#filter');
                offices.forEach(o => select.append(`<option value="${o}">${o}</option>`));

                // ✅ Apply filter to Office column
                select.on('change', function () {
                    const val = $.fn.dataTable.util.escapeRegex($(this).val());
                    table.column(1).search(val ? '^' + val + '$' : '', true, false).draw();
                });
            }
        });

        document.addEventListener('click', function (e) {
            // Only stop propagation if the checkbox or button is inside a specific table
            const isInsideTable = e.target.closest('#myTable'); // or use a more specific class
            const isCheckboxOrButton = e.target.closest('input[type="checkbox"], button');

            if (isInsideTable && isCheckboxOrButton) {
                e.stopPropagation(); // Prevent row expand or other unwanted behavior
            }
        }, true);

        dropDownMenu();

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const isHidden = sidebar.classList.contains('-translate-x-full');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function dropDownMenu() {
            const toggles = document.querySelectorAll('.dropdownToggle');

            toggles.forEach(toggle => {
                const menu = toggle.nextElementSibling;
                const arrow = toggle.querySelector('.dropdownArrow');

                toggle.addEventListener('click', (e) => {
                    e.stopPropagation();

                    const isHidden = menu.classList.contains('hidden');

                    if (isHidden) {
                        menu.classList.remove('hidden');
                        setTimeout(() => {
                            menu.classList.remove('opacity-0');
                        }); // small delay to trigger transition
                    } else {
                        menu.classList.add('opacity-0');
                        setTimeout(() => {
                            menu.classList.add('hidden');
                        }); // match the transition duration
                    }

                    arrow.classList.toggle('rotate-180');
                });
            });

            document.addEventListener('click', () => {
                toggles.forEach(toggle => {
                    const menu = toggle.nextElementSibling;
                    const arrow = toggle.querySelector('.dropdownArrow');

                    menu.classList.add('opacity-0');
                    setTimeout(() => {
                        menu.classList.add('hidden');
                    }, 300);
                    arrow.classList.remove('rotate-180');
                });
            });
        }
        // Set Page Title Based on URL Path
        const titles = {
            "/erb/dashboard": "DASHBOARD",
            "/erb/assign-reviewer": "ASSIGN REVIEWER",
            "/erb/approved-accounts": "ASSIGNED FORMS",
            "/erb/view-reviews": "VIEW REVIEWS",
            "/erb/full-board-review": "FULL BOARD REVIEW",
            "/erb/monitoring-process": "MONITORING PROCESS",
            "/erb/iro-approved-accounts": "APPROVED ACCOUNTS",
            "/erb/assign-amendments": "RESUBMISSION",
            "/erb/submitted-tickets": "SUBMITTED INQUIRIES",
            "/erb/pending-reviews": "PROTOCOL DECISION",
            "/erb/research-records": "RESEARCH RECORDS",
            "/erb/ongoing-reviews": "ONGOING REVIEWS",
            "/erb/submitted-documents": "SUBMITTED DOCUMENTS",
            "/erb/settings": "SETTINGS"
        };

        const path = window.location.pathname;
        const pageTitle = titles[path] || "Page";

        // Update the text content of the header and the <title> tag
        document.getElementById("page-title").textContent = pageTitle;
    </script>
</body>

</html>