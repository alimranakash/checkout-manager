<?php
wp_enqueue_style( 'admin-style' );
// Enqueue Tailwind CSS from CDN
wp_enqueue_style( 'tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css', array(), '2.2.19' );
?>
<div class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full mb-8 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h1 class="text-5xl font-bold text-gray-900 mb-4 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                <?php _e( 'Premium Features', 'checkout-manager' ); ?>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                <?php _e( 'Unlock advanced features that give your checkout intelligent behavior, role-based access, and multi-step flows.', 'checkout-manager' ); ?>
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- TIER 1 -->
            <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white"><?php _e( 'TIER 1', 'checkout-manager' ); ?></h2>
                        <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold"><?php _e( 'Pro', 'checkout-manager' ); ?></span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mt-2"><?php _e( 'Role & Permission Management', 'checkout-manager' ); ?></h3>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'User role restrictions — assign field access per role', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Field-level permissions — lock fields from non-admins', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Audit log — track all field changes with timestamp/user', 'checkout-manager' ); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- TIER 2 -->
            <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white"><?php _e( 'TIER 2', 'checkout-manager' ); ?></h2>
                        <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold"><?php _e( 'Pro', 'checkout-manager' ); ?></span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mt-2"><?php _e( 'Advanced Dynamic Logic', 'checkout-manager' ); ?></h3>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Multi-condition rules (AND/OR logic)', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Auto-calculated fields (formulas, not just show/hide)', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Conditional field groups — hide entire sections', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Branching checkout paths based on customer/product type', 'checkout-manager' ); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- TIER 3 -->
            <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white"><?php _e( 'TIER 3', 'checkout-manager' ); ?></h2>
                        <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold"><?php _e( 'Pro', 'checkout-manager' ); ?></span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mt-2"><?php _e( 'Multi-Step Checkout', 'checkout-manager' ); ?></h3>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Step builder — segment checkout into digestible steps', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Progress indicator & validation per step', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Abandoned cart recovery (save progress)', 'checkout-manager' ); ?></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700"><?php _e( 'Step-specific styling', 'checkout-manager' ); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bonus Features -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-16 border border-gray-100">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4"><?php _e( 'Bonus Features', 'checkout-manager' ); ?></h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php _e( 'Field Prefill Templates', 'checkout-manager' ); ?></h3>
                    <p class="text-gray-600 text-sm"><?php _e( 'Save time with pre-configured field templates', 'checkout-manager' ); ?></p>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php _e( 'Advanced Export', 'checkout-manager' ); ?></h3>
                    <p class="text-gray-600 text-sm"><?php _e( 'Export your configurations with advanced options', 'checkout-manager' ); ?></p>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php _e( 'REST API Access', 'checkout-manager' ); ?></h3>
                    <p class="text-gray-600 text-sm"><?php _e( 'Integrate with external systems via REST API', 'checkout-manager' ); ?></p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <div class="bg-gradient-to-r from-purple-700 via-indigo-700 to-sky-700 rounded-3xl p-12 shadow-2xl transform hover:scale-105 transition-all duration-300">
                <h2 class="text-4xl font-bold text-white mb-4"><?php _e( 'Ready to Supercharge Your Checkout?', 'checkout-manager' ); ?></h2>
                <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                    <?php _e( 'Join thousands of stores already using Checkout Manager Pro to create intelligent, conversion-optimized checkout experiences.', 'checkout-manager' ); ?>
                </p>
                <a target="_blank" href="https://worzen.com/checkout-manager/#pricing" class="inline-flex items-center justify-center px-14 py-4 bg-white text-purple-700 font-bold text-xl rounded-full hover:bg-gray-100 transform hover:scale-110 transition-all duration-300 shadow-2xl hover:shadow-2xl animate-pulse">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <?php _e( 'Upgrade to Pro Now', 'checkout-manager' ); ?>
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <p class="text-white/80 text-sm mt-4"><?php _e( '30-day money-back guarantee • Free updates • Premium support', 'checkout-manager' ); ?></p>
            </div>
        </div>
    </div>
</div>