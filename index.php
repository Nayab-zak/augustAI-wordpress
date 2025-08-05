<?php
/*
Template Name: AugustAI Homepage
Description: Custom template for AugustAI static website
*/

// Check if this is a WordPress environment
if (function_exists('get_header')) {
    // WordPress environment - serve as PHP template
    get_header();
    ?>
    <div id="augustai-content">
        <?php include 'index.html'; ?>
    </div>
    <?php
    get_footer();
} else {
    // Non-WordPress environment - serve static HTML
    include 'index.html';
}
?>