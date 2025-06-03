<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard - Administrador de Nómina') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Tabs Container -->
            <div class="mb-6">
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px space-x-8" aria-label="Tabs" role="tablist">
                        <!-- Main Tab Button -->
                        <button
                            id="main-tab"
                            class="inline-flex items-center px-1 py-4 text-sm font-medium transition-colors duration-200 ease-in-out border-b-2 group"
                            :class="{
                                'border-indigo-500 text-indigo-600 dark:text-indigo-400 dark:border-indigo-400': activeTab === 'main',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600': activeTab !== 'main'
                            }"
                            role="tab"
                            aria-selected="true"
                            aria-controls="main-panel"
                            onclick="switchTab('main')"
                        >
                            <svg class="w-5 h-5 mr-2" :class="{
                                'text-indigo-500 dark:text-indigo-400': activeTab === 'main',
                                'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400': activeTab !== 'main'
                            }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Funcionalidades
                        </button>

                        <!-- Indicators Tab Button -->
                        <button
                            id="indicators-tab"
                            class="inline-flex items-center px-1 py-4 text-sm font-medium transition-colors duration-200 ease-in-out border-b-2 group"
                            :class="{
                                'border-indigo-500 text-indigo-600 dark:text-indigo-400 dark:border-indigo-400': activeTab === 'indicators',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600': activeTab !== 'indicators'
                            }"
                            role="tab"
                            aria-selected="false"
                            aria-controls="indicators-panel"
                            onclick="switchTab('indicators')"
                        >
                            <svg class="w-5 h-5 mr-2" :class="{
                                'text-indigo-500 dark:text-indigo-400': activeTab === 'indicators',
                                'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400': activeTab !== 'indicators'
                            }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Indicadores
                        </button>
                    </nav>
                </div>

                <!-- Tab Panels -->
                <div class="mt-6">
                    <!-- Main Panel -->
                    <div
                        id="main-panel"
                        class="transition-all duration-300 ease-in-out"
                        :class="{ 'block': activeTab === 'main', 'hidden': activeTab !== 'main' }"
                        role="tabpanel"
                        aria-labelledby="main-tab"
                    >
                        <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                @include('dashboard.admin.main')
                            </div>
                        </div>
                    </div>

                    <!-- Indicators Panel -->
                    <div
                        id="indicators-panel"
                        class="transition-all duration-300 ease-in-out"
                        :class="{ 'block': activeTab === 'indicators', 'hidden': activeTab !== 'indicators' }"
                        role="tabpanel"
                        aria-labelledby="indicators-tab"
                    >
                        <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                @include('dashboard.admin.indicators')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        @parent
        <script>
            // Initialize Alpine.js data
            document.addEventListener('alpine:init', () => {
                Alpine.data('tabs', () => ({
                    activeTab: localStorage.getItem('activeTab') || 'main',
                    init() {
                        // Set initial active tab
                        this.switchTab(this.activeTab);
                    },
                    switchTab(tab) {
                        this.activeTab = tab;
                        localStorage.setItem('activeTab', tab);
                    }
                }));
            });

            // Fallback JavaScript for non-Alpine.js environments
            function switchTab(tabId) {
                // Update active tab in localStorage
                localStorage.setItem('activeTab', tabId);

                // Update tab buttons
                document.querySelectorAll('[role="tab"]').forEach(tab => {
                    const isSelected = tab.id === `${tabId}-tab`;
                    tab.setAttribute('aria-selected', isSelected);
                    tab.classList.toggle('border-indigo-500', isSelected);
                    tab.classList.toggle('text-indigo-600', isSelected);
                    tab.classList.toggle('border-transparent', !isSelected);
                    tab.classList.toggle('text-gray-500', !isSelected);
                });

                // Update tab panels
                document.querySelectorAll('[role="tabpanel"]').forEach(panel => {
                    const isActive = panel.id === `${tabId}-panel`;
                    panel.classList.toggle('hidden', !isActive);
                    panel.classList.toggle('block', isActive);
                });
            }

            // Initialize tabs on page load
            document.addEventListener('DOMContentLoaded', () => {
                const activeTab = localStorage.getItem('activeTab') || 'main';
                switchTab(activeTab);
            });
        </script>
    @endsection
</x-app-layout>