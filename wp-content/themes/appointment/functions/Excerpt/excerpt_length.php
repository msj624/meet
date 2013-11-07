<?php
// code to change length of portfolio 2 column image caption
function get_portfolio_excerpt(){
  global $post;
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$original_len = strlen($excerpt);

$excerpt = substr($excerpt, 0,75);

$excerpt = substr($excerpt, 0, strripos($excerpt, " "));

$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));

$len=strlen($excerpt);

return $excerpt;
}

// code to change length of portfolio 3 colimn image caption
function get_portfolio_three_excerpt(){
  global $post;
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$original_len = strlen($excerpt);

$excerpt = substr($excerpt, 0,50);

$excerpt = substr($excerpt, 0, strripos($excerpt, " "));

$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));

$len=strlen($excerpt);

return $excerpt;
}

// code to change length of portfolio four column image caption
function get_portfolio_four_excerpt(){
  global $post;
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$original_len = strlen($excerpt);

$excerpt = substr($excerpt, 0,35);

$excerpt = substr($excerpt, 0, strripos($excerpt, " "));

$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));

$len=strlen($excerpt);

return $excerpt;
}
?>