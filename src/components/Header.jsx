import React, { useState, useEffect, useRef } from 'react'
import { Link, useLocation } from 'react-router-dom'
import { Menu, X, Phone, MessageCircle, Calendar } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { Dialog, DialogTrigger, DialogContent } from '@/components/ui/dialog'
import {
  DropdownMenu,
  DropdownMenuTrigger,
  DropdownMenuContent,
  DropdownMenuItem
} from '@/components/ui/dropdown-menu'
import augustaiLogo from '../assets/augustAI.png'

const Header = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false)
  const [isScrolled, setIsScrolled] = useState(false)
  const [isServicesOpen, setIsServicesOpen] = useState(false)
  const [hoveredCategory, setHoveredCategory] = useState(null)
  const [calendlyOpen, setCalendlyOpen] = useState(false)
  const servicesTimeoutRef = useRef(null)
  const categoryTimeoutRef = useRef(null)
  const location = useLocation()

  const openWhatsApp = () => {
    window.open('https://wa.me/923000691169', '_blank')
  }

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50)
    }
    window.addEventListener('scroll', handleScroll)
    return () => {
      window.removeEventListener('scroll', handleScroll)
      // Clear timeouts on unmount
      if (servicesTimeoutRef.current) clearTimeout(servicesTimeoutRef.current)
      if (categoryTimeoutRef.current) clearTimeout(categoryTimeoutRef.current)
    }
  }, [])

  const handleServicesMouseEnter = () => {
    if (servicesTimeoutRef.current) {
      clearTimeout(servicesTimeoutRef.current)
    }
    setIsServicesOpen(true)
  }

  const handleServicesMouseLeave = () => {
    servicesTimeoutRef.current = setTimeout(() => {
      setIsServicesOpen(false)
      setHoveredCategory(null)
    }, 200)
  }

  const handleCategoryMouseEnter = (category) => {
    if (categoryTimeoutRef.current) {
      clearTimeout(categoryTimeoutRef.current)
    }
    setHoveredCategory(category)
  }

  const handleCategoryMouseLeave = () => {
    categoryTimeoutRef.current = setTimeout(() => {
      setHoveredCategory(null)
    }, 200)
  }



  // Services organized by category for mega menu
  const serviceCategories = [
    {
      category: 'Automation',
      items: [
        { name: 'Workflow Automation', slug: 'workflow-automation', description: 'Automate repetitive tasks and complex workflows' },
        { name: 'Agentic AI Assistants', slug: 'agentic-ai-assistants', description: 'AI agents that plan, act, and report automatically' },
        { name: 'Intelligent Chatbots', slug: 'intelligent-chatbots', description: '24/7 customer and employee support' },
      ],
    },
    {
      category: 'Intelligence',
      items: [
        { name: 'Real‑Time Dashboards', slug: 'real-time-dashboards', description: 'Turn raw data into live KPIs' },
        { name: 'Private AI (On‑Prem / VPC)', slug: 'private-ai-on-prem', description: 'Keep data secure with on-premise AI' },
        { name: 'MVP Rapid Prototyping', slug: 'mvp-rapid-prototyping', description: 'Ideas to demo in 14 days' },
      ],
    },
    {
      category: 'Cloud & Scale',
      items: [
        { name: 'Cloud‑Native Solutions', slug: 'cloud-native-solutions', description: 'Scale from zero to millions without surprises' },
      ],
    },
  ];

  const navigation = [
    { name: 'Home', href: '/' },
    { name: 'Services', href: '/services' }, // We'll override this below
    { name: 'ROI Calculator', href: '/roi' },
    { name: 'Privacy', href: '/privacy' },
  ]

  const callPhone = () => {
    window.location.href = 'tel:+971583066201'
  }

  return (
    <header className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
      isScrolled ? 'bg-card/95 backdrop-blur-md shadow-lg border-b border-border' : 'bg-transparent'
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
            <Link
              to="/"
              className={`text-sm font-medium transition-colors duration-200 hover:text-primary ${location.pathname === '/' ? 'text-primary' : 'text-foreground'}`}
            >
              Home
            </Link>
            {/* Services Dropdown Menu */}
            <div 
              className="relative"
              onMouseEnter={handleServicesMouseEnter}
              onMouseLeave={handleServicesMouseLeave}
            >
              <button
                className={`text-sm font-medium transition-colors duration-200 hover:text-primary ${location.pathname.startsWith('/services') ? 'text-primary' : 'text-foreground'} flex items-center gap-1 py-2 px-1`}
              >
                Services
                <svg className={`w-4 h-4 transition-transform duration-200 ${isServicesOpen ? 'rotate-180' : ''}`} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              
              {/* Categories Menu - No gap, directly connected */}
              {isServicesOpen && (
                <div 
                  className="absolute left-0 top-full w-48 bg-white text-gray-900 rounded-lg shadow-xl border border-slate-200 z-50 py-2"
                  onMouseEnter={handleServicesMouseEnter}
                  onMouseLeave={handleServicesMouseLeave}
                >
                  {serviceCategories.map((cat) => (
                    <div 
                      key={cat.category} 
                      className="relative"
                      onMouseEnter={() => handleCategoryMouseEnter(cat.category)}
                      onMouseLeave={handleCategoryMouseLeave}
                    >
                      <div className="px-4 py-3 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 cursor-pointer flex items-center justify-between transition-colors duration-150">
                        {cat.category}
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                        </svg>
                      </div>
                      
                      {/* Services Submenu - Overlaps slightly to avoid gaps */}
                      {hoveredCategory === cat.category && (
                        <div 
                          className="absolute left-full top-0 -ml-1 w-64 bg-white text-gray-900 rounded-lg shadow-xl border border-slate-200 z-50 py-2"
                          onMouseEnter={() => handleCategoryMouseEnter(cat.category)}
                          onMouseLeave={handleCategoryMouseLeave}
                        >
                          <div className="px-3 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                            {cat.category}
                          </div>
                          {cat.items.map((item) => (
                            <Link
                              key={item.slug}
                              to={`/services/${item.slug}`}
                              className="block px-4 py-3 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-150"
                              onClick={() => {
                                setIsServicesOpen(false)
                                setHoveredCategory(null)
                              }}
                            >
                              <div className="font-medium">{item.name}</div>
                              {item.description && (
                                <div className="text-xs text-slate-500 mt-1">{item.description}</div>
                              )}
                            </Link>
                          ))}
                        </div>
                      )}
                    </div>
                  ))}
                  
                  {/* View All Services Link */}
                  <div className="border-t border-slate-100 mt-1 pt-1">
                    <Link
                      to="/services"
                      className="block px-4 py-3 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-150"
                      onClick={() => setIsServicesOpen(false)}
                    >
                      View All Services →
                    </Link>
                  </div>
                </div>
              )}
            </div>
            <Link
              to="/roi"
              className={`text-sm font-medium transition-colors duration-200 hover:text-primary ${location.pathname === '/roi' ? 'text-primary' : 'text-foreground'}`}
            >
              ROI Calculator
            </Link>
            <Link
              to="/privacy"
              className={`text-sm font-medium transition-colors duration-200 hover:text-primary ${location.pathname === '/privacy' ? 'text-primary' : 'text-foreground'}`}
            >
              Privacy
            </Link>
          </div>

          {/* Desktop CTA Buttons */}
          <div className="hidden lg:flex items-center space-x-4">
            <Button
              variant="outline"
              size="sm"
              onClick={callPhone}
              className="flex items-center space-x-2 hover:border-primary hover:text-primary"
            >
              <Phone className="h-4 w-4" />
              <span>Call</span>
            </Button>
            <Button
              variant="outline"
              size="sm"
              onClick={openWhatsApp}
              className="flex items-center space-x-2 hover:border-primary hover:text-primary"
            >
              <MessageCircle className="h-4 w-4" />
              <span>WhatsApp</span>
            </Button>
            <Dialog open={calendlyOpen} onOpenChange={setCalendlyOpen}>
              <DialogTrigger asChild>
                <Button className="brand-gradient-bg text-white hover:opacity-90 flex items-center space-x-2">
                  <Calendar className="h-4 w-4" />
                  <span>Book a Call</span>
                </Button>
              </DialogTrigger>
              <DialogContent className="max-w-2xl w-full p-0 overflow-hidden bg-background">
                <iframe
                  src="https://calendly.com/admin-august/30min"
                  title="Schedule a Meeting"
                  width="100%"
                  height="600"
                  style={{ border: 'none', minHeight: 500 }}
                  allow="camera; microphone; fullscreen"
                />
              </DialogContent>
            </Dialog>
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
            <div className="px-2 pt-2 pb-3 space-y-1 bg-card/95 backdrop-blur-md rounded-lg mt-2 shadow-lg border border-border">
              <Link
                to="/"
                className={`block px-3 py-2 text-base font-medium transition-colors duration-200 hover:text-[var(--august-copper-accent)] ${location.pathname === '/' ? 'text-[var(--august-copper-accent)]' : 'text-gray-700'}`}
                onClick={() => setIsMenuOpen(false)}
              >
                Home
              </Link>
              {/* Services collapsible */}
              <details>
                <summary className="block px-3 py-2 text-base font-medium cursor-pointer hover:text-[var(--august-copper-accent)]">Services</summary>
                <div className="pl-4">
                  {serviceCategories.map((category) => (
                    <div key={category.category} className="mb-3">
                      <div className="text-sm font-semibold text-slate-600 mb-2 px-3">{category.category}</div>
                      {category.items.map((item) => (
                        <Link
                          key={item.slug}
                          to={`/services/${item.slug}`}
                          className="block px-3 py-1 text-sm font-medium hover:text-primary text-slate-700"
                          onClick={() => setIsMenuOpen(false)}
                        >
                          {item.name}
                        </Link>
                      ))}
                    </div>
                  ))}
                </div>
              </details>
              <Link
                to="/roi"
                className={`block px-3 py-2 text-base font-medium transition-colors duration-200 hover:text-[var(--august-copper-accent)] ${location.pathname === '/roi' ? 'text-[var(--august-copper-accent)]' : 'text-gray-700'}`}
                onClick={() => setIsMenuOpen(false)}
              >
                ROI Calculator
              </Link>
              <Link
                to="/privacy"
                className={`block px-3 py-2 text-base font-medium transition-colors duration-200 hover:text-[var(--august-copper-accent)] ${location.pathname === '/privacy' ? 'text-[var(--august-copper-accent)]' : 'text-gray-700'}`}
                onClick={() => setIsMenuOpen(false)}
              >
                Privacy
              </Link>
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
                <Dialog open={calendlyOpen} onOpenChange={setCalendlyOpen}>
                  <DialogTrigger asChild>
                    <Button 
                      onClick={() => setIsMenuOpen(false)}
                      className="brand-gradient-bg text-white hover:opacity-90 flex items-center justify-center space-x-2"
                    >
                      <Calendar className="h-4 w-4" />
                      <span>Book a Call</span>
                    </Button>
                  </DialogTrigger>
                  <DialogContent className="max-w-2xl w-full p-0 overflow-hidden bg-background">
                    <iframe
                      src="https://calendly.com/admin-august/30min"
                      title="Schedule a Meeting"
                      width="100%"
                      height="600"
                      style={{ border: 'none', minHeight: 500 }}
                      allow="camera; microphone; fullscreen"
                    />
                  </DialogContent>
                </Dialog>
              </div>
            </div>
          </div>
        )}
      </nav>
    </header>
  )
}

export default Header

