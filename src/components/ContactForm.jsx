import React from 'react'
import { useForm, ValidationError } from '@formspree/react'
import { Send, Mail, User, Building, Phone, MessageSquare, CheckCircle, AlertCircle } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'


const ContactForm = ({ className = "" }) => {
  const [state, handleSubmit] = useForm("xblkzvko");

  if (state.succeeded) {
    return (
      <Card className={`shadow-lg border-0 ${className}`}>
        <CardHeader>
          <CardTitle className="text-2xl font-bold text-gray-900 flex items-center space-x-2">
            <CheckCircle className="h-6 w-6 text-green-600" />
            <span>Thank you!</span>
          </CardTitle>
          <p className="text-gray-600">Your message has been sent. We'll get back to you within 24 hours.</p>
        </CardHeader>
      </Card>
    );
  }
  return (
    <Card className={`shadow-lg border-0 ${className}`}>
      <CardHeader>
        <CardTitle className="text-2xl font-bold text-gray-900 flex items-center space-x-2">
          <Mail className="h-6 w-6 copper-accent" />
          <span>Get in Touch</span>
        </CardTitle>
        <p className="text-gray-600">
          Ready to automate your workflows? Let's discuss your project and see how we can help.
        </p>
      </CardHeader>
      <CardContent>
        <form onSubmit={handleSubmit} className="space-y-6">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="space-y-2">
              <Label htmlFor="name" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
                <User className="h-4 w-4" />
                <span>Full Name *</span>
              </Label>
              <Input
                id="name"
                type="text"
                name="name"
                required
                className="w-full"
                placeholder="Your full name"
              />
            </div>
            <div className="space-y-2">
              <Label htmlFor="email" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
                <Mail className="h-4 w-4" />
                <span>Email Address *</span>
              </Label>
              <Input
                id="email"
                type="email"
                name="email"
                required
                className="w-full"
                placeholder="your.email@company.com"
              />
              <ValidationError prefix="Email" field="email" errors={state.errors} />
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="space-y-2">
              <Label htmlFor="company" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
                <Building className="h-4 w-4" />
                <span>Company</span>
              </Label>
              <Input
                id="company"
                type="text"
                name="company"
                className="w-full"
                placeholder="Your company name"
              />
            </div>
            <div className="space-y-2">
              <Label htmlFor="phone" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
                <Phone className="h-4 w-4" />
                <span>Phone Number</span>
              </Label>
              <Input
                id="phone"
                type="tel"
                name="phone"
                className="w-full"
                placeholder="+1 (555) 123-4567"
              />
            </div>
          </div>
          <div className="space-y-2">
            <Label htmlFor="subject" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
              <MessageSquare className="h-4 w-4" />
              <span>Subject</span>
            </Label>
            <Input
              id="subject"
              type="text"
              name="subject"
              className="w-full"
              placeholder="What can we help you with?"
            />
          </div>
          <div className="space-y-2">
            <Label htmlFor="message" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
              <MessageSquare className="h-4 w-4" />
              <span>Message *</span>
            </Label>
            <Textarea
              id="message"
              name="message"
              required
              rows={5}
              className="w-full resize-none"
              placeholder="Tell us about your project, automation needs, or any questions you have..."
            />
            <ValidationError prefix="Message" field="message" errors={state.errors} />
          </div>
          <Button
            type="submit"
            disabled={state.submitting}
            className="w-full brand-gradient-bg text-white hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed text-lg py-3 flex items-center justify-center space-x-2"
          >
            {state.submitting ? (
              <>
                <div className="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                <span>Sending...</span>
              </>
            ) : (
              <>
                <Send className="h-5 w-5" />
                <span>Send Message</span>
              </>
            )}
          </Button>
          <p className="text-sm text-gray-500 text-center">
            By submitting this form, you agree to our{' '}
            <a href="/privacy" className="copper-accent hover:underline">
              Privacy Policy
            </a>
            . We'll respond within 24 hours.
          </p>
        </form>
      </CardContent>
    </Card>
  )
}

export default ContactForm

