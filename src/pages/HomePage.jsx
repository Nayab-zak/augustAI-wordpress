import React, { useRef, useEffect } from 'react'
import { Canvas, useFrame } from '@react-three/fiber'
import { OrbitControls, Sphere, MeshDistortMaterial } from '@react-three/drei'
import { Calendar, MessageCircle, Phone, ArrowRight, Bot, BarChart3, Shield, Workflow, Brain, Cloud, Zap } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { Dialog, DialogTrigger, DialogContent } from '@/components/ui/dialog'
import { Card, CardContent } from '@/components/ui/card'
import ContactForm from '../components/ContactForm'

// 3D Animated Sphere Component
function AnimatedSphere() {
  const meshRef = useRef()
  
  useFrame((state) => {
    if (meshRef.current) {
      meshRef.current.rotation.x = state.clock.elapsedTime * 0.2
      meshRef.current.rotation.y = state.clock.elapsedTime * 0.3
    }
  })

  return (
    <Sphere ref={meshRef} args={[1, 100, 200]} scale={2}>
      <MeshDistortMaterial
        color="#ffffff"
        attach="material"
        distort={0.3}
        speed={1.5}
        roughness={0.4}
        metalness={0.3}
        transparent
        opacity={0.15}
      />
    </Sphere>
  )
}

const HomePage = () => {
  // Calendly dialog state
  const [calendlyOpen, setCalendlyOpen] = React.useState(false)

  const openWhatsApp = () => {
    window.open('https://wa.me/971554483607', '_blank')
  }

  const callPhone = () => {
    window.location.href = 'tel:+971583066201'
  }

  const services = [
    {
      icon: Bot,
      title: "Intelligent Chatbots",
      description: "24/7 customer & employee answers backed by your documents.",
      features: ["Document-based responses", "Multi-language support", "Integration ready"]
    },
    {
      icon: BarChart3,
      title: "Real-Time Dashboards",
      description: "Turn raw logs into live KPIs—no BI licence required.",
      features: ["Live data visualization", "Custom metrics", "No licensing fees"]
    },
    {
      icon: Shield,
      title: "Private AI on-prem",
      description: "Keep data on your servers while leveraging cutting-edge models.",
      features: ["On-premises deployment", "Data sovereignty", "Enterprise security"]
    },
    {
      icon: Workflow,
      title: "Workflow Automation",
      description: "Let bots push the buttons so people don't have to.",
      features: ["Process automation", "Error reduction", "Time savings"]
    },
    {
      icon: Brain,
      title: "Agentic AI Assistants",
      description: "Multi-step AI agents that plan, act, and report—so tasks finish themselves.",
      features: ["Autonomous planning", "Multi-step execution", "Detailed reporting"]
    },
    {
      icon: Cloud,
      title: "Cloud-Native Solutions",
      description: "Scale from zero to millions on AWS, Azure, or GCP without surprises.",
      features: ["Auto-scaling", "Cost optimization", "Multi-cloud support"]
    },
    {
      icon: Zap,
      title: "MVP Rapid Prototyping",
      description: "Ideas → clickable demo in 14 days, fixed budget.",
      features: ["14-day delivery", "Fixed pricing", "Clickable prototypes"]
    }
  ]

  const painPoints = [
    {
      title: "Manual, repetitive workflows?",
      description: "Stop wasting time on tasks that could be automated"
    },
    {
      title: "Siloed data you can't query?",
      description: "Unlock insights from your disconnected systems"
    },
    {
      title: "Legacy apps slowing growth?",
      description: "Modernize without disrupting your operations"
    }
  ]

  return (
    <div className="pt-16 lg:pt-20">
      {/* Hero Section */}
      <section className="relative min-h-screen flex items-center justify-center overflow-hidden surface-gradient-light">
        {/* 3D Background */}
        <div className="absolute inset-0 opacity-80">
          <Canvas camera={{ position: [0, 0, 5] }}>
            <ambientLight intensity={0.6} />
            <pointLight position={[10, 10, 10]} intensity={0.8} />
            <AnimatedSphere />
            <OrbitControls enableZoom={false} enablePan={false} autoRotate autoRotateSpeed={0.5} />
          </Canvas>
        </div>

        <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <div className="space-y-8">
            {/* Startup-focused badge */}
            <div className="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-[var(--august-green)] to-[var(--august-blue)] bg-opacity-10 border border-[var(--august-green)] border-opacity-20">
              <Bot className="w-4 h-4 text-white mr-2" />
              <span className="text-sm font-semibold text-white">Smarter Solutions, Seamlessly — For Forward-Looking Businesses</span>
            </div>
            <h1 className="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight">
              <span className="block mb-2">Smarter Solutions, Seamlessly</span>
              <span className="block text-2xl md:text-3xl font-medium text-muted-foreground mt-2">AI that works as smart as you do.</span>
            </h1>
            <p className="text-xl md:text-2xl text-muted-foreground max-w-4xl mx-auto leading-relaxed">
              Unlock AI workflow automation for your business—without the enterprise price tag. AugustAI delivers practical AI business solutions and copilots for SMEs worldwide. <span className="text-[var(--august-green)] font-semibold">Built by entrepreneurs, for entrepreneurs.</span>
            </p>

            {/* Startup metrics - honest and appealing */}
            <div className="flex flex-wrap justify-center gap-8 py-4">
              <div className="text-center">
                <div className="text-2xl font-bold text-[var(--august-green)]">2025</div>
                <div className="text-sm text-muted-foreground">Founded</div>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-[var(--august-blue)]">60%</div>
                <div className="text-sm text-muted-foreground">Avg Cost Savings</div>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-[var(--august-green)]">3 Weeks</div>
                <div className="text-sm text-muted-foreground">Avg Delivery</div>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-[var(--august-blue)]">100%</div>
                <div className="text-sm text-muted-foreground">Success Rate</div>
              </div>
            </div>

            <div className="flex flex-col sm:flex-row gap-4 justify-center items-center pt-4">
              <Dialog open={calendlyOpen} onOpenChange={setCalendlyOpen}>
                <DialogTrigger asChild>
                  <Button
                    size="lg"
                    className="brand-gradient-bg text-white hover:opacity-90 text-lg px-8 py-4 flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-300 pulse-success"
                  >
                    <Calendar className="h-5 w-5" />
                    <span>Start Your Automation Journey</span>
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
              <Button
                onClick={openWhatsApp}
                variant="outline"
                size="lg"
                className="btn-secondary text-lg px-8 py-4 flex items-center space-x-2 shadow-md hover:shadow-lg transition-all duration-300"
              >
                <MessageCircle className="h-5 w-5" />
                <span>Chat with Founders</span>
              </Button>
            </div>
            
            {/* Startup authenticity */}
            <div className="pt-8">
              <p className="text-sm text-muted-foreground mb-4">🚀 Fresh minds, proven results</p>
              <div className="flex justify-center items-center space-x-6 opacity-40">
                <div className="text-xs text-muted-foreground px-3 py-1 border border-[var(--august-green)] border-opacity-30 rounded-full">
                  Pakistan-Based
                </div>
                <div className="text-xs text-muted-foreground px-3 py-1 border border-[var(--august-blue)] border-opacity-30 rounded-full">
                  Global Reach
                </div>
                <div className="text-xs text-muted-foreground px-3 py-1 border border-[var(--august-green)] border-opacity-30 rounded-full">
                  Startup-Friendly
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Floating Elements - More Visible with Glow */}
        <div className="absolute top-20 left-10 floating">
          <div className="w-28 h-28 bg-gradient-to-r from-[var(--august-green)] via-white to-[var(--august-blue)] rounded-full opacity-80 blur-[3px] border-2 border-white/60 shadow-[0_0_30px_5px_rgba(0,255,196,0.18)]"></div>
        </div>
        <div className="absolute bottom-20 right-10 floating" style={{ animationDelay: '2s' }}>
          <div className="w-24 h-24 bg-gradient-to-r from-[var(--august-blue)] via-white to-[var(--august-green)] rounded-full opacity-75 blur-[3px] border-2 border-white/60 shadow-[0_0_25px_4px_rgba(0,119,255,0.15)]"></div>
        </div>
        <div className="absolute top-1/2 right-20 floating" style={{ animationDelay: '4s' }}>
          <div className="w-20 h-20 bg-gradient-to-r from-[var(--august-green-dark)] via-white to-[var(--august-blue-dark)] rounded-full opacity-80 blur-[3px] border-2 border-white/60 shadow-[0_0_20px_3px_rgba(0,212,170,0.12)]"></div>
        </div>
        
        {/* Professional Grid Pattern Overlay - Subtle */}
        <div className="absolute inset-0 opacity-3">
          <div className="w-full h-full" style={{
            backgroundImage: `radial-gradient(circle at 1px 1px, var(--august-green) 1px, transparent 0)`,
            backgroundSize: '50px 50px'
          }}></div>
        </div>
      </section>

      {/* Business Challenges Section */}
      <section className="py-20 surface-primary">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
              Smarter Solutions, Seamlessly — Remove the Roadblocks
            </h2>
            <p className="text-xl text-muted-foreground max-w-3xl mx-auto">
              Still stuck with manual, repetitive workflows? Struggling to connect data across legacy systems? Want to scale but can’t afford big tech overhead? Need AI copilots for SMEs, but don’t know where to start?
            </p>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {painPoints.map((point, index) => (
              <div key={index} className="text-center space-y-4 p-6 rounded-xl border border-opacity-20 border-[var(--august-green)] hover:border-opacity-40 transition-all duration-300">
                <div className="w-16 h-16 mx-auto rounded-full bg-gradient-to-r from-red-500 to-orange-500 bg-opacity-20 flex items-center justify-center">
                  <span className="text-2xl">⚠️</span>
                </div>
                <h3 className="text-xl font-semibold text-red-400">
                  {point.title}
                </h3>
                <p className="text-gray-300">
                  {point.description}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Why Choose AugustAI */}
      <section className="py-20 surface-gradient-light">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
              Why Businesses Choose AugustAI
            </h2>
            <p className="text-xl text-muted-foreground max-w-3xl mx-auto">
              We’re not just another tech company. We’re entrepreneurs who understand the need for real results, fast.
            </p>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div className="text-center p-6 rounded-xl card-dark hover:shadow-lg transition-all duration-300">
              <div className="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-r from-[var(--august-green)] to-[var(--august-blue)] flex items-center justify-center">
                <Zap className="w-8 h-8 text-white" />
              </div>
              <h3 className="text-xl font-bold text-foreground mb-2">Fast & Agile</h3>
              <p className="text-muted-foreground">No red tape. From idea to deployment in 2–4 weeks.</p>
            </div>
            <div className="text-center p-6 rounded-xl card-dark hover:shadow-lg transition-all duration-300">
              <div className="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-r from-[var(--august-blue)] to-[var(--august-green)] flex items-center justify-center">
                <BarChart3 className="w-8 h-8 text-white" />
              </div>
              <h3 className="text-xl font-bold text-foreground mb-2">Startup-Friendly</h3>
              <p className="text-muted-foreground">Flexible pricing and payment terms for growing businesses.</p>
            </div>
            <div className="text-center p-6 rounded-xl card-dark hover:shadow-lg transition-all duration-300">
              <div className="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-r from-[var(--august-green)] to-[var(--august-blue)] flex items-center justify-center">
                <Brain className="w-8 h-8 text-white" />
              </div>
              <h3 className="text-xl font-bold text-foreground mb-2">Hands-On Support</h3>
              <p className="text-muted-foreground">Direct access to founders. We’re invested in your success.</p>
            </div>
            <div className="text-center p-6 rounded-xl card-dark hover:shadow-lg transition-all duration-300">
              <div className="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-r from-[var(--august-blue)] to-[var(--august-green)] flex items-center justify-center">
                <Workflow className="w-8 h-8 text-white" />
              </div>
              <h3 className="text-xl font-bold text-foreground mb-2">Built to Scale</h3>
              <p className="text-muted-foreground">Solutions that grow with your business, wherever you are.</p>
            </div>
          </div>
          <div className="text-center">
            <blockquote className="text-2xl font-medium text-foreground mb-4">
              "Fresh perspective, solid execution. <span className="text-[var(--august-green)]">AugustAI gets the startup mindset.</span>"
            </blockquote>
            <cite className="text-muted-foreground">— Early customer feedback</cite>
          </div>
        </div>
      </section>

      {/* Contact Section */}
      <section className="py-20 surface-secondary">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-4 mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-foreground">
              Let's Start Your <span className="brand-gradient">Automation Journey</span>
            </h2>
            <p className="text-xl text-muted-foreground max-w-3xl mx-auto">
              Ready to transform your business with AI? Get in touch and let's discuss how we can help automate your workflows.
            </p>
          </div>
          
          <div className="max-w-2xl mx-auto">
            <ContactForm />
          </div>
        </div>
      </section>

      {/* CTA Strip */}
      <section className="py-16 brand-gradient-bg text-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-8">
            <h2 className="text-3xl md:text-4xl font-bold">
              Ready to Automate Your Workflows?
            </h2>
            <p className="text-xl opacity-90 max-w-2xl mx-auto">
              Let's discuss how we can help transform your business with AI automation
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <Button
                onClick={callPhone}
                variant="outline"
                size="lg"
                className="btn-secondary text-lg px-8 py-4 flex items-center space-x-2"
              >
                <Phone className="h-5 w-5" />
                <span>+971 58 306 6201</span>
              </Button>
              <Button
                onClick={openWhatsApp}
                variant="outline"
                size="lg"
                className="btn-secondary text-success text-lg px-8 py-4 flex items-center space-x-2"
              >
                <MessageCircle className="h-5 w-5" />
                <span>WhatsApp</span>
              </Button>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default HomePage

