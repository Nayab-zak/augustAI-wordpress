
import React, { useMemo, useState } from 'react';
import { useParams } from 'react-router-dom';
import { Helmet } from 'react-helmet';
import { Dialog, DialogTrigger, DialogContent } from '@/components/ui/dialog';

/**
 * Option B — Plan-first stepper
 *
 * - Pricing buttons open a 2–3 step "Plan → Constraints → Contact" wizard.
 * - Enterprise shortcut: "Talk to an Architect" opens Calendly popup directly (skips steps).              <h4 className="text-base font-semibold text-foreground">Step 3 — Choose how to connect</h4>
              <p className="text-sm text-muted-foreground">Pick the channel that works best. We'll include your plan and context automatically.</p>* - Hero "Start Free" opens the wizard preselecting Starter.
 * - All contact actions open in popups so users don't lose context.
 * - WhatsApp + Calendly + Email (info@august.com.pk) supported.
 *
 * Replace WHATSAPP_NUMBER a                    title="Choose WhatsApp, Calendly popup, or Email next — you won't lose this page."d CALENDLY_URL_* with your real values.
 */

const WHATSAPP_NUMBER = '923000691169'; // E.164 without '+' (example)
const CALENDLY_URL = 'https://calendly.com/admin-august/30min'; // Use the same URL as HomePage

/* ---------- Utility: channel openers ---------- */
const openWhatsApp = (payload) => {
  const msg = encodeURIComponent(
`Hi August,

I'm interested in ${payload.service} — ${payload.plan}.
Country: ${payload.country || '-'}
Team size: ${payload.teamSize || '-'}
Primary tools: ${payload.tools?.length ? payload.tools.join(', ') : '-'}

Can we schedule a quick call?`
  );
  const url = `https://wa.me/${WHATSAPP_NUMBER}?text=${msg}`;
  window.open(url, '_blank', 'noopener,noreferrer');
};

const openEmail = (payload) => {
  const subject = encodeURIComponent(`Discovery — ${payload.service} (${payload.plan})`);
  const body = encodeURIComponent(
`Hi August,

I’m interested in ${payload.service} — ${payload.plan}.

Country: ${payload.country || '-'}
Team size: ${payload.teamSize || '-'}
Primary tools: ${payload.tools?.length ? payload.tools.join(', ') : '-'}

Please share next steps.

Thanks!`
  );
  window.open(`mailto:info@august.com.pk?subject=${subject}&body=${body}`, '_blank');
};

/* ---------- Content ---------- */
const serviceData = {
  'intelligent-chatbots': {
    title: 'Intelligent Chatbots',
    oneLiner: '24/7 customer and employee answers backed by your documents and policies.',
    priceFrom: '$1,200',
    outcomes: [
      'Lower routine ticket volume and response times',
      'Always-on support without adding headcount',
      'Consistent, policy‑aligned answers across channels',
      'Higher satisfaction for common queries',
      'Human agents focus on complex issues'
    ],
    deliverables: [
      'Chatbot grounded on your docs (SOPs, FAQs, policies)',
      'Multi-channel deployment (website, Slack/Teams, optional WhatsApp)',
      'Citation-backed answers with human‑escalation for low confidence',
      'Conversation analytics and topic insights',
      'Integration with your CRM/helpdesk'
    ],
    integrations: [
      'Slack', 'Microsoft Teams', 'WhatsApp', 'Telegram', 'Website Widget',
      'Salesforce', 'HubSpot', 'Zendesk', 'Intercom', 'Custom APIs'
    ],
    timeline: [
      { phase: 'Discovery & Setup', duration: '1 week', description: 'Requirements, data connections, and success criteria' },
      { phase: 'Build & Tuning', duration: '2–3 weeks', description: 'Bot configuration, retrieval guardrails, and flows' },
      { phase: 'Testing & Launch', duration: '1 week', description: 'UAT, handover, and go‑live' },
      { phase: 'Optimization', duration: 'Ongoing', description: 'Monitoring and continuous improvements' }
    ],
    pricing: [
      { tier: 'Starter', price: '$1,200', features: ['Single channel', 'Grounding on up to 500 docs', 'Basic analytics', '30 days support'] },
      { tier: 'Professional', price: '$3,500', features: ['Multi‑channel (web + Slack/Teams)', 'Citations + escalation', 'Advanced analytics', 'Custom branding', 'Multi‑language', '90 days support'] },
      { tier: 'Enterprise', price: 'Contact Us', features: ['Custom solution', 'On‑prem/VPC option', 'SSO & RBAC', 'Dedicated success manager', 'SLA options'] }
    ],
    faq: [
      { question: 'Will the chatbot hallucinate?', answer: 'We use retrieval‑first answers with citations and route unclear questions to humans. Thresholds are tuned during UAT.' },
      { question: 'Can it work with our tools?', answer: 'Yes. We integrate with common CRM/helpdesk systems and can build custom connectors for your stack.' },
      { question: 'What languages can you support?', answer: 'Major languages are supported; we configure evaluation against the languages you care about.' },
      { question: 'How is data handled?', answer: 'We follow least‑privilege access and can deploy in your VPC/on‑premises. We align to SOC 2 controls where applicable.' }
    ],
    seo: { title: 'Intelligent AI Chatbots | August', description: 'Deploy document‑grounded AI chatbots for 24/7 support. Multilingual, secure, and integrated with your tools.' }
  },

  'workflow-automation': {
    title: 'Workflow Automation',
    oneLiner: 'Let bots push the buttons so people don’t have to.',
    priceFrom: '$1,200',
    outcomes: [
      'Reduce repetitive manual work',
      'Fewer errors with consistent execution',
      'Faster cycle times and clear audit trails',
      'Teams focus on higher‑value tasks',
      'Scale operations without proportional hiring'
    ],
    deliverables: [
      'Process mapping and optimization recommendations',
      'Trigger‑based automations across your tools',
      'Human‑in‑the-loop approvals where needed',
      'Monitoring, retries, and alerts',
      'Documentation and handover'
    ],
    integrations: [
      'Salesforce', 'HubSpot', 'SAP', 'NetSuite', 'Jira',
      'ServiceNow', 'Google Workspace', 'Microsoft 365', 'Zapier', 'REST APIs'
    ],
    timeline: [
      { phase: 'Process Analysis', duration: '1–2 weeks', description: 'Map current state and identify automation opportunities' },
      { phase: 'Build & Test', duration: '3–4 weeks', description: 'Implement automations with error handling' },
      { phase: 'Integration & UAT', duration: '1–2 weeks', description: 'Connect systems and validate with users' },
      { phase: 'Go‑Live & Training', duration: '1 week', description: 'Rollout and capability handover' }
    ],
    pricing: [
      { tier: 'Starter', price: '$1,200', features: ['1–3 automations', 'Basic integrations', 'Email support', '3 months maintenance'] },
      { tier: 'Professional', price: '$3,500', features: ['5–10 automations', 'Advanced integrations', 'Priority support', 'Custom reporting', '6 months maintenance'] },
      { tier: 'Enterprise', price: 'Contact Us', features: ['Unlimited automations', 'Dedicated PM', 'On‑prem deployment', 'Custom integrations', '12 months maintenance'] }
    ],
    faq: [
      { question: 'What can be automated?', answer: 'Data entry, report generation, approvals, CRM/ERP updates, inventory checks, and other repeatable tasks.' },
      { question: 'How do you ensure reliability?', answer: 'Retries, alerts, and versioned connectors. We test thoroughly before launch.' },
      { question: 'Can we maintain it later?', answer: 'Yes. We provide docs and training so your team can make safe changes.' }
    ],
    seo: { title: 'AI Workflow Automation | August', description: 'Automate business processes with AI and integrations. Reduce errors and accelerate operations.' }
  },

  'real-time-dashboards': {
    title: 'Real‑Time Dashboards',
    oneLiner: 'Turn raw logs into live KPIs—no per‑seat BI licenses required.',
    priceFrom: '$3,500',
    outcomes: [
      'Decisions based on a single source of truth',
      'Faster insight from live data and alerts',
      'Save on BI licensing and maintenance',
      'Better alignment across teams with shared KPIs'
    ],
    deliverables: [
      'Metrics model and clean data layer',
      'Real‑time dashboards (ops, finance, support)',
      'Email/Slack alerts on thresholds',
      'Export/API for downstream tools'
    ],
    integrations: [
      'PostgreSQL', 'MySQL', 'MongoDB', 'Snowflake', 'Redshift',
      'BigQuery', 'AWS CloudWatch', 'Google Sheets', 'Stripe', 'REST APIs'
    ],
    timeline: [
      { phase: 'Data Audit & KPI Definition', duration: '1 week', description: 'Source review and KPI workshop' },
      { phase: 'Pipelines & Models', duration: '2–3 weeks', description: 'Build data flow and semantic layer' },
      { phase: 'Dashboards & Alerts', duration: '1 week', description: 'Visuals, alerts, and UAT' },
      { phase: 'Handover', duration: 'Ongoing', description: 'Documentation and training' }
    ],
    pricing: [
      { tier: 'Starter', price: '$3,500', features: ['Up to 5 data sources', 'Core KPI dashboards', '30 days support', 'Monthly health check'] },
      { tier: 'Professional', price: '$8,500', features: ['Up to 20 sources', 'Advanced analytics', 'Custom visuals', 'Real‑time alerts', '90 days support'] },
      { tier: 'Enterprise', price: 'Contact Us', features: ['Unlimited sources', 'White‑labeling', 'Dedicated support', 'Custom connectors', 'SLA options'] }
    ],
    faq: [
      { question: 'How “real‑time” is it?', answer: 'Seconds to minutes depending on the sources and SLAs we define together.' },
      { question: 'Can you connect to our databases?', answer: 'Yes. We support major databases and can build custom connectors.' },
      { question: 'Is it mobile‑friendly?', answer: 'Yes, all dashboards are responsive and touch‑friendly.' }
    ],
    seo: { title: 'Real‑Time Data Dashboards | August', description: 'Live dashboards for instant business insight. Integrate, visualize, and act on your data—without per‑seat fees.' }
  },

  'agentic-ai-assistants': {
    title: 'Agentic AI Assistants',
    oneLiner: 'Multi‑step AI that plans, acts, and reports—so routine tasks finish themselves.',
    priceFrom: '$4,500',
    outcomes: [
      'Hands‑off execution for defined tasks',
      'Traceable actions and clear summaries',
      'Less context switching for teams',
      'Scalable digital workforce'
    ],
    deliverables: [
      'Custom agents with pluggable tools (read/write/call APIs)',
      'Guardrails, approvals, and budgets',
      'Execution logs and weekly summaries',
      'Evaluation suite for safe rollout'
    ],
    integrations: ['Email & Calendars', 'CRMs', 'Ticketing systems', 'Internal APIs', 'Docs & Wikis'],
    timeline: [
      { phase: 'Task Inventory & Risk Matrix', duration: '1 week', description: 'Identify candidate tasks and controls' },
      { phase: 'Build Tools & Guardrails', duration: '2–4 weeks', description: 'Implement capabilities and safety' },
      { phase: 'Pilot & Rollout', duration: '1–2 weeks', description: 'Phased enablement and monitoring' }
    ],
    pricing: [
      { tier: 'Starter', price: '$4,500', features: ['1 assistant', 'Up to 5 tools', 'Approval gates', '60 days support'] },
      { tier: 'Professional', price: '$12,000', features: ['Up to 5 assistants', 'Advanced orchestration', 'Real‑time monitoring', 'Custom integrations', '6 months support'] },
      { tier: 'Enterprise', price: 'Contact Us', features: ['Fleet of assistants', 'RBAC & budgets', 'On‑prem/VPC', 'SLAs'] }
    ],
    faq: [{ question: 'Is it safe?', answer: 'Yes—we enforce scopes, rate limits, and human approval for sensitive actions.' }],
    seo: { title: 'Agentic AI Assistants | August', description: 'Plan, act, and report with safe, multi‑step AI assistants tailored to your workflows.' }
  },

  'private-ai-on-prem': {
    title: 'Private AI (On‑Prem / VPC)',
    oneLiner: 'Keep data on your infrastructure while leveraging modern AI.',
    priceFrom: '$15,000',
    outcomes: [
      'Data sovereignty and compliance alignment',
      'Predictable cost for high‑volume usage',
      'Low‑latency, private inference',
      'Customizable models tuned to your domain'
    ],
    deliverables: [
      'Private LLM/RAG stack (on‑prem or VPC)',
      'Secure vector search and policy guardrails',
      'Observability and evaluation harness',
      'Playbooks for updates and patching'
    ],
    integrations: ['Kubernetes', 'Docker', 'S3‑compatible storage', 'AD/Okta SSO', 'SIEM'],
    timeline: [
      { phase: 'Readiness & Architecture', duration: '1 week', description: 'Infra review and deployment plan' },
      { phase: 'Deploy Core Stack', duration: '2–3 weeks', description: 'Models, storage, and connectors' },
      { phase: 'Hardening & Docs', duration: '1 week', description: 'Security controls and runbooks' }
    ],
    pricing: [
      { tier: 'Starter', price: '$15,000', features: ['Single‑tenant deploy', 'Standard security setup', '3 months support'] },
      { tier: 'Professional', price: '$35,000', features: ['Custom fine‑tuning', 'Monitoring & alerting', '6 months support', 'Compliance documentation'] },
      { tier: 'Enterprise', price: 'Contact Us', features: ['Multi‑region', 'Air‑gapped option', 'Dedicated support team', 'SLAs'] }
    ],
    faq: [
      { question: 'Do you support air‑gapped environments?', answer: 'Yes. We can deploy without internet connectivity and provide offline update processes.' },
      { question: 'Which compliance standards can you align to?', answer: 'We support controls for frameworks such as ISO 27001, SOC 2, HIPAA, and PCI DSS—implemented within your environment.' }
    ],
    seo: { title: 'Private On‑Prem AI Solutions | August', description: 'Run advanced AI on your own servers or VPC with security and control.' }
  },

  'mvp-rapid-prototyping': {
    title: 'MVP Rapid Prototyping',
    oneLiner: 'Ideas to a clickable demo in ~14 days—fixed scope and budget.',
    priceFrom: '$4,999',
    outcomes: [
      'Validate concepts quickly with users',
      'De‑risk early investment',
      'Clear next‑step roadmap for build‑out',
      'Investor‑friendly demo assets'
    ],
    deliverables: [
      'Clickable prototype (web or mobile)',
      'Core user flows and value props',
      'User test script and feedback loop',
      'Launch plan and technical roadmap'
    ],
    integrations: ['Figma/Framer prototypes', 'Optional thin backend'],
    timeline: [
      { phase: 'Scope & Wireframes', duration: '3 days', description: 'Requirements and UX flows' },
      { phase: 'Build & Iterate', duration: '7 days', description: 'Prototype and feedback cycles' },
      { phase: 'Polish & Walkthrough', duration: '4 days', description: 'Refinements and handoff' }
    ],
    pricing: [
      { tier: 'Starter', price: '$4,999', features: ['Clickable prototype', 'Basic integrations', '30‑day bug fixes'] },
      { tier: 'Pro', price: '$8,999', features: ['Web + mobile prototype', 'Advanced integrations', 'User testing session', '60‑day support', 'Technical roadmap'] },
      { tier: 'Enterprise', price: 'Contact Us', features: ['Multiple prototype versions', 'Dedicated PM', 'Investor deck', 'Custom integrations', '90‑day support'] }
    ],
    faq: [
      { question: 'Is 14 days guaranteed?', answer: '14 days is the typical timeline for an agreed scope. We confirm scope and schedule during discovery.' },
      { question: 'Can you continue to a full product?', answer: 'Yes. We provide a roadmap and can extend into production development.' }
    ],
    seo: { title: 'MVP Rapid Prototyping | August', description: 'Clickable demos in about two weeks. Fixed scope and budget for fast validation.' }
  },

  'cloud-native-solutions': {
    title: 'Cloud‑Native Solutions',
    oneLiner: 'Scale confidently on AWS, Azure, or GCP without surprises.',
    priceFrom: '$8,500',
    outcomes: [
      'Predictable cost and performance',
      'Autoscaling for traffic spikes',
      'High‑availability architectures',
      'Lower infra overhead for teams'
    ],
    deliverables: [
      'Infrastructure as Code (Terraform) and CI/CD pipelines',
      'Autoscaling services and observability',
      'Cost dashboards and guardrails',
      'Runbooks and incident playbooks'
    ],
    integrations: [
      'AWS/Azure/GCP managed services', 'GitHub/GitLab CI', 'Terraform', 'Prometheus/Grafana', 'DataDog/New Relic'
    ],
    timeline: [
      { phase: 'Architecture Review', duration: '1–2 weeks', description: 'Assess and design target state' },
      { phase: 'IaC & Pipelines', duration: '2–3 weeks', description: 'Codify infra and delivery' },
      { phase: 'Observability & Cost Controls', duration: '1 week', description: 'Monitoring, alerting, and budgets' },
      { phase: 'Launch & Training', duration: '1 week', description: 'Cutover and team enablement' }
    ],
    pricing: [
      { tier: 'Starter', price: '$8,500', features: ['Single cloud deployment', 'Autoscaling setup', '90 days support', 'Monthly cost report'] },
      { tier: 'Professional', price: '$18,000', features: ['Multi‑cloud or multi‑region', 'Advanced monitoring', '24/7 incident playbooks', 'Ongoing cost optimization', '6 months support'] },
      { tier: 'Enterprise', price: 'Contact Us', features: ['Global architecture', 'Dedicated cloud architect', 'Compliance assist', 'White‑glove migration', 'SLAs'] }
    ],
    faq: [
      { question: 'Which clouds do you support?', answer: 'AWS, Microsoft Azure, and Google Cloud. Multi‑cloud strategies are available.' },
      { question: 'How do you manage costs?', answer: 'Right‑sizing, autoscaling, and reserved or spot capacity where appropriate—plus monthly reviews.' }
    ],
    seo: { title: 'Cloud‑Native Solutions | August', description: 'Portable, secure, and cost‑aware cloud architectures across AWS, Azure, and GCP.' }
  }
};

/* ---------- Wizard (Stepper) ---------- */
const Stepper = ({
  open,
  onClose,
  serviceTitle,
  initialPlan = 'Starter',
  onChannel // optional callback for analytics
}) => {
  const [step, setStep] = useState(1);
  const [plan, setPlan] = useState(initialPlan);
  const [country, setCountry] = useState('');
  const [teamSize, setTeamSize] = useState('1-10');
  const [tools, setTools] = useState([]);

  const payload = useMemo(() => ({
    service: serviceTitle,
    plan, country, teamSize, tools
  }), [serviceTitle, plan, country, teamSize, tools]);

  const toggleTool = (t) => {
    setTools(prev => prev.includes(t) ? prev.filter(x => x !== t) : [...prev, t]);
  };

  const next = () => setStep(s => Math.min(3, s + 1));
  const back = () => setStep(s => Math.max(1, s - 1));

  if (!open) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
      <div className="w-full max-w-2xl rounded-2xl card-dark shadow-2xl border border-[var(--august-green)] border-opacity-30">
        {/* Header */}
        <div className="flex items-center justify-between px-6 py-4 border-b">
          <div>
            <p className="text-xs uppercase tracking-widest text-muted-foreground">Discovery</p>
            <h3 className="text-lg font-bold text-foreground">{serviceTitle}</h3>
          </div>
          <button onClick={onClose} aria-label="Close" className="text-muted-foreground hover:text-foreground">✕</button>
        </div>

        {/* Steps */}
        <div className="px-6 py-5">
          {/* Step indicators */}
          <div className="flex items-center gap-3 mb-6">
            {[1,2,3].map(n => (
              <div key={n} className={`h-2 rounded-full ${n <= step ? 'bg-[var(--august-green)]' : 'border border-[var(--august-blue)] border-opacity-30'}`} style={{flex: 1}} />
            ))}
          </div>

          {step === 1 && (
            <div className="space-y-6">
              <h4 className="text-base font-semibold text-foreground">Step 1 — Confirm your plan</h4>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                {['Starter', 'Professional', 'Enterprise'].map(p => (
                  <button
                    key={p}
                    onClick={() => setPlan(p)}
                    className={`rounded-xl border p-4 text-left hover:shadow transition-all duration-200 ${plan === p ? 'border-[var(--august-green)] ring-2 ring-[var(--august-green)] ring-opacity-30' : 'border-[var(--august-blue)] border-opacity-30'} card-darker`}
                  >
                    <div className="flex items-center justify-between">
                      <span className="font-semibold">{p}</span>
                      {plan === p && <span className="text-xs brand-gradient-bg text-white rounded-full px-2 py-0.5">Selected</span>}
                    </div>
                    <p className="text-sm text-muted-foreground mt-1">
                      {p === 'Starter' && 'Evaluate fit quickly with a scoped discovery.'}
                      {p === 'Professional' && 'Implementation for a defined scope and timeline.'}
                      {p === 'Enterprise' && 'Architecture discussion for complex needs.'}
                    </p>
                  </button>
                ))}
              </div>

              {plan !== 'Enterprise' && (
                <div className="card-darker border border-[var(--august-blue)] border-opacity-30 rounded-xl p-4">
                  <h5 className="font-semibold text-foreground mb-2">Step 2 — Add a bit of context</h5>
                  <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                      <label className="text-sm text-muted-foreground">Country</label>
                      <input value={country} onChange={e => setCountry(e.target.value)} placeholder="US / UK / CA / UAE / ..." className="mt-1 w-full rounded-lg border border-[var(--august-blue)] border-opacity-30 focus:border-[var(--august-green)] bg-background text-foreground px-3 py-2" />
                    </div>
                    <div>
                      <label className="text-sm text-muted-foreground">Team size</label>
                      <select value={teamSize} onChange={e => setTeamSize(e.target.value)} className="mt-1 w-full rounded-lg border border-[var(--august-blue)] border-opacity-30 focus:border-[var(--august-green)] bg-background text-foreground px-3 py-2">
                        <option>1-10</option><option>11-50</option><option>51-200</option><option>200+</option>
                      </select>
                    </div>
                    <div>
                      <label className="text-sm text-muted-foreground">Primary tools</label>
                      <div className="mt-1 flex flex-wrap gap-2">
                        {['Salesforce','HubSpot','Slack','MS Teams','Zendesk','Intercom','G Suite','O365'].map(t => (
                          <button key={t} type="button" onClick={() => toggleTool(t)} className={`px-3 py-1.5 text-sm rounded-full border transition-colors duration-200 ${tools.includes(t) ? 'border-[var(--august-green)] bg-[var(--august-green)] bg-opacity-20 text-[var(--august-green)]' : 'border-[var(--august-blue)] border-opacity-30 hover:border-[var(--august-green)] hover:border-opacity-50'}`}>{t}</button>
                        ))}
                      </div>
                    </div>
                  </div>
                </div>
              )}

              <div className="flex items-center justify-end gap-3">
                <button onClick={onClose} className="px-4 py-2 rounded-lg border border-[var(--august-blue)] border-opacity-30 hover:border-opacity-50 text-muted-foreground hover:text-foreground transition-colors duration-200">Cancel</button>
                {plan === 'Enterprise' ? (
                  <button
                    onClick={() => {
                      onChannel && onChannel('calendly', { plan });
                      openCalendlyPopup(plan, { service: serviceTitle, plan });
                      onClose();
                    }}
                    className="px-4 py-2 rounded-lg brand-gradient-bg text-white hover:opacity-90 transition-opacity duration-200"
                  >
                    Talk to an Architect
                  </button>
                ) : (
                  <button onClick={() => setStep(2)} className="px-4 py-2 rounded-lg brand-gradient-bg text-white hover:opacity-90 transition-opacity duration-200">Continue</button>
                )}
              </div>
            </div>
          )}

          {step === 2 && (
            <div className="space-y-6">
              <h4 className="text-base font-semibold text-slate-900">Step 3 — Choose how to connect</h4>
              <p className="text-sm text-slate-600">Pick the channel that works best. We’ll include your plan and context automatically.</p>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button
                  onClick={() => { onChannel && onChannel('calendly', payload); openCalendlyPopup(plan, payload); }}
                  className="rounded-xl border p-4 text-left hover:shadow border-slate-200"
                >
                  <div className="font-semibold">Book on Calendly</div>
                  <p className="text-sm text-slate-600 mt-1">30–45 min. We come prepared with a draft plan.</p>
                </button>
                <button
                  onClick={() => { onChannel && onChannel('whatsapp', payload); openWhatsApp(payload); }}
                  className="rounded-xl border p-4 text-left hover:shadow border-slate-200"
                >
                  <div className="font-semibold">Chat on WhatsApp</div>
                  <p className="text-sm text-slate-600 mt-1">Instant conversation with context pre-filled.</p>
                </button>
                <button
                  onClick={() => { onChannel && onChannel('email', payload); openEmail(payload); }}
                  className="rounded-xl border p-4 text-left hover:shadow border-slate-200"
                >
                  <div className="font-semibold">Email Us</div>
                  <p className="text-sm text-slate-600 mt-1">Sends a summary to info@august.com.pk.</p>
                </button>
              </div>
              <div className="flex items-center justify-between">
                <button onClick={() => setStep(1)} className="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200">Back</button>
                <button onClick={onClose} className="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200">Close</button>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

/* ---------- Page ---------- */
const ServiceDetail = () => {
  const { slug } = useParams();
  const [wizardOpen, setWizardOpen] = useState(false);
  const [wizardPlan, setWizardPlan] = useState('Starter');
  const [calendlyOpen, setCalendlyOpen] = useState(false);
  const service = serviceData[slug];

  // Function to open Calendly popup instead of new tab
  const openCalendlyPopup = (plan, payload = {}) => {
    setCalendlyOpen(true);
  };

  // super-simple analytics stub
  const track = (event, payload) => {
    try { window?.posthog?.capture?.(event, payload); } catch {}
    console.log('[analytics]', event, payload);
  };

  if (!service) {
    return (
      <div className="pt-20 max-w-2xl mx-auto py-20 text-center bg-background min-h-screen">
        <h1 className="text-3xl font-bold mb-4 text-foreground">Service Not Found</h1>
        <p className="text-lg text-muted-foreground">Sorry, the service you are looking for does not exist.</p>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-background">
      {/* SEO */}
      <Helmet>
        <title>{service.seo.title}</title>
        <meta name="description" content={service.seo.description} />
        <meta name="robots" content="index, follow" />
        <meta property="og:title" content={service.seo.title} />
        <meta property="og:description" content={service.seo.description} />
        <meta property="og:type" content="website" />
        <meta property="og:locale" content="en_US" />
      </Helmet>

      {/* Hero */}
      <section className="pt-24 pb-16 px-4 sm:px-6 lg:px-8 surface-gradient-light">
        <div className="max-w-4xl mx-auto text-center">
          <h1 className="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
            {service.title}
          </h1>
          <p className="text-xl md:text-2xl text-muted-foreground mb-8 leading-relaxed">
            {service.oneLiner}
          </p>
          <div className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-8">
            <span className="text-lg text-muted-foreground">Starting from</span>
            <span className="text-3xl md:text-4xl font-bold text-[var(--august-green)]">{service.priceFrom}</span>
          </div>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <button
              onClick={() => { setWizardPlan('Starter'); setWizardOpen(true); track('cta_open', { location: 'hero', plan: 'Starter', service: service.title }); }}
              className="bg-white text-slate-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:bg-slate-100 transition-all duration-200 transform hover:scale-105"
            >
              Start Discovery (Free)
            </button>
            <button
              onClick={() => document.getElementById('pricing-section')?.scrollIntoView({ behavior: 'smooth' })}
              className="brand-gradient-bg text-white font-semibold px-8 py-4 rounded-lg shadow-lg hover:opacity-90 transition-all duration-200 transform hover:scale-105"
            >
              See Plans
            </button>
          </div>
        </div>
      </section>

      {/* Outcomes */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 surface-primary">
        <div className="max-w-6xl mx-auto">
          <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-12 text-center">
            Business Outcomes You Can Expect
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {service.outcomes.map((outcome, index) => (
              <div key={index} className="card-dark p-6 rounded-xl shadow-lg border border-[var(--august-green)] border-opacity-20 hover:shadow-xl hover:border-opacity-40 transition-all duration-200">
                <div className="flex items-start gap-4">
                  <div className="w-8 h-8 bg-gradient-to-r from-[var(--august-green)] to-[var(--august-blue)] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                    <svg className="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <p className="text-foreground font-medium">{outcome}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* What You Get */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 surface-secondary">
        <div className="max-w-6xl mx-auto">
          <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-12 text-center">
            What You Get
          </h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {service.deliverables.map((deliverable, index) => (
            <div key={index} className="flex items-start gap-4 card-dark p-6 rounded-lg shadow-sm border border-[var(--august-blue)] border-opacity-20 hover:shadow-md transition-all duration-200">
              <div className="w-6 h-6 bg-gradient-to-r from-[var(--august-blue)] to-[var(--august-green)] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                <div className="w-2 h-2 bg-white rounded-full"></div>
              </div>
              <p className="text-foreground font-medium">{deliverable}</p>
            </div>
          ))}
        </div>
        </div>
      </section>

      {/* Integrations */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 surface-primary">
        <div className="max-w-6xl mx-auto">
          <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-12 text-center">
            Seamless Integrations
          </h2>
          <div className="grid grid-cols-2 md:grid-cols-5 gap-4">
            {service.integrations.map((integration, index) => (
              <div key={index} className="card-dark p-4 rounded-lg shadow-sm border border-[var(--august-green)] border-opacity-20 text-center hover:shadow-md hover:border-opacity-40 transition-all duration-200">
                <p className="text-foreground font-medium text-sm">{integration}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Timeline */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 bg-slate-50">
        <div className="max-w-6xl mx-auto">
          <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-12 text-center">
            Implementation Timeline
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {service.timeline.map((phase, index) => (
              <div key={index} className="relative bg-white p-6 rounded-xl shadow-lg">
                <div className="absolute -top-3 -left-3 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                  {index + 1}
                </div>
                <h3 className="text-lg font-bold text-slate-900 mb-2">{phase.phase}</h3>
                <p className="text-blue-600 font-semibold text-sm mb-3">{phase.duration}</p>
                <p className="text-slate-600 text-sm">{phase.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Pricing with plan-first actions */}
      <section id="pricing-section" className="py-16 px-4 sm:px-6 lg:px-8 surface-secondary">
        <div className="max-w-6xl mx-auto">
          <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-12 text-center">
            Plans & Pricing
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {service.pricing.map((tier) => {
              const isPro = tier.tier === 'Professional';
              const isEnt = tier.tier === 'Enterprise';
              const ctaLabel = tier.tier === 'Starter' ? 'Start Discovery (Free)'
                              : isPro ? 'Continue with Pro'
                              : 'Talk to an Architect';
              const onClick = () => {
                track('cta_open', { location: 'pricing', plan: tier.tier, service: service.title });
                if (isEnt) {
                  openCalendlyPopup('Enterprise', { service: service.title, plan: 'Enterprise' });
                } else {
                  setWizardPlan(tier.tier);
                  setWizardOpen(true);
                }
              };
              return (
                <div
                  key={tier.tier}
                  className={`flex flex-col rounded-2xl shadow-xl border ${isPro ? 'border-2 border-[var(--august-green)] scale-105 z-10 card-dark' : 'border-[var(--august-blue)] border-opacity-30 card-dark'} p-8 relative transition-transform duration-300 hover:scale-105`}
                >
                  {isPro && (
                    <span className="absolute -top-4 left-1/2 -translate-x-1/2 brand-gradient-bg text-white text-xs font-bold px-4 py-1 rounded-full shadow-lg uppercase tracking-widest">Most Popular</span>
                  )}
                  <h3 className="text-2xl font-bold mb-2 text-center text-foreground">{tier.tier}</h3>
                  <div className="text-center mb-6">
                    <span className="text-4xl font-extrabold text-[var(--august-green)]">{tier.price}</span>
                  </div>
                  <ul className="flex-1 mb-6 space-y-3 text-muted-foreground text-sm">
                    {tier.features.map((f, i) => (
                      <li key={i} className="flex items-center gap-2">
                        <svg className="w-5 h-5 text-[var(--august-green)] flex-shrink-0" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <span>{f}</span>
                      </li>
                    ))}
                  </ul>
                  <button
                    onClick={onClick}
                    className={`mt-auto font-semibold rounded-lg px-6 py-3 transition-all duration-200 shadow ${isPro ? 'brand-gradient-bg text-white hover:opacity-90' : 'border border-[var(--august-green)] border-opacity-50 text-[var(--august-green)] hover:bg-[var(--august-green)] hover:text-white'}`}
                    title="Choose WhatsApp, Calendly, or Email next — you won’t lose this page."
                  >
                    {ctaLabel}
                  </button>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* FAQ */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 surface-primary">
        <div className="max-w-4xl mx-auto">
          <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-12 text-center">
            Frequently Asked Questions
          </h2>
          <div className="space-y-6">
            {service.faq.map((item, index) => (
              <div key={index} className="card-dark p-6 rounded-xl shadow-sm border border-[var(--august-blue)] border-opacity-20">
                <h3 className="text-lg font-semibold text-foreground mb-3">{item.question}</h3>
                <p className="text-muted-foreground leading-relaxed">{item.answer}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Final CTA */}
      <section className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div className="max-w-4xl mx-auto text-center">
          <h2 className="text-3xl md:text-4xl font-bold mb-6">
            Ready to Transform Your Business?
          </h2>
          <p className="text-xl mb-8 text-blue-100">
            Start with a Free Discovery Pack — we’ll return a brief in 48–72 hours.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <button
              onClick={() => { setWizardPlan('Starter'); setWizardOpen(true); track('cta_open', { location: 'footer', plan: 'Starter', service: service.title }); }}
              className="bg-white text-blue-600 font-semibold px-8 py-4 rounded-lg shadow-lg hover:bg-blue-50 transition-all duration-200 transform hover:scale-105"
            >
              Start Discovery (Free)
            </button>
            <button
              onClick={() => openCalendly('Professional', { service: service.title, plan: 'Professional' })}
              className="bg-blue-800 text-white font-semibold px-8 py-4 rounded-lg shadow-lg hover:bg-blue-900 transition-all duration-200 transform hover:scale-105 border border-blue-400"
            >
              Book on Calendly
            </button>
          </div>
        </div>
      </section>

      {/* Wizard overlay */}
      <Stepper
        open={wizardOpen}
        onClose={() => setWizardOpen(false)}
        serviceTitle={service.title}
        initialPlan={wizardPlan}
        onChannel={(ch, payload) => track('cta_channel_select', { channel: ch, plan: payload.plan, service: payload.service })}
      />

      {/* Calendly Dialog */}
      <Dialog open={calendlyOpen} onOpenChange={setCalendlyOpen}>
        <DialogContent className="max-w-2xl w-full p-0 overflow-hidden bg-background">
          <iframe
            src={CALENDLY_URL}
            title="Schedule a Meeting"
            width="100%"
            height="600"
            style={{ border: 'none', minHeight: 500 }}
            allow="camera; microphone; fullscreen"
          />
        </DialogContent>
      </Dialog>
    </div>
  );
};

export default ServiceDetail;
