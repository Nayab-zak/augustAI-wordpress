<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - AugustAI</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="<?php echo home_url(); ?>" style="text-decoration: none;">
                    <span class="logo-text">august<span class="logo-ai">AI</span></span>
                </a>
            </div>
            <div class="nav-menu">
                <a href="<?php echo home_url(); ?>" class="nav-link">← Back to Home</a>
            </div>
        </div>
    </nav>

    <!-- 404 Content -->
    <section class="error-page">
        <div class="container">
            <div class="error-content">
                <h1>404</h1>
                <h2>Page Not Found</h2>
                <p>The page you're looking for doesn't exist or has been moved.</p>
                
                <div class="error-actions">
                    <a href="<?php echo home_url(); ?>" class="btn-primary">Go Home</a>
                    <button class="btn-secondary" onclick="openCalendly()">Book a Call</button>
                </div>
                
                <div class="quick-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo home_url(); ?>#services">Our Services</a></li>
                        <li><a href="<?php echo home_url(); ?>#case-studies">Case Studies</a></li>
                        <li><a href="<?php echo home_url(); ?>#contact">Contact Us</a></li>
                        <li><a href="<?php echo home_url(); ?>/privacy.html">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div class="contact-options">
                    <p>Need immediate help?</p>
                    <div class="contact-buttons">
                        <a href="https://wa.me/971554483607" class="btn-primary" target="_blank">WhatsApp</a>
                        <a href="tel:+971583066201" class="btn-primary">Call Now</a>
                        <a href="mailto:hello@august.com.pk" class="btn-primary">Email</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Calendly Script -->
    <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
    <script>
    function openCalendly() {
        if (typeof Calendly !== 'undefined') {
            Calendly.initPopupWidget({
                url: 'https://calendly.com/admin-august/30min'
            });
        } else {
            window.open('https://calendly.com/admin-august/30min', '_blank');
        }
        return false;
    }
    </script>

    <style>
    .error-page {
        padding: 4rem 0;
        background-color: var(--primary-bg);
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    .error-content {
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
        background-color: var(--card-bg);
        padding: 3rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
    }

    .error-content h1 {
        font-size: 6rem;
        color: var(--accent-blue);
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .error-content h2 {
        font-size: 2rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .error-content p {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .error-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 3rem;
        flex-wrap: wrap;
    }

    .quick-links {
        margin-bottom: 2rem;
        text-align: left;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    .quick-links h3 {
        color: var(--accent-green);
        margin-bottom: 1rem;
        text-align: center;
    }

    .quick-links ul {
        list-style: none;
        padding: 0;
    }

    .quick-links li {
        margin-bottom: 0.5rem;
        padding-left: 1rem;
        position: relative;
    }

    .quick-links li::before {
        content: "→";
        position: absolute;
        left: 0;
        color: var(--accent-blue);
    }

    .quick-links a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
    }

    .quick-links a:hover {
        color: var(--accent-blue);
    }

    .contact-options {
        border-top: 1px solid var(--border-color);
        padding-top: 2rem;
    }

    .contact-options p {
        margin-bottom: 1rem;
        color: var(--text-secondary);
    }

    .contact-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .contact-buttons .btn-primary {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .error-content {
            padding: 2rem 1.5rem;
            margin: 0 1rem;
        }
        
        .error-content h1 {
            font-size: 4rem;
        }
        
        .error-actions {
            flex-direction: column;
            align-items: center;
        }
        
        .contact-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
    </style>
</body>
</html>