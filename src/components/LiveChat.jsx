import React, { useState } from 'react'
import { MessageCircle, X, Send } from 'lucide-react'
import { Button } from '@/components/ui/button'

const LiveChat = () => {
  const [isOpen, setIsOpen] = useState(false)
  const [message, setMessage] = useState('')

  const handleSendMessage = () => {
    if (message.trim()) {
      // Redirect to WhatsApp with the message
      const whatsappUrl = `https://wa.me/971554483607?text=${encodeURIComponent(message)}`
      window.open(whatsappUrl, '_blank')
      setMessage('')
      setIsOpen(false)
    }
  }

  const handleKeyPress = (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault()
      handleSendMessage()
    }
  }

  return (
    <>
      {/* Chat Widget */}
      <div className="fixed bottom-6 right-6 z-50">
        {isOpen && (
          <div className="mb-4 w-80 bg-white rounded-lg shadow-2xl border border-gray-200 overflow-hidden">
            {/* Header */}
            <div className="brand-gradient-bg text-white p-4 flex items-center justify-between">
              <div className="flex items-center space-x-3">
                <div className="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                  <MessageCircle className="h-4 w-4" />
                </div>
                <div>
                  <h3 className="font-semibold text-sm">AugustAI Support</h3>
                  <p className="text-xs opacity-90">We're here to help!</p>
                </div>
              </div>
              <button
                onClick={() => setIsOpen(false)}
                className="text-white/80 hover:text-white transition-colors"
              >
                <X className="h-5 w-5" />
              </button>
            </div>

            {/* Chat Body */}
            <div className="p-4 space-y-4">
              <div className="bg-gray-100 rounded-lg p-3">
                <p className="text-sm text-gray-700">
                  👋 Hi there! How can we help you automate your workflows today?
                </p>
              </div>
              
              <div className="space-y-2">
                <textarea
                  value={message}
                  onChange={(e) => setMessage(e.target.value)}
                  onKeyPress={handleKeyPress}
                  placeholder="Type your message here..."
                  className="w-full p-3 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-[var(--august-copper-accent)] focus:border-transparent"
                  rows="3"
                />
                <Button
                  onClick={handleSendMessage}
                  disabled={!message.trim()}
                  className="w-full brand-gradient-bg text-white hover:opacity-90 flex items-center justify-center space-x-2"
                >
                  <Send className="h-4 w-4" />
                  <span>Send via WhatsApp</span>
                </Button>
              </div>

              <div className="text-xs text-gray-500 text-center">
                This will open WhatsApp to continue the conversation
              </div>
            </div>
          </div>
        )}

        {/* Chat Button */}
        <button
          onClick={() => setIsOpen(!isOpen)}
          className="w-14 h-14 brand-gradient-bg text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group"
        >
          {isOpen ? (
            <X className="h-6 w-6 transition-transform group-hover:scale-110" />
          ) : (
            <MessageCircle className="h-6 w-6 transition-transform group-hover:scale-110" />
          )}
        </button>
      </div>
    </>
  )
}

export default LiveChat

