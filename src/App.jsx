import React from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import './App.css'

// Components
import Header from './components/Header'
import Footer from './components/Footer'
import HomePage from './pages/HomePage'
import ServicesPage from './pages/ServicesPage'
import ROICalculatorPage from './pages/ROICalculatorPage'
import PrivacyPage from './pages/PrivacyPage'
import LiveChat from './components/LiveChat'

function App() {
  return (
    <Router>
      <div className="min-h-screen bg-background text-foreground">
        <Header />
        <main>
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/services" element={<ServicesPage />} />
            <Route path="/roi" element={<ROICalculatorPage />} />
            <Route path="/privacy" element={<PrivacyPage />} />
          </Routes>
        </main>
        <Footer />
        <LiveChat />
      </div>
    </Router>
  )
}

export default App

