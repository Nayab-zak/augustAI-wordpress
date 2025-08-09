import os
from flask import Blueprint, request, jsonify
from flask_mail import Mail, Message
from datetime import datetime

contact_bp = Blueprint('contact', __name__)

def init_mail(app):
    """Initialize Flask-Mail with app configuration"""
    app.config['MAIL_SERVER'] = os.getenv('SMTP_HOST', 'smtp.gmail.com')
    app.config['MAIL_PORT'] = int(os.getenv('SMTP_PORT', 587))
    app.config['MAIL_USE_TLS'] = os.getenv('SMTP_SECURE', 'tls').lower() == 'tls'
    app.config['MAIL_USE_SSL'] = os.getenv('SMTP_SECURE', 'tls').lower() == 'ssl'
    app.config['MAIL_USERNAME'] = os.getenv('SMTP_USERNAME')
    app.config['MAIL_PASSWORD'] = os.getenv('SMTP_PASSWORD')
    app.config['MAIL_DEFAULT_SENDER'] = (
        os.getenv('SMTP_FROM_NAME', 'AugustAI Contact Form'),
        os.getenv('SMTP_FROM_EMAIL', 'noreply@august.com.pk')
    )
    
    mail = Mail(app)
    return mail

@contact_bp.route('/contact', methods=['POST'])
def submit_contact_form():
    """Handle contact form submissions"""
    try:
        # Get form data
        data = request.get_json()
        
        if not data:
            return jsonify({'error': 'No data provided'}), 400
        
        # Validate required fields
        required_fields = ['name', 'email', 'message']
        for field in required_fields:
            if not data.get(field):
                return jsonify({'error': f'{field.capitalize()} is required'}), 400
        
        name = data.get('name')
        email = data.get('email')
        company = data.get('company', '')
        phone = data.get('phone', '')
        message = data.get('message')
        subject = data.get('subject', 'New Contact Form Submission')
        
        # Get mail instance from current app
        from flask import current_app
        mail = current_app.extensions.get('mail')
        
        if not mail:
            return jsonify({'error': 'Email service not configured'}), 500
        
        # Create email message
        msg = Message(
            subject=f"[AugustAI] {subject}",
            recipients=[os.getenv('CONTACT_TO_EMAIL', 'info@august.com.pk')]
        )
        
        # Email body
        msg.html = f"""
        <html>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
                <div style="background: linear-gradient(90deg, #B77147 0%, #9B4F2E 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0;">
                    <h2 style="margin: 0;">New Contact Form Submission</h2>
                    <p style="margin: 5px 0 0 0; opacity: 0.9;">From AugustAI Website</p>
                </div>
                
                <div style="background: #f9f9f9; padding: 20px; border-radius: 0 0 8px 8px;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 10px 0; border-bottom: 1px solid #ddd; font-weight: bold; width: 120px;">Name:</td>
                            <td style="padding: 10px 0; border-bottom: 1px solid #ddd;">{name}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 0; border-bottom: 1px solid #ddd; font-weight: bold;">Email:</td>
                            <td style="padding: 10px 0; border-bottom: 1px solid #ddd;"><a href="mailto:{email}" style="color: #B77147;">{email}</a></td>
                        </tr>
                        {f'<tr><td style="padding: 10px 0; border-bottom: 1px solid #ddd; font-weight: bold;">Company:</td><td style="padding: 10px 0; border-bottom: 1px solid #ddd;">{company}</td></tr>' if company else ''}
                        {f'<tr><td style="padding: 10px 0; border-bottom: 1px solid #ddd; font-weight: bold;">Phone:</td><td style="padding: 10px 0; border-bottom: 1px solid #ddd;"><a href="tel:{phone}" style="color: #B77147;">{phone}</a></td></tr>' if phone else ''}
                        <tr>
                            <td style="padding: 10px 0; border-bottom: 1px solid #ddd; font-weight: bold;">Subject:</td>
                            <td style="padding: 10px 0; border-bottom: 1px solid #ddd;">{subject}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 0; font-weight: bold; vertical-align: top;">Message:</td>
                            <td style="padding: 10px 0;">{message.replace(chr(10), '<br>')}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 0; font-weight: bold;">Submitted:</td>
                            <td style="padding: 10px 0;">{datetime.now().strftime('%Y-%m-%d %H:%M:%S UTC')}</td>
                        </tr>
                    </table>
                    
                    <div style="margin-top: 20px; padding: 15px; background: white; border-radius: 5px; border-left: 4px solid #B77147;">
                        <p style="margin: 0; font-size: 14px; color: #666;">
                            This message was sent from the AugustAI website contact form. 
                            Please respond directly to the sender's email address.
                        </p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        """
        
        # Send email
        mail.send(msg)
        
        return jsonify({
            'success': True,
            'message': 'Thank you for your message! We will get back to you soon.'
        }), 200
        
    except Exception as e:
        print(f"Error sending email: {str(e)}")
        return jsonify({
            'error': 'Failed to send message. Please try again or contact us directly.',
            'details': str(e) if os.getenv('FLASK_ENV') == 'development' else None
        }), 500

@contact_bp.route('/contact/test', methods=['GET'])
def test_email_config():
    """Test endpoint to verify email configuration"""
    try:
        from flask import current_app
        mail = current_app.extensions.get('mail')
        
        if not mail:
            return jsonify({'error': 'Email service not configured'}), 500
        
        # Try to send a test email
        msg = Message(
            subject="[AugustAI] Email Configuration Test",
            recipients=[os.getenv('CONTACT_TO_EMAIL', 'info@august.com.pk')],
            html="<p>This is a test email to verify the email configuration is working correctly.</p>"
        )
        
        mail.send(msg)
        
        return jsonify({
            'success': True,
            'message': 'Test email sent successfully!'
        }), 200
        
    except Exception as e:
        return jsonify({
            'error': 'Email configuration test failed',
            'details': str(e)
        }), 500

