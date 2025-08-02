<?php
/**
 * Pricing API Endpoint
 * Provides centralized pricing data for all applications
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Cache-Control: public, max-age=3600'); // Cache for 1 hour

// Load pricing configuration
$pricing_config = require_once 'content-config.php';

// Get request parameters
$service_id = isset($_GET['service']) ? $_GET['service'] : null;
$format = isset($_GET['format']) ? $_GET['format'] : 'json';

try {
    if ($service_id) {
        // Return specific service pricing
        if (!isset($pricing_config['services'][$service_id])) {
            http_response_code(404);
            echo json_encode([
                'error' => 'Service not found',
                'available_services' => array_keys($pricing_config['services'])
            ]);
            exit;
        }
        
        $service = $pricing_config['services'][$service_id];
        $result = [
            'service' => $service,
            'last_updated' => $service['last_updated'],
            'api_version' => '1.0'
        ];
    } else {
        // Return all services pricing
        $result = [
            'services' => $pricing_config['services'],
            'meta' => [
                'total_services' => count($pricing_config['services']),
                'last_updated' => max(array_column($pricing_config['services'], 'last_updated')),
                'api_version' => '1.0'
            ]
        ];
    }
    
    // Format response based on request
    switch ($format) {
        case 'proposal':
            // Format for proposal generation
            if ($service_id) {
                $service = $pricing_config['services'][$service_id];
                echo json_encode([
                    'service_name' => $service['name'],
                    'price' => $service['price_from'],
                    'currency' => $service['price_currency'],
                    'delivery_timeline' => $service['delivery_days'] . ' days',
                    'warranty' => $service['warranty_days'] . ' days',
                    'features' => $service['features'],
                    'generated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                echo json_encode(['error' => 'Proposal format requires specific service ID']);
            }
            break;
            
        case 'frontend':
            // Format optimized for frontend display
            if ($service_id) {
                $service = $pricing_config['services'][$service_id];
                echo json_encode([
                    'id' => $service['id'],
                    'name' => $service['name'],
                    'tagline' => $service['tagline'],
                    'price_display' => 'From $' . number_format($service['price_from']),
                    'delivery_text' => $service['delivery_days'] . ' days delivery',
                    'badge' => $service['badge'],
                    'icon' => $service['icon'],
                    'gradient' => $service['gradient'],
                    'features' => $service['features'],
                    'highlight' => isset($service['border_highlight']) ? $service['border_highlight'] : false
                ]);
            } else {
                $formatted_services = [];
                foreach ($pricing_config['services'] as $id => $service) {
                    $formatted_services[] = [
                        'id' => $service['id'],
                        'name' => $service['name'],
                        'tagline' => $service['tagline'],
                        'price_display' => 'From $' . number_format($service['price_from']),
                        'delivery_text' => $service['delivery_days'] . ' days delivery',
                        'badge' => $service['badge'],
                        'icon' => $service['icon'],
                        'gradient' => $service['gradient'],
                        'features' => $service['features'],
                        'highlight' => isset($service['border_highlight']) ? $service['border_highlight'] : false
                    ];
                }
                echo json_encode(['services' => $formatted_services]);
            }
            break;
            
        default:
            // Standard JSON format
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Internal server error',
        'message' => $e->getMessage()
    ]);
}
?>
