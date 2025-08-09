import React from 'react'
import { Link } from 'react-router-dom'
import { Mail, Phone, MapPin, MessageCircle, Calendar } from 'lucide-react'
import augustaiLogo from '../assets/augustai-logo.png'

const Footer = () => {
  const openWhatsApp = () => {
    window.open('https://wa.me/971554483607', '_blank')
  }

  const openCalendly = () => {
    window.open('https://calendly.com/admin-august/30min', '_blank')
  }

  const callPhone = () => {
    window.location.href = 'tel:+971583066201'
  }

  const sendEmail = () => {
    window.location.href = 'mailto:info@august.com.pk'
  }

  return (
    <footer className="bg-gray-50 border-t">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Company Info */}
          <div className="space-y-4">
            <div className="flex items-center space-x-3">
              <img 
                src={augustaiLogo} 
                alt="AugustAI Logo" 
                className="h-8 w-auto"
              />
            </div>
            <p className="text-gray-600 text-sm leading-relaxed">
              A results-driven AI studio based in Pakistan, serving clients worldwide. 
              Automate everything, focus on what matters.
            </p>
            <div className="flex space-x-4">
              <button
                onClick={openWhatsApp}
                className="p-2 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors"
                aria-label="WhatsApp"
              >
                <MessageCircle className="h-5 w-5" />
              </button>
              <button
                onClick={callPhone}
                className="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors"
                aria-label="Phone"
              >
                <Phone className="h-5 w-5" />
              </button>
              <button
                onClick={openCalendly}
                className="p-2 rounded-full copper-accent-bg text-white hover:opacity-80 transition-opacity"
                aria-label="Schedule Meeting"
              >
                <Calendar className="h-5 w-5" />
              </button>
            </div>
          </div>

          {/* Quick Links */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-gray-900">Quick Links</h3>
            <ul className="space-y-2">
              <li>
                <Link to="/" className="text-gray-600 hover:text-[var(--august-copper-accent)] transition-colors">
                  Home
                </Link>
              </li>
              <li>
                <Link to="/services" className="text-gray-600 hover:text-[var(--august-copper-accent)] transition-colors">
                  Services
                </Link>
              </li>
              <li>
                <Link to="/roi" className="text-gray-600 hover:text-[var(--august-copper-accent)] transition-colors">
                  ROI Calculator
                </Link>
              </li>
              <li>
                <Link to="/privacy" className="text-gray-600 hover:text-[var(--august-copper-accent)] transition-colors">
                  Privacy Policy
                </Link>
              </li>
            </ul>
          </div>

          {/* Contact Info */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-gray-900">Contact</h3>
            <ul className="space-y-3">
              <li className="flex items-center space-x-3">
                <Mail className="h-5 w-5 text-gray-400" />
                <button
                  onClick={sendEmail}
                  className="text-gray-600 hover:text-[var(--august-copper-accent)] transition-colors"
                >
                  info@august.com.pk
                </button>
              </li>
              <li className="flex items-center space-x-3">
                <Phone className="h-5 w-5 text-gray-400" />
                <button
                  onClick={callPhone}
                  className="text-gray-600 hover:text-[var(--august-copper-accent)] transition-colors"
                >
                  +971 58 306 6201
                </button>
              </li>
              <li className="flex items-start space-x-3">
                <MapPin className="h-5 w-5 text-gray-400 mt-0.5" />
                <span className="text-gray-600">
                  168 Banigala, Islamabad, Pakistan
                </span>
              </li>
            </ul>
          </div>

          {/* CTA Section */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-gray-900">Get Started</h3>
            <p className="text-gray-600 text-sm">
              Ready to automate your workflows? Let's discuss your project.
            </p>
            <div className="space-y-2">
              <button
                onClick={openCalendly}
                className="w-full brand-gradient-bg text-white py-2 px-4 rounded-lg hover:opacity-90 transition-opacity font-medium"
              >
                Book a Call
              </button>
              <button
                onClick={openWhatsApp}
                className="w-full border border-green-500 text-green-600 py-2 px-4 rounded-lg hover:bg-green-50 transition-colors font-medium"
              >
                Chat on WhatsApp
              </button>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="mt-12 pt-8 border-t border-gray-200">
          <div className="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p className="text-gray-500 text-sm">
              © 2025 augustAI • Sole proprietorship registered in Pakistan
            </p>
            <div className="flex space-x-6">
              <Link to="/privacy" className="text-gray-500 hover:text-[var(--august-copper-accent)] text-sm transition-colors">
                Privacy Policy
              </Link>
              <Link to="/roi" className="text-gray-500 hover:text-[var(--august-copper-accent)] text-sm transition-colors">
                ROI Calculator
              </Link>
            </div>
          </div>
        </div>
      </div>
    </footer>
  )
}

export default Footer

