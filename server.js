import express from 'express';
import nodemailer from 'nodemailer';
import cors from 'cors';
import dotenv from 'dotenv';
import path from 'path';
import { fileURLToPath } from 'url';

dotenv.config();

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = process.env.PORT || 3001;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.static('.'));

// Email transporter
const transporter = nodemailer.createTransporter({
  host: process.env.SMTP_HOST,
  port: process.env.SMTP_PORT,
  secure: false,
  auth: {
    user: process.env.SMTP_USERNAME,
    pass: process.env.SMTP_PASSWORD
  }
});

// Contact form endpoint
app.post('/api/contact', async (req, res) => {
  try {
    const { name, email, message, phone, service } = req.body;

    if (!name || !email || !message) {
      return res.status(400).json({ error: 'Name, email, and message are required' });
    }

    const mailOptions = {
      from: process.env.SMTP_FROM_EMAIL,
      to: process.env.CONTACT_TO_EMAIL,
      subject: `New Contact Form Submission - ${service || 'General Inquiry'}`,
      html: `
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Phone:</strong> ${phone || 'Not provided'}</p>
        <p><strong>Service Interest:</strong> ${service || 'General Inquiry'}</p>
        <p><strong>Message:</strong></p>
        <p>${message.replace(/\n/g, '<br>')}</p>
        <hr>
        <p><small>Sent from AugustAI contact form at ${new Date().toLocaleString()}</small></p>
      `
    };

    await transporter.sendMail(mailOptions);

    // Send auto-reply
    const autoReplyOptions = {
      from: process.env.SMTP_FROM_EMAIL,
      to: email,
      subject: 'Thank you for contacting AugustAI',
      html: `
        <h2>Thank you for reaching out!</h2>
        <p>Hi ${name},</p>
        <p>Thanks for your interest in AugustAI. We've received your message and will get back to you within 24 hours.</p>
        <p>In the meantime, feel free to:</p>
        <ul>
          <li><a href="${process.env.CALENDLY_URL}">Book a 20-min call</a> for immediate assistance</li>
          <li>WhatsApp us at <a href="https://wa.me/${process.env.WHATSAPP_NUMBER}">+${process.env.WHATSAPP_NUMBER}</a></li>
          <li>Call us directly at +${process.env.PHONE_NUMBER}</li>
        </ul>
        <p>Best regards,<br>The AugustAI Team</p>
      `
    };

    await transporter.sendMail(autoReplyOptions);

    res.json({ success: true, message: 'Message sent successfully' });
  } catch (error) {
    console.error('Email error:', error);
    res.status(500).json({ error: 'Failed to send message. Please try again.' });
  }
});

// Demo request endpoint
app.post('/api/demo', async (req, res) => {
  try {
    const { name, email, company, service } = req.body;

    if (!name || !email) {
      return res.status(400).json({ error: 'Name and email are required' });
    }

    const mailOptions = {
      from: process.env.SMTP_FROM_EMAIL,
      to: process.env.CONTACT_TO_EMAIL,
      subject: `Demo Request - ${service || 'General'}`,
      html: `
        <h2>New Demo Request</h2>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Company:</strong> ${company || 'Not provided'}</p>
        <p><strong>Service Interest:</strong> ${service || 'General'}</p>
        <hr>
        <p><small>Demo requested at ${new Date().toLocaleString()}</small></p>
      `
    };

    await transporter.sendMail(mailOptions);

    res.json({ success: true, message: 'Demo request sent successfully' });
  } catch (error) {
    console.error('Demo request error:', error);
    res.status(500).json({ error: 'Failed to send demo request. Please try again.' });
  }
});

app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});