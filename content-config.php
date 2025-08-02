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
        'automation' => [
            'id' => 'automation',
            'name' => 'Automation Sprint',
            'tagline' => 'Map → build → deploy one workflow that saves hours weekly.',
            'price_from' => 1200,
            'price_currency' => 'USD',
            'delivery_days' => 14,
            'warranty_days' => 14,
            'badge' => 'Intro pricing',
            'icon' => 'fas fa-cog',
            'gradient' => 'from-blue-400 to-cyan-400',
            'features' => [
                'Binary acceptance criteria',
                'Code + logs/monitoring', 
                'Handover & training video',
                '14-day warranty'
            ],
            'category' => 'Business Process Automation',
            'schema_type' => 'AI Automation',
            'status' => 'active',
            'last_updated' => '2025-01-01'
        ],
        'dashboard' => [
            'id' => 'dashboard',
            'name' => 'Dashboard in 10 Days',
            'tagline' => 'Clean, decision-ready analytics + data pipeline.',
            'price_from' => 900,
            'price_currency' => 'USD',
            'delivery_days' => 10,
            'warranty_days' => 14,
            'badge' => 'Most Popular',
            'icon' => 'fas fa-chart-bar',
            'gradient' => 'from-purple-400 to-pink-400',
            'border_highlight' => true,
            'features' => [
                '1–3 interactive dashboards',
                'Comprehensive metric dictionary',
                'Multiple source connectors',
                'Real-time data updates'
            ],
            'category' => 'Data Analytics',
            'schema_type' => 'Business Intelligence Dashboard',
            'status' => 'active',
            'last_updated' => '2025-01-01'
        ],
        'mvp' => [
            'id' => 'mvp',
            'name' => 'MVP-in-a-Month',
            'tagline' => 'A working web app or AI assistant that users can try.',
            'price_from' => 3000,
            'price_currency' => 'USD',
            'delivery_days' => 30,
            'warranty_days' => 14,
            'badge' => 'Full solution',
            'icon' => 'fas fa-rocket',
            'gradient' => 'from-green-400 to-blue-400',
            'features' => [
                '≤4 core user flows',
                'Authentication + basic CI/CD',
                '14-day warranty included',
                'Production deployment'
            ],
            'category' => 'Software Development',
            'schema_type' => 'MVP Development',
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
