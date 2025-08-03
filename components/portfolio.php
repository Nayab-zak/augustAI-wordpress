<?php
/**
 * Portfolio Component
 * Renders the portfolio/case studies section
 */

// Load configuration if not already loaded
if (!isset($content_config)) {
    $content_config = require_once __DIR__ . '/../content-config.php';
}

// Sample portfolio data (this would come from CMS in the future)
$portfolio_items = [
    [
        'id' => 'fintech-automation',
        'title' => 'FinTech Report Automation',
        'category' => 'Automation',
        'client' => 'Regional Bank',
        'image' => 'assets/portfolio-fintech.jpg',
        'description' => 'Automated daily regulatory reporting, reducing 8-hour manual process to 15 minutes.',
        'results' => [
            '95% time savings on daily reports',
            '$50k annual cost reduction',
            'Zero compliance errors since deployment'
        ],
        'tech_stack' => ['Python', 'Pandas', 'SQL', 'REST APIs'],
        'delivery_time' => '12 days'
    ],
    [
        'id' => 'ecommerce-dashboard',
        'title' => 'E-commerce Analytics Dashboard',
        'category' => 'Dashboard',
        'client' => 'Online Retailer',
        'image' => 'assets/portfolio-ecommerce.jpg',
        'description' => 'Real-time dashboard tracking sales, inventory, and customer metrics across multiple channels.',
        'results' => [
            'Unified view of 5 sales channels',
            '3x faster decision making',
            '20% increase in operational efficiency'
        ],
        'tech_stack' => ['Python', 'Plotly', 'PostgreSQL', 'Shopify API'],
        'delivery_time' => '8 days'
    ],
    [
        'id' => 'healthcare-mvp',
        'title' => 'Patient Management MVP',
        'category' => 'MVP',
        'client' => 'Healthcare Startup',
        'image' => 'assets/portfolio-healthcare.jpg',
        'description' => 'Patient booking and management system with automated reminders and telehealth integration.',
        'results' => [
            'Successfully raised $500k seed round',
            '200+ active patients in first month',
            '40% reduction in no-shows'
        ],
        'tech_stack' => ['React', 'Node.js', 'MongoDB', 'Twilio API'],
        'delivery_time' => '28 days'
    ],
    [
        'id' => 'supply-chain-chatbot',
        'title' => 'Supply Chain AI Assistant',
        'category' => 'LLM',
        'client' => 'Manufacturing Company',
        'image' => 'assets/portfolio-chatbot.jpg',
        'description' => 'AI chatbot trained on supplier data, procurement policies, and inventory management procedures.',
        'results' => [
            '70% reduction in procurement queries',
            '2-hour average response time improvement',
            '90% user satisfaction rating'
        ],
        'tech_stack' => ['OpenAI GPT-4', 'LangChain', 'Vector DB', 'Slack API'],
        'delivery_time' => '16 days'
    ],
    [
        'id' => 'logistics-optimization',
        'title' => 'Route Optimization System',
        'category' => 'Automation',
        'client' => 'Delivery Service',
        'image' => 'assets/portfolio-logistics.jpg',
        'description' => 'Automated route planning and driver assignment system with real-time traffic integration.',
        'results' => [
            '25% reduction in delivery times',
            '$30k monthly fuel savings',
            '99.2% on-time delivery rate'
        ],
        'tech_stack' => ['Python', 'Google Maps API', 'ML Algorithms', 'Redis'],
        'delivery_time' => '21 days'
    ],
    [
        'id' => 'hr-analytics',
        'title' => 'HR Analytics Dashboard',
        'category' => 'Dashboard',
        'client' => 'Tech Company',
        'image' => 'assets/portfolio-hr.jpg',
        'description' => 'Comprehensive HR metrics dashboard tracking recruitment, retention, and performance data.',
        'results' => [
            'Improved hiring decision accuracy by 35%',
            'Reduced time-to-hire by 40%',
            'Identified key retention factors'
        ],
        'tech_stack' => ['Power BI', 'Python', 'SQL Server', 'HR APIs'],
        'delivery_time' => '10 days'
    ]
];
?>

<!-- Portfolio Section -->
<section id="portfolio" class="py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Portfolio & Case Studies</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Real projects, real results. See how we've helped businesses automate workflows and build solutions.
            </p>
        </div>
        
        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-12 fade-in">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="automation">Automation</button>
            <button class="filter-btn" data-filter="dashboard">Dashboards</button>
            <button class="filter-btn" data-filter="mvp">MVPs</button>
            <button class="filter-btn" data-filter="llm">AI/LLM</button>
        </div>
        
        <!-- Portfolio Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
            <?php foreach ($portfolio_items as $item): ?>
            <div class="portfolio-item fade-in" data-category="<?php echo strtolower($item['category']); ?>">
                <div class="glass-card overflow-hidden hover:scale-105 transition-all duration-300">
                    <!-- Project Image -->
                    <div class="h-48 bg-gradient-to-br from-purple-600 to-blue-600 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-<?php 
                                    switch($item['category']) {
                                        case 'Automation': echo 'robot'; break;
                                        case 'Dashboard': echo 'chart-bar'; break;
                                        case 'MVP': echo 'rocket'; break;
                                        case 'LLM': echo 'comments'; break;
                                        default: echo 'cog';
                                    }
                                ?> text-4xl text-white mb-2"></i>
                                <span class="text-white font-semibold"><?php echo $item['category']; ?></span>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm">
                                <?php echo $item['delivery_time']; ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Project Content -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-purple-400 text-sm font-medium"><?php echo $item['client']; ?></span>
                            <span class="text-gray-400 text-xs"><?php echo $item['category']; ?></span>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-3"><?php echo $item['title']; ?></h3>
                        <p class="text-gray-300 text-sm mb-4 line-clamp-2"><?php echo $item['description']; ?></p>
                        
                        <!-- Results -->
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-green-400 mb-2">Key Results:</h4>
                            <ul class="space-y-1">
                                <?php foreach (array_slice($item['results'], 0, 2) as $result): ?>
                                <li class="text-xs text-gray-300 flex items-start">
                                    <i class="fas fa-check text-green-400 text-xs mt-1 mr-2 flex-shrink-0"></i>
                                    <span><?php echo $result; ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <!-- Tech Stack -->
                        <div class="mb-4">
                            <div class="flex flex-wrap gap-1">
                                <?php foreach (array_slice($item['tech_stack'], 0, 3) as $tech): ?>
                                <span class="bg-gray-800/50 text-gray-300 px-2 py-1 rounded text-xs"><?php echo $tech; ?></span>
                                <?php endforeach; ?>
                                <?php if (count($item['tech_stack']) > 3): ?>
                                <span class="text-gray-400 text-xs">+<?php echo count($item['tech_stack']) - 3; ?> more</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- CTA -->
                        <button class="w-full bg-gradient-to-r from-purple-500/20 to-blue-500/20 border border-purple-500/30 text-white py-2 rounded-lg text-sm font-medium hover:bg-purple-500/30 transition-all"
                                onclick="openProjectModal('<?php echo $item['id']; ?>')">
                            View Case Study
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Portfolio CTA -->
        <div class="text-center mt-16 fade-in">
            <div class="glass-card p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold mb-4">Ready to Join Our Success Stories?</h3>
                <p class="text-gray-300 mb-6">
                    Let's discuss your project and see how we can deliver similar results for your business.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="openCalendlyModal()" class="btn-primary">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Book Consultation
                    </button>
                    <button onclick="scrollToSection('contact')" class="glass-card px-6 py-3 font-semibold hover:scale-105 transition-transform">
                        <i class="fas fa-envelope mr-2"></i>
                        Get a Quote
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Portfolio Styles */
.filter-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.8);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    background: rgba(139, 92, 246, 0.2);
    border-color: rgba(139, 92, 246, 0.5);
    color: white;
}

.filter-btn.active {
    background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);
    border-color: transparent;
    color: white;
}

.portfolio-item {
    transition: all 0.3s ease;
}

.portfolio-item.hidden {
    opacity: 0;
    transform: scale(0.8);
    pointer-events: none;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Project Modal Styles */
.project-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    z-index: 10000;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-modal.active {
    display: flex;
    opacity: 1;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.project-modal-content {
    background: linear-gradient(135deg, rgba(30, 27, 58, 0.95) 0%, rgba(45, 27, 78, 0.95) 100%);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    width: 100%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    transform: scale(0.9);
    transition: transform 0.3s ease;
}

.project-modal.active .project-modal-content {
    transform: scale(1);
}

.modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 20px;
    cursor: pointer;
    z-index: 10001;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: scale(1.1);
}
</style>

<script>
// Portfolio filtering
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            portfolioItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
});

// Project modal functions
function openProjectModal(projectId) {
    // This would open a detailed modal with the project case study
    alert(`Opening case study for project: ${projectId}`);
}

function openCalendlyModal() {
    alert('Calendly booking would open here');
}

function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>
