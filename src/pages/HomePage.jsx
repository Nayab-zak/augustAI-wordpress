import React, { useRef, useEffect } from 'react'
import { Canvas, useFrame } from '@react-three/fiber'
import { OrbitControls, Sphere, MeshDistortMaterial } from '@react-three/drei'
import { Calendar, MessageCircle, Phone, ArrowRight, Bot, BarChart3, Shield, Workflow, Brain, Cloud, Zap } from 'lucide-react'
import { Button } from '@/components/ui/button'
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
        color="#B77147"
        attach="material"
        distort={0.3}
        speed={1.5}
        roughness={0.4}
        metalness={0.8}
      />
    </Sphere>
  )
}

const HomePage = () => {
  const openCalendly = () => {
    window.open('https://calendly.com/admin-august/30min', '_blank')
  }

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
      <section className="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-gray-50 to-white">
        {/* 3D Background */}
        <div className="absolute inset-0 opacity-20">
          <Canvas camera={{ position: [0, 0, 5] }}>
            <ambientLight intensity={0.5} />
            <pointLight position={[10, 10, 10]} />
            <AnimatedSphere />
            <OrbitControls enableZoom={false} enablePan={false} autoRotate autoRotateSpeed={0.5} />
          </Canvas>
        </div>

        <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <div className="space-y-8">
            <h1 className="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight">
              Automate Everything,{' '}
              <span className="brand-gradient">Focus on What Matters</span>
            </h1>
            
            <p className="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
              A results-driven AI studio based in Pakistan, serving clients worldwide.
            </p>

            <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <Button
                onClick={openCalendly}
                size="lg"
                className="brand-gradient-bg text-white hover:opacity-90 text-lg px-8 py-4 flex items-center space-x-2"
              >
                <Calendar className="h-5 w-5" />
                <span>Book a Call</span>
              </Button>
              <Button
                onClick={openWhatsApp}
                variant="outline"
                size="lg"
                className="text-lg px-8 py-4 flex items-center space-x-2 hover:border-[var(--august-copper-accent)] hover:text-[var(--august-copper-accent)]"
              >
                <MessageCircle className="h-5 w-5" />
                <span>Chat on WhatsApp</span>
              </Button>
            </div>
          </div>
        </div>

        {/* Floating Elements */}
        <div className="absolute top-20 left-10 floating">
          <div className="w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full opacity-20"></div>
        </div>
        <div className="absolute bottom-20 right-10 floating" style={{ animationDelay: '2s' }}>
          <div className="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-full opacity-20"></div>
        </div>
      </section>

      {/* Pain Points Strip */}
      <section className="py-16 bg-gray-900 text-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {painPoints.map((point, index) => (
              <div key={index} className="text-center space-y-4">
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

      {/* Services Grid */}
      <section className="py-20 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-4 mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900">
              Our Services
            </h2>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              Comprehensive AI solutions to transform your business operations
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {services.map((service, index) => (
              <Card key={index} className="card-3d group hover:shadow-xl transition-all duration-300 border-0 shadow-lg">
                <CardContent className="p-6 space-y-4">
                  <div className="flex items-center space-x-4">
                    <div className="p-3 copper-accent-bg text-white rounded-lg group-hover:scale-110 transition-transform">
                      <service.icon className="h-6 w-6" />
                    </div>
                    <h3 className="text-xl font-semibold text-gray-900">
                      {service.title}
                    </h3>
                  </div>
                  
                  <p className="text-gray-600 leading-relaxed">
                    {service.description}
                  </p>
                  
                  <ul className="space-y-2">
                    {service.features.map((feature, featureIndex) => (
                      <li key={featureIndex} className="flex items-center space-x-2 text-sm text-gray-500">
                        <ArrowRight className="h-4 w-4 copper-accent" />
                        <span>{feature}</span>
                      </li>
                    ))}
                  </ul>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>
      </section>

      {/* Mini About */}
      <section className="py-20 bg-gray-50">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900">
            About AugustAI
          </h2>
          <div className="space-y-6 text-lg text-gray-600 leading-relaxed">
            <p>
              augustAI was founded in 2025 to give SMEs affordable automation. Small core team, elastic network of specialists. No bureaucracy—just delivery.
            </p>
            <p>
              We believe that every business, regardless of size, should have access to cutting-edge AI solutions that drive real results and measurable ROI.
            </p>
          </div>
        </div>
      </section>

      {/* Contact Section */}
      <section className="py-20 bg-white">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-4 mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900">
              Let's Start Your <span className="brand-gradient">Automation Journey</span>
            </h2>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
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
                className="bg-white text-[var(--august-copper-accent)] border-white hover:bg-gray-100 text-lg px-8 py-4 flex items-center space-x-2"
              >
                <Phone className="h-5 w-5" />
                <span>+971 58 306 6201</span>
              </Button>
              <Button
                onClick={openWhatsApp}
                variant="outline"
                size="lg"
                className="bg-white text-green-600 border-white hover:bg-gray-100 text-lg px-8 py-4 flex items-center space-x-2"
              >
                <MessageCircle className="h-5 w-5" />
                <span>WhatsApp</span>
              </Button>
              <Button
                onClick={openCalendly}
                variant="outline"
                size="lg"
                className="bg-white text-[var(--august-copper-accent)] border-white hover:bg-gray-100 text-lg px-8 py-4 flex items-center space-x-2"
              >
                <Calendar className="h-5 w-5" />
                <span>Calendly</span>
              </Button>
            </div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default HomePage

