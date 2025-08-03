<?php
/**
 * Contact Component
 * Renders the contact section with form and information
 */

// Load configuration if not already loaded
if (!isset($content_config)) {
    $content_config = require_once __DIR__ . '/../content-config.php';
}
?>

<!-- Contact Section -->
<section id="contact" class="py-20 px-4 bg-gradient-to-r from-gray-900/50 to-purple-900/20">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Get Started Today</h2>
            <p class="text-xl text-gray-300 mb-8">
                Ready to automate your workflows? Let's discuss your project and see how we can help.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="glass-card p-8 fade-in">
                <h3 class="text-2xl font-bold mb-6">Send us a message</h3>
                <form id="contact-form" class="space-y-6">
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" id="name" name="name" required class="form-input" placeholder="Your full name">
                        <div class="error-message" id="name-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" id="email" name="email" required class="form-input" placeholder="your.email@company.com">
                        <div class="error-message" id="email-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" id="company" name="company" class="form-input" placeholder="Your company name">
                    </div>
                    
                    <div class="form-group">
                        <label for="service" class="form-label">Service Interest</label>
                        <select id="service" name="service" class="form-input form-select">
                            <option value="">Select a service</option>
                            <option value="llm">LLM & Private Chatbots</option>
                            <option value="automation">Agentic Automations</option>
                            <option value="dashboards">Dashboards in 10 Days</option>
                            <option value="mvp">MVP-in-30</option>
                            <option value="consulting">AI Workshops & Due-Diligence</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="form-label">Project Description *</label>
                        <textarea id="message" name="message" required class="form-input form-textarea" rows="4" placeholder="Tell us about your project, current challenges, and what you'd like to automate..."></textarea>
                        <div class="error-message" id="message-error"></div>
                    </div>
                    
                    <button type="submit" class="btn-primary w-full" id="submit-btn">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                    
                    <div class="form-message" id="form-response"></div>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div class="space-y-8 fade-in">
                <div class="glass-card p-6">
                    <h3 class="text-xl font-bold mb-4">Quick Response</h3>
                    <p class="text-gray-300 mb-4">Get a response within 2 hours during business hours.</p>
                    <div class="flex items-center space-x-3 text-green-400">
                        <i class="fas fa-clock"></i>
                        <span>Usually responds in under 2 hours</span>
                    </div>
                </div>
                
                <div class="glass-card p-6">
                    <h3 class="text-xl font-bold mb-4">Schedule a Call</h3>
                    <p class="text-gray-300 mb-4">Prefer to talk? Book a 30-minute consultation call.</p>
                    <button onclick="openCalendlyModal()" class="btn-primary w-full">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Book 30-min Call
                    </button>
                </div>
                
                <div class="glass-card p-6">
                    <h3 class="text-xl font-bold mb-4">Office Locations</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-purple-400 mt-1"></i>
                            <div>
                                <p class="font-semibold">Lahore, Pakistan</p>
                                <p class="text-gray-400 text-sm">Main development hub</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1"></i>
                            <div>
                                <p class="font-semibold">Dubai, UAE</p>
                                <p class="text-gray-400 text-sm">Business operations</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="glass-card p-6">
                    <h3 class="text-xl font-bold mb-4">Response Time</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Project inquiries:</span>
                            <span class="text-green-400">< 2 hours</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Technical questions:</span>
                            <span class="text-blue-400">< 4 hours</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Support requests:</span>
                            <span class="text-purple-400">< 1 hour</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Contact Form Styles */
.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    font-size: 14px;
}

.form-input {
    width: 100%;
    padding: 14px 16px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    color: white;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.form-input:focus {
    outline: none;
    border-color: #A855F7;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    background: rgba(255, 255, 255, 0.12);
}

.form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    padding-right: 40px;
    appearance: none;
}

.form-select option {
    background: #1a1a2e;
    color: white;
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.error-message {
    color: #fecaca;
    font-size: 14px;
    margin-top: 4px;
    display: none;
}

.error-message.show {
    display: block;
}

.form-message {
    margin-top: 8px;
    font-size: 14px;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.form-message.show {
    opacity: 1;
    transform: translateY(0);
}

.form-message.success {
    color: #4ade80;
}

.form-message.error {
    color: #ef4444;
}
</style>

<script>
// Contact form handling
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    const responseDiv = document.getElementById('form-response');
    
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            
            // Get form data
            const formData = new FormData(form);
            
            try {
                // Here you would typically send to your backend
                // For now, we'll simulate a successful submission
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                // Show success message
                responseDiv.className = 'form-message success show';
                responseDiv.textContent = 'Thank you! Your message has been sent. We\'ll respond within 2 hours.';
                
                // Reset form
                form.reset();
                
            } catch (error) {
                // Show error message
                responseDiv.className = 'form-message error show';
                responseDiv.textContent = 'There was an error sending your message. Please try again.';
            } finally {
                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Send Message';
            }
        });
    }
});

// Calendly modal function
function openCalendlyModal() {
    // This would integrate with Calendly
    alert('Calendly booking would open here');
}
</script>
