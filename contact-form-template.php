<?php
// WordPress template for contact form
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<div class="augustai-contact-form-wp">
    <form id="augustai-wp-contact-form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">
        <?php wp_nonce_field('augustai_contact_nonce', 'nonce'); ?>
        <input type="hidden" name="action" value="augustai_contact">
        
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone">
        </div>
        
        <div class="form-group">
            <label for="service">Service Interest</label>
            <select id="service" name="service">
                <option value="">Select a service</option>
                <option value="AI/ML Development">AI/ML Development</option>
                <option value="Process Automation">Process Automation</option>
                <option value="Business Intelligence">Business Intelligence</option>
                <option value="Workflow Streamlining">Workflow Streamlining</option>
                <option value="General Inquiry">General Inquiry</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" rows="5" required placeholder="Describe your workflow challenge or automation need..."></textarea>
        </div>
        
        <div class="form-consent">
            <label class="checkbox-label">
                <input type="checkbox" id="consent" name="consent" required>
                <span class="checkmark"></span>
                By submitting, you accept our <a href="<?php echo home_url('/privacy'); ?>" target="_blank">privacy terms</a>.
            </label>
        </div>
        
        <button type="submit" class="btn-primary">Send Message</button>
    </form>
    
    <div id="wp-form-success" class="form-message success" style="display: none;">
        <h4>Message sent successfully!</h4>
        <p>Thanks for reaching out. We'll get back to you within 24 hours.</p>
    </div>
    
    <div id="wp-form-error" class="form-message error" style="display: none;">
        <h4>Failed to send message</h4>
        <p>Please try again or contact us directly via phone or WhatsApp.</p>
    </div>
</div>

<script>
document.getElementById('augustai-wp-contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('wp-form-success').style.display = 'block';
            document.getElementById('wp-form-error').style.display = 'none';
            this.style.display = 'none';
        } else {
            document.getElementById('wp-form-error').style.display = 'block';
            document.getElementById('wp-form-success').style.display = 'none';
        }
    })
    .catch(error => {
        document.getElementById('wp-form-error').style.display = 'block';
        document.getElementById('wp-form-success').style.display = 'none';
        console.error('Form submission error:', error);
    });
});
</script>