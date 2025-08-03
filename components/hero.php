<?php
/**
 * Hero Section Component
 * Main landing section with value proposition
 */
?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center px-4">
    <div class="max-w-7xl mx-auto text-center">
        <!-- Hero Logo -->
        <div class="mb-8 fade-in">
            <picture>
                <source srcset="assets/augustAI Logo Design on Purple Gradient.webp" type="image/webp">
                <img src="assets/augustAI Logo Design on Purple Gradient.png" alt="augustAI hero logo - Leading AI automation company building Python automations, dashboards and MVPs" class="mx-auto h-24 md:h-32 object-contain opacity-90 hover:opacity-100 transition-opacity" width="256" height="128" loading="eager">
            </picture>
        </div>
        
        <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500/20 to-pink-500/20 rounded-full mb-8 glass">
            <span class="text-sm font-medium">🚀 Automate Everything • Dashboards • MVPs</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            <span class="typewriter gradient-text">Automate Everything.</span>
        </h1>
        
        <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
            We build Python/AI automations, 10-day dashboards, and MVPs-in-a-month for SMEs and startups. 
            <span class="gradient-text font-semibold">Automate Everything. Fixed scope. Fixed fee. Demos in week one.</span>
        </p>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
            <button onclick="openCalendlyModal()" class="btn-primary text-lg px-8 py-4">
                <i class="fas fa-calendar-alt mr-2"></i>
                Book 30-min Call
            </button>
            <button class="glass-card px-8 py-4 text-lg font-semibold hover:scale-105 transition-transform" onclick="scrollToSection('services')">
                <i class="fas fa-eye mr-2"></i>
                See packages
            </button>
        </div>
        
        <!-- Stats -->
        <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
            <div class="text-center fade-in">
                <div class="counter" data-target="70">70</div>
                <noscript><div class="text-2xl font-bold gradient-text">70+</div></noscript>
                <p class="text-gray-400 text-lg">% fewer manual hours</p>
            </div>
            <div class="text-center fade-in">
                <div class="counter" data-target="10">10</div>
                <noscript><div class="text-2xl font-bold gradient-text">10</div></noscript>
                <p class="text-gray-400 text-lg">days for dashboards</p>
            </div>
            <div class="text-center fade-in">
                <div class="counter" data-target="30">30</div>
                <noscript><div class="text-2xl font-bold gradient-text">30</div></noscript>
                <p class="text-gray-400 text-lg">days for MVPs</p>
            </div>
        </div>
    </div>
</section>
