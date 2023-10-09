<?php
// Sample ad data (replace with your own ad content)
$ads = [
    [
        'adType' => 'image',
        'adSize' => '728x90',
        'adUrl' => 'http://example.com/ad1.jpg',
        'adLink' => 'http://example.com/ad1-click',
    ],
    [
        'adType' => 'image',
        'adSize' => '728x90',
        'adUrl' => 'http://example.com/ad2.jpg',
        'adLink' => 'http://example.com/ad2-click',
    ],
];

// Get a random ad from the list
$randomAd = $ads[array_rand($ads)];

// Build the ad HTML based on the selected ad
$adHtml = '<a href="' . $randomAd['adLink'] . '" target="_blank">';
$adHtml .= '<img src="' . $randomAd['adUrl'] . '" alt="Advertisement" width="728" height="90">';
$adHtml .= '</a>';

// Output the ad HTML
echo $adHtml;
?>

