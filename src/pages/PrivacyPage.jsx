import React from 'react'
import { Shield, Mail, Phone } from 'lucide-react'
import { Card, CardContent } from '@/components/ui/card'

const PrivacyPage = () => {
  return (
    <div className="pt-16 lg:pt-20">
      {/* Header */}
      <section className="py-20 bg-gradient-to-br from-gray-50 to-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
          <div className="flex justify-center mb-6">
            <div className="p-4 copper-accent-bg text-white rounded-full">
              <Shield className="h-8 w-8" />
            </div>
          </div>
          <h1 className="text-4xl md:text-5xl font-bold text-gray-900">
            Privacy <span className="brand-gradient">Policy</span>
          </h1>
          <p className="text-xl text-gray-600 leading-relaxed">
            Your privacy is important to us. This policy explains how we collect, use, and protect your information.
          </p>
        </div>
      </section>

      {/* Privacy Policy Content */}
      <section className="py-20 bg-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <Card className="shadow-lg border-0">
            <CardContent className="p-8 space-y-8">
              <div className="text-sm text-gray-500 mb-8">
                Last updated: January 2025
              </div>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">1. Information We Collect</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    We collect information you provide directly to us, such as when you:
                  </p>
                  <ul className="list-disc list-inside space-y-2 ml-4">
                    <li>Fill out our contact forms</li>
                    <li>Schedule consultations through our website</li>
                    <li>Communicate with us via email, phone, or WhatsApp</li>
                    <li>Use our ROI calculator</li>
                    <li>Subscribe to our newsletters or updates</li>
                  </ul>
                  <p>
                    This information may include your name, email address, phone number, company information, and any other details you choose to provide.
                  </p>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">2. How We Use Your Information</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>We use the information we collect to:</p>
                  <ul className="list-disc list-inside space-y-2 ml-4">
                    <li>Respond to your inquiries and provide customer support</li>
                    <li>Schedule and conduct consultations</li>
                    <li>Provide information about our services</li>
                    <li>Send you updates about our company and services (with your consent)</li>
                    <li>Improve our website and services</li>
                    <li>Comply with legal obligations</li>
                  </ul>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">3. Information Sharing</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy. We may share your information:
                  </p>
                  <ul className="list-disc list-inside space-y-2 ml-4">
                    <li>With service providers who assist us in operating our website and conducting our business</li>
                    <li>When required by law or to protect our rights</li>
                    <li>In connection with a business transfer or acquisition</li>
                  </ul>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">4. Data Security</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet or electronic storage is 100% secure.
                  </p>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">5. Cookies and Tracking</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    Our website may use cookies and similar tracking technologies to enhance your browsing experience. You can control cookie settings through your browser preferences.
                  </p>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">6. Third-Party Services</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    Our website integrates with third-party services including:
                  </p>
                  <ul className="list-disc list-inside space-y-2 ml-4">
                    <li>Calendly for appointment scheduling</li>
                    <li>WhatsApp for messaging</li>
                    <li>Email service providers for communications</li>
                  </ul>
                  <p>
                    These services have their own privacy policies, and we encourage you to review them.
                  </p>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">7. Your Rights</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    You have the right to:
                  </p>
                  <ul className="list-disc list-inside space-y-2 ml-4">
                    <li>Access the personal information we hold about you</li>
                    <li>Request correction of inaccurate information</li>
                    <li>Request deletion of your personal information</li>
                    <li>Opt out of marketing communications</li>
                    <li>File a complaint with relevant data protection authorities</li>
                  </ul>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">8. International Data Transfers</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    As we serve clients worldwide from our base in Pakistan, your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place for such transfers.
                  </p>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">9. Children's Privacy</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    Our services are not directed to children under 13. We do not knowingly collect personal information from children under 13.
                  </p>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">10. Changes to This Policy</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last updated" date.
                  </p>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">11. Contact Information</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    If you have any questions about this privacy policy or our data practices, please contact us:
                  </p>
                  <div className="bg-gray-50 p-6 rounded-lg space-y-3">
                    <div className="flex items-center space-x-3">
                      <Mail className="h-5 w-5 copper-accent" />
                      <span>Email: info@august.com.pk</span>
                    </div>
                    <div className="flex items-center space-x-3">
                      <Phone className="h-5 w-5 copper-accent" />
                      <span>Phone: +971 58 306 6201</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Shield className="h-5 w-5 copper-accent mt-0.5" />
                      <span>Address: 168 Banigala, Islamabad, Pakistan</span>
                    </div>
                  </div>
                </div>
              </section>

              <section className="space-y-4">
                <h2 className="text-2xl font-bold text-gray-900">12. Governing Law</h2>
                <div className="space-y-3 text-gray-700 leading-relaxed">
                  <p>
                    This privacy policy is governed by the laws of Pakistan. Any disputes arising from this policy will be subject to the jurisdiction of Pakistani courts.
                  </p>
                </div>
              </section>
            </CardContent>
          </Card>
        </div>
      </section>
    </div>
  )
}

export default PrivacyPage

