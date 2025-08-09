import React, { useState, useEffect } from 'react'
import { Link, useLocation } from 'react-router-dom'
import { Menu, X, Phone, MessageCircle, Calendar } from 'lucide-react'
import { Button } from '@/components/ui/button'
import augustaiLogo from '../assets/augustAI.png'

const Header = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false)
  const [isScrolled, setIsScrolled] = useState(false)
  const location = useLocation()

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const navigation = [
    { name: 'Home', href: '/' },
    { name: 'Services', href: '/services' },
    { name: 'ROI Calculator', href: '/roi' },
    { name: 'Privacy', href: '/privacy' },
  ]

  const openCalendly = () => {
    window.open('https://calendly.com/admin-august/30min', '_blank')
  }

  const openWhatsApp = () => {
    window.open('https://wa.me/971554483607', '_blank')
  }

  const callPhone = () => {
    window.location.href = 'tel:+971583066201'
  }

  return (
    <header className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
      isScrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-transparent'
    }`}>
      <nav className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16 lg:h-20">
          {/* Logo */}
          <Link to="/" className="flex items-center space-x-3 group">
            <div className="relative">
              <img 
                src={augustaiLogo} 
                alt="React Logo" 
                className="h-10 w-auto transition-transform duration-300 group-hover:scale-110"
              />
            </div>
          </Link>

          {/* Desktop Navigation */}
          <div className="hidden lg:flex items-center space-x-8">
            {navigation.map((item) => (
              <Link
                key={item.name}
                to={item.href}
                className={`text-sm font-medium transition-colors duration-200 hover:text-[var(--august-copper-accent)] ${
                  location.pathname === item.href 
                    ? 'text-[var(--august-copper-accent)]' 
                    : 'text-gray-700'
                }`}
              >
                {item.name}
              </Link>
            ))}
          </div>

          {/* Desktop CTA Buttons */}
          <div className="hidden lg:flex items-center space-x-4">
            <Button
              variant="outline"
              size="sm"
              onClick={callPhone}
              className="flex items-center space-x-2 hover:border-[var(--august-copper-accent)] hover:text-[var(--august-copper-accent)]"
            >
              <Phone className="h-4 w-4" />
              <span>Call</span>
            </Button>
            <Button
              variant="outline"
              size="sm"
              onClick={openWhatsApp}
              className="flex items-center space-x-2 hover:border-[var(--august-copper-accent)] hover:text-[var(--august-copper-accent)]"
            >
              <MessageCircle className="h-4 w-4" />
              <span>WhatsApp</span>
            </Button>
            <Button
              onClick={openCalendly}
              className="brand-gradient-bg text-white hover:opacity-90 flex items-center space-x-2"
            >
              <Calendar className="h-4 w-4" />
              <span>Book a Call</span>
            </Button>
          </div>

          {/* Mobile menu button */}
          <div className="lg:hidden">
            <Button
              variant="ghost"
              size="sm"
              onClick={() => setIsMenuOpen(!isMenuOpen)}
              className="p-2"
            >
              {isMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
            </Button>
          </div>
        </div>

        {/* Mobile Navigation */}
        {isMenuOpen && (
          <div className="lg:hidden">
            <div className="px-2 pt-2 pb-3 space-y-1 bg-white/95 backdrop-blur-md rounded-lg mt-2 shadow-lg">
              {navigation.map((item) => (
                <Link
                  key={item.name}
                  to={item.href}
                  className={`block px-3 py-2 text-base font-medium transition-colors duration-200 hover:text-[var(--august-copper-accent)] ${
                    location.pathname === item.href 
                      ? 'text-[var(--august-copper-accent)]' 
                      : 'text-gray-700'
                  }`}
                  onClick={() => setIsMenuOpen(false)}
                >
                  {item.name}
                </Link>
              ))}
              <div className="flex flex-col space-y-2 px-3 py-2">
                <Button
                  variant="outline"
                  size="sm"
                  onClick={() => { callPhone(); setIsMenuOpen(false); }}
                  className="flex items-center justify-center space-x-2"
                >
                  <Phone className="h-4 w-4" />
                  <span>Call</span>
                </Button>
                <Button
                  variant="outline"
                  size="sm"
                  onClick={() => { openWhatsApp(); setIsMenuOpen(false); }}
                  className="flex items-center justify-center space-x-2"
                >
                  <MessageCircle className="h-4 w-4" />
                  <span>WhatsApp</span>
                </Button>
                <Button
                  onClick={() => { openCalendly(); setIsMenuOpen(false); }}
                  className="brand-gradient-bg text-white hover:opacity-90 flex items-center justify-center space-x-2"
                >
                  <Calendar className="h-4 w-4" />
                  <span>Book a Call</span>
                </Button>
              </div>
            </div>
          </div>
        )}
      </nav>
    </header>
  )
}

export default Header

