<?php
function blockContent($htmlContent, $selectedOptions, $customPattern) {
    // Add selected options to the blocked patterns
    $blockedPatterns = array();

    if (in_array('google_ads', $selectedOptions)) {
        $blockedPatterns[] = 'googleads'; // Replace with the actual pattern used by Google Ads
    }
    if (in_array('google_analytics', $selectedOptions)) {
        $blockedPatterns[] = 'google-analytics'; // Replace with the actual pattern used by Google Analytics
    }
    if (in_array('soundcloud', $selectedOptions)) {
        $blockedPatterns[] = 'soundcloud'; // Replace with the actual pattern used by SoundCloud
    }
    if (in_array('youtube_embed', $selectedOptions)) {
        $blockedPatterns[] = 'youtube.com\/embed'; // Replace with the actual pattern used by YouTube Embed
    }

    // Add custom pattern to the blocked patterns
    if (!empty($customPattern)) {
        $blockedPatterns[] = $customPattern;
    }

    // Block the scripts or iframes based on the blocked patterns
    foreach ($blockedPatterns as $pattern) {
        
        $htmlContent = preg_replace("/<script[^>]*src=[\"'].*$pattern.*[\"'][^>]*>.*<\/script>/i", '', $htmlContent);
        $htmlContent = preg_replace("/<iframe[^>]*src=[\"'].*$pattern.*[\"'][^>]*>.*(<\/iframe>)?/i", '', $htmlContent);
    }

    return $htmlContent;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOptions = isset($_POST['options']) ? $_POST['options'] : array();
    $customPattern = isset($_POST['custom_pattern']) ? $_POST['custom_pattern'] : '';

    $htmlContent = file_get_contents('sample.html'); // Update with the actual path
    $modifiedContent = blockContent($htmlContent, $selectedOptions, $customPattern);
    echo $modifiedContent;
    exit();
   
}
?>
