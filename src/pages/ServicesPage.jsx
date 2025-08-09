import React, { useState } from 'react'
import { ChevronDown, ChevronUp, Bot, BarChart3, Shield, Workflow, Brain, Cloud, Zap, Check, ArrowRight } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'

const ServicesPage = () => {
  const [expandedService, setExpandedService] = useState(null)

  const openCalendly = () => {
    window.open('https://calendly.com/admin-august/30min', '_blank')
  }

  const services = [
    {
      id: 1,
      icon: Bot,
      title: "Intelligent Chatbots",
      subtitle: "24/7 customer & employee answers backed by your documents",
      description: "Transform your customer service and internal support with AI-powered chatbots that understand your business context and provide accurate, helpful responses around the clock.",
      features: [
        "Document-based knowledge integration",
        "Multi-language support (50+ languages)",
        "Seamless handoff to human agents",
        "Custom training on your data",
        "Integration with existing platforms",
        "Analytics and conversation insights"
      ],
      benefits: [
        "Reduce support ticket volume by 70%",
        "24/7 availability without additional staff",
        "Consistent, accurate responses",
        "Improved customer satisfaction scores"
      ],
      technologies: ["OpenAI GPT", "LangChain", "Vector Databases", "REST APIs"],
      timeline: "2-4 weeks",
      pricing: "Starting from $2,000"
    },
    {
      id: 2,
      icon: BarChart3,
      title: "Real-Time Dashboards",
      subtitle: "Turn raw logs into live KPIs—no BI licence required",
      description: "Create powerful, real-time dashboards that transform your raw data into actionable insights without expensive business intelligence licenses.",
      features: [
        "Real-time data visualization",
        "Custom KPI tracking",
        "Automated alert systems",
        "Mobile-responsive design",
        "Data source integration",
        "Export and sharing capabilities"
      ],
      benefits: [
        "Make data-driven decisions faster",
        "Eliminate manual reporting tasks",
        "Spot trends and anomalies instantly",
        "Save thousands on BI licensing"
      ],
      technologies: ["React", "D3.js", "WebSocket", "Time-series databases"],
      timeline: "3-6 weeks",
      pricing: "Starting from $3,500"
    },
    {
      id: 3,
      icon: Shield,
      title: "Private AI on-prem",
      subtitle: "Keep data on your servers while leveraging cutting-edge models",
      description: "Deploy state-of-the-art AI models on your own infrastructure, ensuring complete data privacy and compliance while maintaining cutting-edge capabilities.",
      features: [
        "On-premises model deployment",
        "Air-gapped environments supported",
        "Custom model fine-tuning",
        "Enterprise-grade security",
        "Compliance-ready architecture",
        "24/7 monitoring and support"
      ],
      benefits: [
        "Complete data sovereignty",
        "Meet strict compliance requirements",
        "Reduced latency and costs",
        "Customizable to your needs"
      ],
      technologies: ["Docker", "Kubernetes", "NVIDIA GPUs", "Custom ML frameworks"],
      timeline: "6-12 weeks",
      pricing: "Starting from $15,000"
    },
    {
      id: 4,
      icon: Workflow,
      title: "Workflow Automation",
      subtitle: "Let bots push the buttons so people don't have to",
      description: "Automate repetitive tasks and complex workflows, freeing your team to focus on high-value activities while ensuring consistency and reducing errors.",
      features: [
        "Process mapping and optimization",
        "Multi-system integration",
        "Error handling and recovery",
        "Audit trails and logging",
        "Scalable automation framework",
        "User-friendly management interface"
      ],
      benefits: [
        "Reduce manual work by 80%",
        "Eliminate human errors",
        "Improve process consistency",
        "Free up staff for strategic work"
      ],
      technologies: ["Python", "RPA tools", "API integrations", "Cloud platforms"],
      timeline: "4-8 weeks",
      pricing: "Starting from $5,000"
    },
    {
      id: 5,
      icon: Brain,
      title: "Agentic AI Assistants",
      subtitle: "Multi-step AI agents that plan, act, and report—so tasks finish themselves",
      description: "Deploy autonomous AI agents that can plan complex tasks, execute multi-step workflows, and provide detailed reports on their activities.",
      features: [
        "Autonomous task planning",
        "Multi-step execution capabilities",
        "Real-time progress tracking",
        "Detailed activity reporting",
        "Integration with existing tools",
        "Customizable decision-making logic"
      ],
      benefits: [
        "Complete task automation",
        "Intelligent problem-solving",
        "Reduced supervision needs",
        "Scalable workforce augmentation"
      ],
      technologies: ["LangChain", "AutoGPT", "Custom agent frameworks", "API orchestration"],
      timeline: "6-10 weeks",
      pricing: "Starting from $8,000"
    },
    {
      id: 6,
      icon: Cloud,
      title: "Cloud-Native Solutions",
      subtitle: "Scale from zero to millions on AWS, Azure, or GCP without surprises",
      description: "Build and deploy scalable, cloud-native applications that grow with your business, optimized for performance and cost-efficiency.",
      features: [
        "Auto-scaling infrastructure",
        "Multi-cloud deployment",
        "Cost optimization strategies",
        "High availability design",
        "Security best practices",
        "Monitoring and alerting"
      ],
      benefits: [
        "Pay only for what you use",
        "Handle traffic spikes automatically",
        "99.9% uptime guarantee",
        "Global deployment capabilities"
      ],
      technologies: ["AWS", "Azure", "GCP", "Kubernetes", "Terraform"],
      timeline: "4-12 weeks",
      pricing: "Starting from $6,000"
    },
    {
      id: 7,
      icon: Zap,
      title: "MVP Rapid Prototyping",
      subtitle: "Ideas → clickable demo in 14 days, fixed budget",
      description: "Transform your ideas into working prototypes quickly and cost-effectively, perfect for validating concepts and securing funding.",
      features: [
        "Rapid development methodology",
        "User experience design",
        "Core functionality implementation",
        "Responsive web/mobile design",
        "User testing and feedback",
        "Deployment and hosting"
      ],
      benefits: [
        "Validate ideas quickly",
        "Secure funding with demos",
        "Reduce development risks",
        "Fast time-to-market"
      ],
      technologies: ["React", "Node.js", "Rapid prototyping tools", "Cloud hosting"],
      timeline: "14 days",
      pricing: "Fixed at $4,999"
    }
  ]

  const toggleService = (serviceId) => {
    setExpandedService(expandedService === serviceId ? null : serviceId)
  }

  return (
    <div className="pt-16 lg:pt-20">
      {/* Header */}
      <section className="py-20 bg-gradient-to-br from-gray-50 to-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
          <h1 className="text-4xl md:text-5xl font-bold text-gray-900">
            Our <span className="brand-gradient">Services</span>
          </h1>
          <p className="text-xl text-gray-600 leading-relaxed">
            Comprehensive AI solutions designed to transform your business operations and drive measurable results
          </p>
        </div>
      </section>

      {/* Services */}
      <section className="py-20 bg-white">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="space-y-6">
            {services.map((service) => (
              <Card key={service.id} className="overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-300">
                <CardContent className="p-0">
                  {/* Service Header */}
                  <div 
                    className="p-6 cursor-pointer hover:bg-gray-50 transition-colors"
                    onClick={() => toggleService(service.id)}
                  >
                    <div className="flex items-center justify-between">
                      <div className="flex items-center space-x-4">
                        <div className="p-3 copper-accent-bg text-white rounded-lg">
                          <service.icon className="h-6 w-6" />
                        </div>
                        <div>
                          <h3 className="text-2xl font-semibold text-gray-900">
                            {service.title}
                          </h3>
                          <p className="text-gray-600 mt-1">
                            {service.subtitle}
                          </p>
                        </div>
                      </div>
                      <div className="flex items-center space-x-4">
                        <div className="text-right">
                          <div className="text-sm text-gray-500">Starting from</div>
                          <div className="text-lg font-semibold copper-accent">
                            {service.pricing}
                          </div>
                        </div>
                        {expandedService === service.id ? (
                          <ChevronUp className="h-6 w-6 text-gray-400" />
                        ) : (
                          <ChevronDown className="h-6 w-6 text-gray-400" />
                        )}
                      </div>
                    </div>
                  </div>

                  {/* Expanded Content */}
                  {expandedService === service.id && (
                    <div className="border-t bg-gray-50">
                      <div className="p-6 space-y-8">
                        <p className="text-gray-700 text-lg leading-relaxed">
                          {service.description}
                        </p>

                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                          {/* Features */}
                          <div>
                            <h4 className="text-lg font-semibold text-gray-900 mb-4">
                              Key Features
                            </h4>
                            <ul className="space-y-2">
                              {service.features.map((feature, index) => (
                                <li key={index} className="flex items-start space-x-2">
                                  <Check className="h-5 w-5 copper-accent mt-0.5 flex-shrink-0" />
                                  <span className="text-gray-600">{feature}</span>
                                </li>
                              ))}
                            </ul>
                          </div>

                          {/* Benefits */}
                          <div>
                            <h4 className="text-lg font-semibold text-gray-900 mb-4">
                              Business Benefits
                            </h4>
                            <ul className="space-y-2">
                              {service.benefits.map((benefit, index) => (
                                <li key={index} className="flex items-start space-x-2">
                                  <ArrowRight className="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0" />
                                  <span className="text-gray-600">{benefit}</span>
                                </li>
                              ))}
                            </ul>
                          </div>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t">
                          <div>
                            <h5 className="font-semibold text-gray-900 mb-2">Technologies</h5>
                            <div className="flex flex-wrap gap-2">
                              {service.technologies.map((tech, index) => (
                                <span key={index} className="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">
                                  {tech}
                                </span>
                              ))}
                            </div>
                          </div>
                          <div>
                            <h5 className="font-semibold text-gray-900 mb-2">Timeline</h5>
                            <p className="text-gray-600">{service.timeline}</p>
                          </div>
                          <div>
                            <h5 className="font-semibold text-gray-900 mb-2">Investment</h5>
                            <p className="text-gray-600">{service.pricing}</p>
                          </div>
                        </div>

                        <div className="pt-6 border-t">
                          <Button
                            onClick={openCalendly}
                            className="brand-gradient-bg text-white hover:opacity-90"
                          >
                            Discuss This Service
                          </Button>
                        </div>
                      </div>
                    </div>
                  )}
                </CardContent>
              </Card>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 brand-gradient-bg text-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
          <h2 className="text-3xl md:text-4xl font-bold">
            Ready to Get Started?
          </h2>
          <p className="text-xl opacity-90">
            Let's discuss which services are right for your business and create a custom solution that delivers results.
          </p>
          <Button
            onClick={openCalendly}
            size="lg"
            className="bg-white text-[var(--august-copper-accent)] hover:bg-gray-100 text-lg px-8 py-4"
          >
            Schedule a Consultation
          </Button>
        </div>
      </section>
    </div>
  )
}

export default ServicesPage

