// Mobile navigation toggle
const navToggle = document.getElementById('nav-toggle');
const navMenu = document.getElementById('nav-menu');

navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
    });
});

// FAQ accordion
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle('active');
        
        // Close other FAQ items
        document.querySelectorAll('.faq-item').forEach(item => {
            if (item !== faqItem) {
                item.classList.remove('active');
            }
        });
    });
});

// Calendly integration
function openCalendly() {
    if (typeof Calendly !== 'undefined') {
        Calendly.initPopupWidget({
            url: 'https://calendly.com/admin-august/30min'
        });
    } else {
        // Fallback to direct link
        window.open('https://calendly.com/admin-august/30min', '_blank');
    }
    return false;
}

// Demo modal functionality
const demoModal = document.getElementById('demo-modal');
const modalClose = document.querySelector('.modal-close');

function requestDemo(service) {
    document.getElementById('demo-service').value = service;
    demoModal.style.display = 'block';
}

function showSampleDashboard() {
    // For now, just open calendly for a demo call
    openCalendly();
}

modalClose.addEventListener('click', () => {
    demoModal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === demoModal) {
        demoModal.style.display = 'none';
    }
});

// Contact form submission
document.getElementById('contact-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    // Check consent
    if (!data.consent) {
        alert('Please accept our privacy terms to continue.');
        return;
    }
    
    try {
        const response = await fetch('/api/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            document.getElementById('form-success').style.display = 'block';
            document.getElementById('form-error').style.display = 'none';
            document.getElementById('contact-form').style.display = 'none';
        } else {
            throw new Error(result.error);
        }
    } catch (error) {
        document.getElementById('form-error').style.display = 'block';
        document.getElementById('form-success').style.display = 'none';
        console.error('Form submission error:', error);
    }
});

// Demo form submission
document.getElementById('demo-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    try {
        const response = await fetch('/api/demo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Demo request sent successfully! We\'ll contact you within 24 hours.');
            demoModal.style.display = 'none';
            document.getElementById('demo-form').reset();
        } else {
            throw new Error(result.error);
        }
    } catch (error) {
        alert('Failed to send demo request. Please try again or contact us directly.');
        console.error('Demo form submission error:', error);
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add scroll effect to navbar
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) {
        navbar.style.backgroundColor = 'rgba(26, 32, 44, 0.95)';
        navbar.style.backdropFilter = 'blur(10px)';
    } else {
        navbar.style.backgroundColor = 'var(--secondary-bg)';
        navbar.style.backdropFilter = 'none';
    }
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe cards and sections for animation
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.outcome-card, .service-teaser-card, .service-card, .case-study, .testimonial');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// WhatsApp click tracking
document.querySelectorAll('a[href*="wa.me"]').forEach(link => {
    link.addEventListener('click', () => {
        // Track WhatsApp clicks for analytics
        console.log('WhatsApp link clicked');
    });
});

// Phone click tracking
document.querySelectorAll('a[href^="tel:"]').forEach(link => {
    link.addEventListener('click', () => {
        // Track phone clicks for analytics
        console.log('Phone link clicked');
    });
});

// Email click tracking
document.querySelectorAll('a[href^="mailto:"]').forEach(link => {
    link.addEventListener('click', () => {
        // Track email clicks for analytics
        console.log('Email link clicked');
    });
});