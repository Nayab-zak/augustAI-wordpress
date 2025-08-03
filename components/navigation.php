<?php
/**
 * Navigation Component
 * Main site navigation with services dropdown
 */
?>

<!-- Navigation -->
<nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <picture>
                    <source srcset="assets/augustAI Logo Design on Purple Gradient.webp" type="image/webp">
                    <img src="assets/augustAI Logo Design on Purple Gradient.png" alt="augustAI logo - AI automation and dashboard solutions for SMEs" class="h-12 md:h-16 object-contain" width="128" height="64" loading="eager">
                </picture>
            </div>
            <div class="hidden md:flex space-x-8">
                <div class="relative group">
                    <a href="#services" class="text-gray-300 hover:text-white transition-colors flex items-center">
                        Services
                        <i class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform"></i>
                    </a>
                    <!-- Services Dropdown -->
                    <div class="absolute top-full left-0 mt-2 w-64 bg-gray-900/95 backdrop-blur-lg border border-gray-700/50 rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 services-dropdown">
                        <div class="p-2">
                            <a href="#llm" onclick="scrollToSection('llm')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                <i class="fas fa-comments text-blue-400 w-5 mr-3"></i>
                                <span>LLM & Chatbots</span>
                            </a>
                            <a href="#automation" onclick="scrollToSection('automation')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                <i class="fas fa-robot text-purple-400 w-5 mr-3"></i>
                                <span>Agentic Automation</span>
                            </a>
                            <a href="#dashboards" onclick="scrollToSection('dashboards')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                <i class="fas fa-chart-bar text-green-400 w-5 mr-3"></i>
                                <span>Data & Dashboards</span>
                            </a>
                            <a href="#mvp" onclick="scrollToSection('mvp')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                <i class="fas fa-rocket text-orange-400 w-5 mr-3"></i>
                                <span>MVP Build</span>
                            </a>
                            <a href="#consulting" onclick="scrollToSection('consulting')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                <i class="fas fa-lightbulb text-yellow-400 w-5 mr-3"></i>
                                <span>Consulting & Training</span>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="#process" class="text-gray-300 hover:text-white transition-colors">Process</a>
                <a href="#portfolio" class="text-gray-300 hover:text-white transition-colors">Portfolio</a>
                <a href="#testimonials" class="text-gray-300 hover:text-white transition-colors">Testimonials</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
            </div>
            <button onclick="openCalendlyModal()" class="btn-primary">Book 30-min Call</button>
        </div>
    </div>
</nav>
