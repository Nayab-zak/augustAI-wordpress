<?php
/**
 * Services Component
 * Renders the services section with all service cards
 */

// Load configuration if not already loaded
if (!isset($services)) {
    $content_config = require_once __DIR__ . '/../content-config.php';
    $services = $content_config['services'];
}
?>

<!-- Services Section -->
<section id="services" class="py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Our Services</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Choose from our carefully crafted packages designed to deliver maximum value in minimum time
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $service_id => $service): ?>
            <!-- <?php echo ucfirst($service['name']); ?> -->
            <div id="<?php echo $service_id; ?>" class="glass-card p-8 hover:scale-105 transition-all duration-300 fade-in relative<?php echo isset($service['border_highlight']) && $service['border_highlight'] ? ' border-2 border-purple-500/50' : ''; ?>">
                <?php if (isset($service['border_highlight']) && $service['border_highlight']): ?>
                <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                    <span class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-1 rounded-full text-sm font-medium"><?php echo $service['badge']; ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (isset($service['intro_pricing']) && $service['intro_pricing']): ?>
                <!-- Intro pricing badge for services with early bird pricing -->
                <div class="intro-pricing-badge">
                    <?php echo $service['intro_note']; ?>
                </div>
                <?php endif; ?>
                
                <div class="w-16 h-16 bg-gradient-to-r <?php echo $service['gradient']; ?> rounded-xl flex items-center justify-center mb-6">
                    <i class="<?php echo $service['icon']; ?> text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4"><?php echo $service['name']; ?></h3>
                <p class="text-gray-300 mb-6"><?php echo $service['tagline']; ?></p>
                
                <ul class="space-y-3 mb-8">
                    <?php foreach ($service['features'] as $feature): ?>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-400 mt-1 mr-3 flex-shrink-0"></i>
                        <span class="text-gray-300 text-sm"><?php echo $feature; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="mb-6">
                    <?php if (isset($service['price_to'])): ?>
                        <div class="text-2xl font-bold gradient-text"><?php echo $service['intro_note']; ?>: $<?php echo number_format($service['price_from']); ?> – $<?php echo number_format($service['price_to']); ?></div>
                    <?php elseif (isset($service['price_workshop'])): ?>
                        <div class="text-xl font-bold gradient-text">Workshop: $<?php echo number_format($service['price_workshop']); ?> • DD: $<?php echo number_format($service['price_dd']); ?></div>
                    <?php else: ?>
                        <div class="text-2xl font-bold gradient-text">From $<?php echo number_format($service['price_from']); ?></div>
                    <?php endif; ?>
                    <p class="text-sm text-gray-400">
                        <?php if ($service['delivery_days'] < 30): ?>
                            ⚡ <?php echo $service['delivery_days']; ?> days delivery
                        <?php else: ?>
                            🚀 <?php echo $service['delivery_days']; ?> days delivery
                        <?php endif; ?>
                    </p>
                </div>
                
                <button onclick="openCalendlyModal()" class="w-full btn-primary">
                    <?php echo isset($service['cta_text']) ? $service['cta_text'] : 'Book 30-min Call'; ?>
                </button>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Service Overview -->
        <div class="mt-16 text-center fade-in">
            <div class="bg-gray-800/30 rounded-xl p-8 border border-gray-700/30">
                <h3 class="text-xl font-bold mb-6">Why Choose Our Fixed-Scope Approach?</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <i class="fas fa-clock text-blue-400 text-2xl mb-3"></i>
                        <h4 class="font-semibold mb-2">Predictable Timeline</h4>
                        <p class="text-gray-400 text-sm">Fixed delivery dates, no scope creep</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-dollar-sign text-green-400 text-2xl mb-3"></i>
                        <h4 class="font-semibold mb-2">Fixed Investment</h4>
                        <p class="text-gray-400 text-sm">Know exactly what you'll pay upfront</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-shield-check text-purple-400 text-2xl mb-3"></i>
                        <h4 class="font-semibold mb-2">Guaranteed Results</h4>
                        <p class="text-gray-400 text-sm">14-day warranty on every project</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
