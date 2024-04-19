<?php

$word_to_score = [
    'horrible' => 1,
    'bad' => 2,
    'okay' => 3,
    'good' => 4,
    'great' => 5
];

// Sample reviews for testing (reviews from database should go here)
$reviews = [
    'horrible',
    'bad',
    'okay',
    'okay',
    'good',
    'good',
    'good',
    'great'
];

// Calculate the average score
function calculate_average_score($reviews, $word_to_score) {
    $total_score = 0;
    $num_reviews = count($reviews);

    // Calculate total score
    foreach ($reviews as $review) {
        $total_score += $word_to_score[$review];
    }

    $average_score = $total_score / $num_reviews;

    return $average_score;
}

$average_score = calculate_average_score($reviews, $word_to_score);
echo "Average score for the product: " . $average_score;
?>