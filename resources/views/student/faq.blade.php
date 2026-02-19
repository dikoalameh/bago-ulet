<button id="faqButton" onclick="openModal()" class="fixed bottom-12 right-12 z-40
               w-12 h-12 rounded-md
               bg-primary text-white
               flex items-center justify-center
               shadow-lg hover:bg-gray-700 transition" title="Ask a question">
    <i class="material-symbols-outlined">help</i>
</button>

<!-- MODAL FORM -->
<div id="faqModal" class="fixed inset-0 z-50 hidden
            bg-black/60
            items-center justify-center
            opacity-0
            transition-opacity duration-300 ease-out">

    <div id="modalBox" class="bg-white w-full max-w-md rounded-lg p-6 relative h-[500px]
                transform -translate-y-12
                transition-transform duration-300 ease-out">

        <!-- CLOSE BUTTON -->
        <div class="flex align-center justify-between mb-5">
            <h2 class="text-xl font-semibold">Frequently Asked Questions</h2>
            <button onclick="closeModal()" class="text-2xl text-gray-500 hover:text-black">
                &times;
            </button>
        </div>
        <!-- MODAL FORM MAIN CONTENT SCROLLABLE -->
        <div class="h-[400px] overflow-y-auto overflow-x-hidden">
            <div class="space-y-2">
                <details class="group border rounded">
                    <summary class="cursor-pointer px-4 py-3 font-medium bg-gray-100 flex justify-between items-center">
                        Item #1
                        <span class="transition-transform duration-300 group-open:rotate-180">
                            &#11167;
                        </span>
                    </summary>
                    <div class="overflow-hidden px-4 py-3 text-gray-700 border-t">
                        First content.
                    </div>
                </details>
                <details class="group border rounded">
                    <summary class="cursor-pointer px-4 py-3 font-medium bg-gray-100 flex justify-between items-center">
                        Item #2
                        <span class="transition-transform duration-300 group-open:rotate-180">
                            &#11167;
                        </span>
                    </summary>
                    <div class="overflow-hidden px-4 py-3 text-gray-700 border-t">
                        Second content.
                    </div>
                </details>
                <details class="group border rounded">
                    <summary class="cursor-pointer px-4 py-3 font-medium bg-gray-100 flex justify-between items-center">
                        Item #3
                        <span class="transition-transform duration-300 group-open:rotate-180">
                            &#11167;
                        </span>
                    </summary>
                    <div class="overflow-hidden px-4 py-3 text-gray-700 border-t">
                        Third content.
                    </div>
                </details>
                <details class="group border rounded">
                    <summary class="cursor-pointer px-4 py-3 font-medium bg-gray-100 flex justify-between items-center">
                        Item #4
                        <span class="transition-transform duration-300 group-open:rotate-180">
                            &#11167;
                        </span>
                    </summary>
                    <div class="overflow-hidden px-4 py-3 text-gray-700 border-t">
                        Fourth content.
                    </div>
                </details>
                <details class="group border rounded">
                    <summary class="cursor-pointer px-4 py-3 font-medium bg-gray-100 flex justify-between items-center">
                        Item #5
                        <span class="transition-transform duration-300 group-open:rotate-180">
                            &#11167;
                        </span>
                    </summary>
                    <div class="overflow-hidden px-4 py-3 text-gray-700 border-t">
                        Fifth content.
                    </div>
                </details>
            </div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('faqModal');
    const modalBox = document.getElementById('modalBox');
    const button = document.getElementById('faqButton');

    function closeAllDetails() {
        document.querySelectorAll('#faqModal details[open]').forEach(d => {
            d.removeAttribute('open');
        });
    }

    function openModal() {
        closeAllDetails()
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');

            modalBox.classList.remove('-translate-y-12');
            modalBox.classList.add('translate-y-0');
        });

        button.classList.add('hidden');
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modal.classList.remove('opacity-100');

        modalBox.classList.add('-translate-y-12');
        modalBox.classList.remove('translate-y-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);

        button.classList.remove('hidden');
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
</script>