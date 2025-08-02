<?php
/**
 * Content Management Strategy & Pricing Configuration
 * Prepares for headless CMS integration and centralized pricing
 */

// =============================================================================
// PRICING CONFIGURATION - Single Source of Truth
// =============================================================================

/**
 * Service Pricing Configuration
 * This is the master pricing data consumed by:
 * - Frontend display (index.php)
 * - Proposal generators
 * - API endpoints
 * - Admin interfaces
 */
return [
    'services' => [
        'llm' => [
            'id' => 'llm',
            'name' => 'LLM & Private Chatbots',
            'tagline' => 'We turn your docs, FAQs, and workflows into a secure AI assistant. Choose on-prem for full privacy or our hosted plan for speed.',
            'price_from' => 1500,
            'price_currency' => 'USD',
            'delivery_days' => 14,
            'warranty_days' => 14,
            'badge' => 'Intro price',
            'intro_pricing' => true,
            'intro_note' => 'Intro price',
            'icon' => 'fas fa-comments',
            'gradient' => 'from-blue-400 to-cyan-400',
            'features' => [
                'Fine-tuned on your data, no hallucinations',
                'Works inside Slack, Teams, or your website',
                'Weekly usage & accuracy report',
                '14-day hand-holding after go-live'
            ],
            'cta_text' => 'See a live demo →',
            'category' => 'AI Chatbots',
            'schema_type' => 'LLM & Private Chatbots',
            'status' => 'active',
            'last_updated' => '2025-01-01'
        ],
        'automation' => [
            'id' => 'automation',
            'name' => 'Agentic Automations',
            'tagline' => 'One painful workflow. Two-week sprint. A python/AI agent that logs in, fetches, decides, and updates—while you sip coffee.',
            'price_from' => 1200,
            'price_to' => 2500,
            'price_currency' => 'USD',
            'delivery_days' => 14,
            'warranty_days' => 14,
            'badge' => 'Intro sprint',
            'intro_pricing' => true,
            'intro_note' => 'Intro sprint',
            'icon' => 'fas fa-robot',
            'gradient' => 'from-purple-400 to-pink-400',
            'features' => [
                'Map → Build → Deploy in 14 days',
                'Binary acceptance criteria, no grey zones',
                'Full logs & retry alerts—no silent fails',
                'Fixed fee, 50% upfront'
            ],
            'cta_text' => 'Book a scoping call',
            'category' => 'Business Process Automation',
            'schema_type' => 'Agentic Automation',
            'status' => 'active',
            'last_updated' => '2025-01-01'
        ],
        'dashboards' => [
            'id' => 'dashboards',
            'name' => 'Dashboards in 10 Days',
            'tagline' => 'Stop hunting spreadsheets. Your top-5 KPIs live in one clean dashboard—ready in ten days.',
            'price_from' => 900,
            'price_currency' => 'USD',
            'delivery_days' => 10,
            'warranty_days' => 14,
            'badge' => 'Fast delivery',
            'icon' => 'fas fa-chart-bar',
            'gradient' => 'from-green-400 to-emerald-400',
            'features' => [
                'Connects to Excel, Google Sheets, SQL, APIs',
                'Metric dictionary so everyone speaks the same numbers',
                'Stakeholder walkthrough video',
                'Optional cost-cut analysis add-on'
            ],
            'cta_text' => 'Show sample dashboard',
            'category' => 'Data Analytics',
            'schema_type' => 'Business Intelligence Dashboard',
            'status' => 'active',
            'last_updated' => '2025-01-01'
        ],
        'mvp' => [
            'id' => 'mvp',
            'name' => 'MVP-in-30',
            'tagline' => 'A working web or AI product in 30 days—good enough for first users or investors.',
            'price_from' => 3000,
            'price_currency' => 'USD',
            'delivery_days' => 30,
            'warranty_days' => 14,
            'badge' => 'Most Popular',
            'border_highlight' => true,
            'icon' => 'fas fa-rocket',
            'gradient' => 'from-orange-400 to-red-400',
            'features' => [
                '≤ 4 core flows, real auth & deploy',
                'Weekly demo; pivot once for free',
                '2-week bug-fix warranty',
                'Clear handover docs'
            ],
            'cta_text' => 'Get the one-pager',
            'category' => 'Software Development',
            'schema_type' => 'MVP Development',
            'status' => 'active',
            'last_updated' => '2025-01-01'
        ],
        'consulting' => [
            'id' => 'consulting',
            'name' => 'AI Workshops & Due-Diligence',
            'tagline' => 'We translate buzzwords into an action plan—or stress-test someone else\'s AI claims for you.',
            'price_from' => 800,
            'price_workshop' => 800,
            'price_dd' => 1200,
            'price_currency' => 'USD',
            'delivery_days' => 2,
            'warranty_days' => 14,
            'badge' => 'Quick turnaround',
            'icon' => 'fas fa-lightbulb',
            'gradient' => 'from-yellow-400 to-orange-400',
            'features' => [
                'Half-day roadmap workshop → 90-day plan',
                'Investor tech due-diligence in 48h',
                'Team upskilling sessions, slides included',
                'Workshop: $800 • DD pack: $1,200'
            ],
            'cta_text' => 'Request agenda',
            'category' => 'Consulting & Training',
            'schema_type' => 'AI Workshops & Due-Diligence',
            'status' => 'active',
            'last_updated' => '2025-01-01'
        ]
    ],

    // =============================================================================
    // CONTENT STRUCTURE - Headless CMS Ready
    // =============================================================================
    
    'content_types' => [
        'blog_posts' => [
            'fields' => [
                'title' => 'string',
                'slug' => 'string',
                'excerpt' => 'text',
                'content' => 'rich_text',
                'featured_image' => 'image',
                'author' => 'reference',
                'category' => 'reference',
                'tags' => 'array',
                'seo_title' => 'string',
                'seo_description' => 'string',
                'published_date' => 'datetime',
                'status' => 'select'
            ],
            'status_options' => ['draft', 'published', 'archived'],
            'route_pattern' => '/blog/{slug}',
            'static_generation' => true
        ],
        'case_studies' => [
            'fields' => [
                'title' => 'string',
                'slug' => 'string',
                'client_name' => 'string',
                'client_industry' => 'string',
                'project_type' => 'select',
                'challenge' => 'rich_text',
                'solution' => 'rich_text',
                'results' => 'rich_text',
                'testimonial' => 'text',
                'featured_image' => 'image',
                'gallery' => 'array',
                'metrics' => 'object',
                'technologies' => 'array',
                'project_duration' => 'string',
                'seo_title' => 'string',
                'seo_description' => 'string',
                'published_date' => 'datetime',
                'featured' => 'boolean',
                'status' => 'select'
            ],
            'project_types' => ['automation', 'dashboard', 'mvp'],
            'route_pattern' => '/case-studies/{slug}',
            'static_generation' => true
        ],
        'team_members' => [
            'fields' => [
                'name' => 'string',
                'role' => 'string',
                'bio' => 'text',
                'avatar' => 'image',
                'linkedin' => 'url',
                'github' => 'url',
                'skills' => 'array',
                'experience_years' => 'number',
                'education' => 'array',
                'certifications' => 'array',
                'display_order' => 'number',
                'status' => 'select'
            ],
            'route_pattern' => '/team/{slug}',
            'static_generation' => false
        ],
        'job_postings' => [
            'fields' => [
                'title' => 'string',
                'slug' => 'string',
                'department' => 'string',
                'location' => 'string',
                'employment_type' => 'select',
                'experience_level' => 'select',
                'salary_range' => 'string',
                'description' => 'rich_text',
                'requirements' => 'array',
                'benefits' => 'array',
                'application_deadline' => 'date',
                'status' => 'select',
                'posted_date' => 'datetime'
            ],
            'employment_types' => ['full-time', 'part-time', 'contract', 'internship'],
            'experience_levels' => ['entry', 'mid', 'senior', 'lead'],
            'route_pattern' => '/careers/{slug}',
            'static_generation' => true
        ]
    ],

    // =============================================================================
    // STATIC GENERATION CONFIGURATION
    // =============================================================================
    
    'static_generation' => [
        'enabled' => true,
        'output_dir' => 'dist',
        'routes' => [
            '/' => 'index.php',
            '/blog' => 'pages/blog.php',
            '/case-studies' => 'pages/case-studies.php',
            '/careers' => 'pages/careers.php',
            '/about' => 'pages/about.php',
            '/contact' => 'pages/contact.php'
        ],
        'dynamic_routes' => [
            'blog_posts' => '/blog/{slug}',
            'case_studies' => '/case-studies/{slug}',
            'job_postings' => '/careers/{slug}'
        ],
        'cdn_settings' => [
            'cloudflare' => [
                'cache_ttl' => 86400, // 24 hours
                'purge_on_update' => true
            ]
        ]
    ],

    // =============================================================================
    // HEADLESS CMS MIGRATION ROADMAP
    // =============================================================================
    
    'cms_migration' => [
        'phase_1' => [
            'description' => 'Extract pricing to config (current)',
            'timeline' => 'Week 1',
            'tasks' => [
                'Create pricing configuration file',
                'Update frontend to consume config',
                'Create pricing API endpoint',
                'Test pricing consistency across all touchpoints'
            ]
        ],
        'phase_2' => [
            'description' => 'Content structure preparation',
            'timeline' => 'Week 2-3',
            'tasks' => [
                'Design content type schemas',
                'Create template system for dynamic content',
                'Set up routing for future content pages',
                'Implement SEO meta generation'
            ]
        ],
        'phase_3' => [
            'description' => 'Headless CMS integration',
            'timeline' => 'Week 4-6',
            'recommended_cms' => 'Sanity.io',
            'alternative_cms' => 'Strapi',
            'tasks' => [
                'Set up Sanity studio',
                'Configure content schemas',
                'Implement API integration',
                'Create content migration scripts'
            ]
        ],
        'phase_4' => [
            'description' => 'Static generation setup',
            'timeline' => 'Week 7-8', 
            'tasks' => [
                'Implement static site generation',
                'Set up build pipeline',
                'Configure CDN caching',
                'Performance optimization'
            ]
        ]
    ],

    // =============================================================================
    // RECOMMENDED CMS COMPARISON
    // =============================================================================
    
    'cms_options' => [
        'sanity' => [
            'name' => 'Sanity.io',
            'type' => 'Headless CMS',
            'pros' => [
                'Real-time collaboration',
                'Flexible schema design',
                'Great developer experience',
                'Built-in CDN',
                'Live preview capabilities'
            ],
            'cons' => [
                'Learning curve for content creators',
                'Pricing scales with usage'
            ],
            'estimated_setup_time' => '2-3 weeks',
            'monthly_cost_estimate' => '$99-299',
            'recommended_for' => 'augustAI - Best fit for technical team'
        ],
        'strapi' => [
            'name' => 'Strapi',
            'type' => 'Open Source Headless CMS',
            'pros' => [
                'Self-hosted option',
                'No vendor lock-in',
                'Customizable admin panel',
                'Strong plugin ecosystem'
            ],
            'cons' => [
                'Requires more setup/maintenance',
                'Hosting costs'
            ],
            'estimated_setup_time' => '3-4 weeks',
            'monthly_cost_estimate' => '$50-150 (hosting)',
            'recommended_for' => 'Cost-conscious with dev resources'
        ],
        'contentful' => [
            'name' => 'Contentful',
            'type' => 'Headless CMS',
            'pros' => [
                'Mature platform',
                'Good performance',
                'Rich ecosystem'
            ],
            'cons' => [
                'More expensive',
                'Less flexible than Sanity'
            ],
            'estimated_setup_time' => '2-3 weeks',
            'monthly_cost_estimate' => '$489+',
            'recommended_for' => 'Large enterprises'
        ]
    ],

    // =============================================================================
    // PERFORMANCE TARGETS
    // =============================================================================
    
    'performance_targets' => [
        'current_monolith' => [
            'lighthouse_score' => 90,
            'first_contentful_paint' => '1.2s',
            'largest_contentful_paint' => '2.1s',
            'file_size' => '~500KB'
        ],
        'with_cms_static' => [
            'lighthouse_score' => 95,
            'first_contentful_paint' => '0.8s',
            'largest_contentful_paint' => '1.5s',
            'file_size' => '~200KB per page'
        ],
        'scalability_limits' => [
            'current_approach' => '~50 pages max',
            'static_generation' => 'Unlimited pages',
            'cdn_cache_hit_ratio' => '>95%'
        ]
    ]
];
?>
