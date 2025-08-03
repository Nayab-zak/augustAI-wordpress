<?php
/**
 * Privacy Policy Component
 * Styled privacy policy page with augustAI branding
 */

// Load configuration if not already loaded
if (!isset($content_config)) {
    $content_config = require_once __DIR__ . '/../content-config.php';
}
?>

<!-- Privacy Policy Section -->
<section class="py-20 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16 fade-in">
            <div class="mb-8">
                <picture>
                    <source srcset="assets/augustAI Logo Design on Purple Gradient.webp" type="image/webp">
                    <img src="assets/augustAI Logo Design on Purple Gradient.png" alt="augustAI logo" class="mx-auto h-16 md:h-20 object-contain opacity-90" width="160" height="80" loading="eager">
                </picture>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Privacy Policy</h1>
            <p class="text-lg text-gray-300">Last updated: <span class="font-semibold text-white">August 3, 2025</span></p>
        </div>

        <!-- Content -->
        <div class="glass-card p-8 md:p-12 space-y-8">
            
            <!-- Section 1 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-building mr-3 text-purple-400"></i>
                    1. Who we are
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    <strong class="text-white">augustAI</strong> ("we", "us", "our") provides agentic automation, dashboards, and AI consulting services globally,
                    operating from the UAE and Pakistan. We are committed to protecting your privacy and ensuring transparency in how we handle your data.
                    Contact us at <code class="bg-gray-800 px-2 py-1 rounded text-blue-400">hello@august.com.pk</code>.
                </p>
            </div>

            <!-- Section 2 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-database mr-3 text-blue-400"></i>
                    2. Information we collect
                </h2>
                <ul class="text-gray-300 space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-user text-green-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span><strong class="text-white">Contact details</strong> you voluntarily provide – name, email, phone, company information.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-file-code text-orange-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span><strong class="text-white">Project files & credentials</strong> you provide for delivery of automation and dashboard services.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-chart-line text-purple-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span><strong class="text-white">Usage data</strong> from our website (IP address, browser type, pages viewed) via cookies and analytics.</span>
                    </li>
                </ul>
            </div>

            <!-- Section 3 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-cogs mr-3 text-green-400"></i>
                    3. How we use your information
                </h2>
                <ul class="text-gray-300 space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-reply text-blue-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span>To respond to inquiries and schedule consultation calls.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-handshake text-purple-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span>To deliver contracted automation, dashboard, and MVP services with support.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope text-yellow-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span>To send occasional product updates and service announcements (opt-out anytime).</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-chart-bar text-green-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span>To improve our website performance and marketing effectiveness.</span>
                    </li>
                </ul>
            </div>

            <!-- Section 4 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-gavel mr-3 text-yellow-400"></i>
                    4. Legal bases
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    We process personal data based on: <span class="text-white font-semibold">(a)</span> your consent; 
                    <span class="text-white font-semibold">(b)</span> performance of a contract; 
                    <span class="text-white font-semibold">(c)</span> our legitimate interest to operate and grow the business; 
                    <span class="text-white font-semibold">(d)</span> compliance with legal obligations in the UAE, Pakistan, or other applicable jurisdictions.
                </p>
            </div>

            <!-- Section 5 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-cookie-bite mr-3 text-orange-400"></i>
                    5. Cookies & analytics
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    We use lightweight analytics (Google Analytics) to understand how visitors use our site and improve the user experience.  
                    You can disable cookies in your browser settings; core site functions will continue to work normally.
                </p>
            </div>

            <!-- Section 6 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-share-alt mr-3 text-pink-400"></i>
                    6. Third-party services
                </h2>
                <p class="text-gray-300 leading-relaxed mb-4">To deliver our services, we may share data with trusted partners:</p>
                <ul class="text-gray-300 space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-envelope text-blue-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Email providers (Postmark, cPanel SMTP) for communication.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-calendar text-green-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Scheduling tools (Calendly) for appointment booking.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-cloud text-purple-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Cloud hosting providers when you authorize a deployment.</span>
                    </li>
                </ul>
                <p class="text-gray-300 leading-relaxed mt-4">
                    All third parties are bound by strict confidentiality and data-processing agreements.
                </p>
            </div>

            <!-- Section 7 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-clock mr-3 text-cyan-400"></i>
                    7. Data retention
                </h2>
                <div class="bg-gray-800/50 rounded-lg p-6 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Inquiry emails</span>
                        <span class="text-yellow-400 font-semibold">24 months</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Client project repositories</span>
                        <span class="text-blue-400 font-semibold">Contract term + 30 days</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Backup archives</span>
                        <span class="text-red-400 font-semibold">30 days then deleted</span>
                    </div>
                </div>
            </div>

            <!-- Section 8 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-user-shield mr-3 text-green-400"></i>
                    8. Your rights
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    You have the right to request access, correction, deletion, or portability of your personal data.
                    Contact us at <code class="bg-gray-800 px-2 py-1 rounded text-blue-400">privacy@august.com.pk</code>.  
                    We respond to all requests within <span class="text-white font-semibold">30 days</span>.
                </p>
            </div>

            <!-- Section 9 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-shield-alt mr-3 text-purple-400"></i>
                    9. Security
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    All data is encrypted in transit using TLS. Access to systems is protected by role-based controls and two-factor authentication.
                    We regularly review and update our security practices to protect your information.
                </p>
            </div>

            <!-- Section 10 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-child mr-3 text-pink-400"></i>
                    10. Children's privacy
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    Our services are designed for businesses and are not directed to anyone under 16 years of age. 
                    We do not knowingly collect personal information from children.
                </p>
            </div>

            <!-- Section 11 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-4 gradient-text flex items-center">
                    <i class="fas fa-edit mr-3 text-yellow-400"></i>
                    11. Policy changes
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    Material changes to this privacy policy will be posted on this page and, where appropriate, emailed to affected users.
                    We encourage you to review this page periodically.
                </p>
            </div>

            <!-- Section 12 -->
            <div class="fade-in">
                <h2 class="text-2xl font-bold mb-6 gradient-text flex items-center">
                    <i class="fas fa-phone mr-3 text-green-400"></i>
                    12. Contact us
                </h2>
                <div class="bg-gradient-to-r from-purple-900/30 to-pink-900/30 rounded-lg p-6 border border-purple-500/30">
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <i class="fas fa-envelope text-blue-400 text-2xl mb-2"></i>
                            <p class="text-gray-300">Email</p>
                            <code class="text-blue-400">privacy@august.com.pk</code>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-phone text-green-400 text-2xl mb-2"></i>
                            <p class="text-gray-300">Phone</p>
                            <p class="text-white font-semibold">+971 58 306 6201</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt text-orange-400 text-2xl mb-2"></i>
                            <p class="text-gray-300">Address</p>
                            <p class="text-white font-semibold">Dubai, UAE</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Navigation -->
            <div class="text-center pt-8 border-t border-gray-700">
                <div class="space-x-6">
                    <a href="/" class="text-purple-400 hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="#services" class="text-purple-400 hover:text-white transition-colors">
                        <i class="fas fa-cogs mr-2"></i>Services
                    </a>
                    <a href="#contact" class="text-purple-400 hover:text-white transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Contact
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
