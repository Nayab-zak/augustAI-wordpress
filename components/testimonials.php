<?php
/**
 * Testimonials Component
 * Renders client testimonials and reviews
 */

// Load configuration if not already loaded
if (!isset($content_config)) {
    $content_config = require_once __DIR__ . '/../content-config.php';
}

// Sample testimonials data (this would come from CMS in the future)
$testimonials = [
    [
        'id' => 1,
        'name' => 'Sarah Chen',
        'position' => 'Operations Director',
        'company' => 'TechStart Solutions',
        'avatar' => 'assets/testimonial-sarah.jpg',
        'rating' => 5,
        'content' => 'augustAI transformed our manual reporting process completely. What used to take our team 8 hours every day now runs automatically in 15 minutes. The ROI was immediate and the support has been exceptional.',
        'project_type' => 'Automation',
        'result' => '95% time savings',
        'featured' => true
    ],
    [
        'id' => 2,
        'name' => 'Ahmed Al-Rashid',
        'position' => 'CEO',
        'company' => 'Gulf Logistics',
        'avatar' => 'assets/testimonial-ahmed.jpg',
        'rating' => 5,
        'content' => 'The dashboard they built gives us real-time visibility into our entire supply chain. Decision-making is now data-driven rather than gut feeling. Brilliant work delivered on time.',
        'project_type' => 'Dashboard',
        'result' => '3x faster decisions',
        'featured' => true
    ],
    [
        'id' => 3,
        'name' => 'Dr. Maria Rodriguez',
        'position' => 'Founder',
        'company' => 'HealthFlow Startup',
        'avatar' => 'assets/testimonial-maria.jpg',
        'rating' => 5,
        'content' => 'They built our patient management MVP in exactly 30 days as promised. The quality was investor-ready and helped us secure our seed round. Couldn\'t be happier with the outcome.',
        'project_type' => 'MVP',
        'result' => '$500k raised',
        'featured' => true
    ],
    [
        'id' => 4,
        'name' => 'James Mitchell',
        'position' => 'VP Technology',
        'company' => 'FinanceCore Bank',
        'avatar' => 'assets/testimonial-james.jpg',
        'rating' => 5,
        'content' => 'The AI chatbot they developed for our internal processes is a game-changer. Our employees get instant answers to policy questions instead of waiting hours for email responses.',
        'project_type' => 'AI/LLM',
        'result' => '70% fewer support tickets',
        'featured' => false
    ],
    [
        'id' => 5,
        'name' => 'Lisa Park',
        'position' => 'COO',
        'company' => 'RetailMax',
        'avatar' => 'assets/testimonial-lisa.jpg',
        'rating' => 5,
        'content' => 'Professional, responsive, and results-driven. They understood our e-commerce challenges immediately and delivered a solution that exceeded our expectations.',
        'project_type' => 'Dashboard',
        'result' => '20% efficiency gain',
        'featured' => false
    ],
    [
        'id' => 6,
        'name' => 'Robert Kim',
        'position' => 'Head of Operations',
        'company' => 'Manufacturing Plus',
        'avatar' => 'assets/testimonial-robert.jpg',
        'rating' => 5,
        'content' => 'The automation workflow they built for our procurement process has saved us countless hours and eliminated human errors. The documentation and training were thorough.',
        'project_type' => 'Automation',
        'result' => 'Zero processing errors',
        'featured' => false
    ]
];

// Separate featured testimonials
$featured_testimonials = array_filter($testimonials, function($t) { return $t['featured']; });
$all_testimonials = $testimonials;
?>

<!-- Testimonials Section -->
<section id="testimonials" class="py-20 px-4 bg-gradient-to-r from-purple-900/20 to-pink-900/20">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">What Our Clients Say</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Don't just take our word for it. Here's what business leaders say about working with augustAI.
            </p>
        </div>
        
        <!-- Trust Indicators -->
        <div class="flex flex-wrap justify-center items-center gap-12 mb-16 fade-in">
            <div class="text-center">
                <div class="text-3xl font-bold gradient-text mb-2">50+</div>
                <p class="text-gray-400">Projects Delivered</p>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold gradient-text mb-2">5.0★</div>
                <p class="text-gray-400">Average Rating</p>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold gradient-text mb-2">100%</div>
                <p class="text-gray-400">Satisfaction Rate</p>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold gradient-text mb-2">14</div>
                <p class="text-gray-400">Day Warranty</p>
            </div>
        </div>
        
        <!-- Featured Testimonials Carousel -->
        <div class="mb-16 fade-in">
            <h3 class="text-2xl font-bold text-center mb-8">Featured Success Stories</h3>
            <div class="testimonial-carousel-container relative">
                <div class="testimonial-carousel" id="featured-carousel">
                    <?php foreach ($featured_testimonials as $index => $testimonial): ?>
                    <div class="testimonial-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="glass-card p-8 max-w-4xl mx-auto">
                            <div class="grid md:grid-cols-3 gap-8 items-center">
                                <!-- Quote -->
                                <div class="md:col-span-2">
                                    <div class="flex items-center mb-4">
                                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <?php endfor; ?>
                                        <span class="ml-3 text-purple-400 font-medium"><?php echo $testimonial['project_type']; ?></span>
                                    </div>
                                    <blockquote class="text-lg text-gray-300 mb-6 italic">
                                        "<?php echo $testimonial['content']; ?>"
                                    </blockquote>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-semibold text-white"><?php echo $testimonial['name']; ?></div>
                                            <div class="text-gray-400 text-sm"><?php echo $testimonial['position']; ?></div>
                                            <div class="text-purple-400 text-sm"><?php echo $testimonial['company']; ?></div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-green-400 font-semibold"><?php echo $testimonial['result']; ?></div>
                                            <div class="text-gray-400 text-sm">Key Result</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Avatar -->
                                <div class="text-center">
                                    <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-purple-400 to-blue-400 flex items-center justify-center mb-4">
                                        <span class="text-white font-bold text-xl">
                                            <?php echo substr($testimonial['name'], 0, 1) . substr(explode(' ', $testimonial['name'])[1], 0, 1); ?>
                                        </span>
                                    </div>
                                    <div class="bg-gray-800/50 rounded-lg p-3">
                                        <div class="text-purple-400 font-semibold text-sm">Project Type</div>
                                        <div class="text-white"><?php echo $testimonial['project_type']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Carousel Controls -->
                <div class="flex justify-center mt-8 space-x-2">
                    <?php foreach ($featured_testimonials as $index => $testimonial): ?>
                    <button class="carousel-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                            onclick="goToSlide(<?php echo $index; ?>)"></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- All Testimonials Grid -->
        <div class="fade-in">
            <h3 class="text-2xl font-bold text-center mb-8">More Client Feedback</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($all_testimonials as $testimonial): ?>
                <div class="glass-card p-6 hover:scale-105 transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <?php endfor; ?>
                        <span class="ml-2 text-purple-400 text-sm"><?php echo $testimonial['project_type']; ?></span>
                    </div>
                    
                    <blockquote class="text-gray-300 text-sm mb-4 italic line-clamp-3">
                        "<?php echo $testimonial['content']; ?>"
                    </blockquote>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-white text-sm"><?php echo $testimonial['name']; ?></div>
                            <div class="text-gray-400 text-xs"><?php echo $testimonial['position']; ?></div>
                            <div class="text-purple-400 text-xs"><?php echo $testimonial['company']; ?></div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-blue-400 flex items-center justify-center">
                            <span class="text-white font-bold text-sm">
                                <?php echo substr($testimonial['name'], 0, 1); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-3 pt-3 border-t border-gray-700/50">
                        <div class="text-green-400 font-semibold text-sm"><?php echo $testimonial['result']; ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Call to Action -->
        <div class="text-center mt-16 fade-in">
            <div class="glass-card p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold mb-4">Ready to Join Our Success Stories?</h3>
                <p class="text-gray-300 mb-6">
                    Let's discuss your project and see how we can help you achieve similar results.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="openCalendlyModal()" class="btn-primary">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Book Free Consultation
                    </button>
                    <button onclick="scrollToSection('contact')" class="glass-card px-6 py-3 font-semibold hover:scale-105 transition-transform">
                        <i class="fas fa-envelope mr-2"></i>
                        Get Started Today
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Testimonials Styles */
.testimonial-carousel-container {
    position: relative;
    overflow: hidden;
}

.testimonial-carousel {
    display: flex;
    transition: transform 0.5s ease;
}

.testimonial-slide {
    min-width: 100%;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.testimonial-slide.active {
    opacity: 1;
}

.carousel-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid rgba(139, 92, 246, 0.5);
    background: transparent;
    cursor: pointer;
    transition: all 0.3s ease;
}

.carousel-dot.active {
    background: #8B5CF6;
    border-color: #8B5CF6;
}

.carousel-dot:hover {
    border-color: #A855F7;
    background: rgba(139, 92, 246, 0.3);
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Rating stars animation */
.fas.fa-star {
    animation: starGlow 2s ease-in-out infinite alternate;
}

@keyframes starGlow {
    0% { opacity: 0.8; }
    100% { opacity: 1; }
}

/* Auto-scroll animation */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.testimonial-slide.active {
    animation: slideIn 0.5s ease;
}
</style>

<script>
// Testimonials carousel functionality
let currentSlide = 0;
const slides = document.querySelectorAll('.testimonial-slide');
const dots = document.querySelectorAll('.carousel-dot');
const totalSlides = slides.length;

function goToSlide(slideIndex) {
    // Remove active class from current slide and dot
    slides[currentSlide].classList.remove('active');
    dots[currentSlide].classList.remove('active');
    
    // Update current slide
    currentSlide = slideIndex;
    
    // Add active class to new slide and dot
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
}

function nextSlide() {
    goToSlide((currentSlide + 1) % totalSlides);
}

// Auto-advance carousel every 5 seconds
setInterval(nextSlide, 5000);

// Smooth scrolling function
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

// Calendly modal function
function openCalendlyModal() {
    alert('Calendly booking would open here');
}

// Initialize carousel
document.addEventListener('DOMContentLoaded', function() {
    // Ensure first slide is active
    if (slides.length > 0) {
        slides[0].classList.add('active');
        dots[0].classList.add('active');
    }
});
</script>
