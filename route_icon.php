<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$options = array(
    'w'   => '20',
    'bg'  => 'C7221B',
    'fg'  => 'FFFFFF',
    't'   => 'S',
);

if (isset($argv) === FALSE) {
  $argv = array();
}
foreach ($argv as $k => $option_group) {
    if ($k === 0) {
        continue;
    }

    $option_found = preg_match('#^([a-z]{1,})=(.*)$#', $option_group, $option_matches);
    if ($option_found === FALSE) {
        continue;
    }

    $key = $option_matches[1];
    $override_value = $option_matches[2];
    if ($override_value !== '') {
        $options[$key] = $override_value;
    }
}

$image_w = isset($_GET['w']) ? $_GET['w'] : $options['w'];
$color_bg = isset($_GET['bg']) ? $_GET['bg'] : $options['bg'];
$color_text = isset($_GET['fg']) ? $_GET['fg'] : $options['fg'];
$circle_text = isset($_GET['t']) ? $_GET['t'] : $options['t'];

function hex2color($im, $hex) {
    return imagecolorallocate($im,
        hexdec(substr($hex,0,2)),
        hexdec(substr($hex,2,2)),
        hexdec(substr($hex,4,2))
    );
}

// Create the base image, a transparent rectangle
$image = imagecreatetruecolor($image_w, $image_w);
$maskColor = ImageColorAllocateAlpha($image, 254, 254, 254, 127);
imageSaveAlpha($image, true);
imageFill($image, 0, 0, $maskColor);

// Create the circle image, a solid circle on top a transparent background
$image_circle_w = $image_w * 4;

$image_circle = imagecreatetruecolor($image_circle_w, $image_circle_w);
$maskColor = ImageColorAllocateAlpha($image_circle, 254, 254, 254, 127);
imageSaveAlpha($image_circle, true);
imageFill($image_circle, 0, 0, $maskColor);

imagefilledellipse(
    $image_circle, 
    round($image_circle_w / 2), round($image_circle_w / 2),
    $image_circle_w - 5, $image_circle_w - 5,
    hex2color($image_circle, $color_bg)
);

// Put the text on top of the circle
$font = dirname(__FILE__) . '/Crimson-Bold.otf';
$font_size = $image_w * 2.5;
$bbox = imagettfbbox($font_size, 0, $font, $circle_text);

$f_x = (int) ($image_circle_w - $bbox[2]) / 2;
$f_y = (int) ($image_circle_w - $bbox[5]) / 2;

imagettftext($image_circle, $font_size, 0, $f_x, $f_y, hex2color($image_circle, $color_text), $font, $circle_text);

// Copy the circle on top the base image
imagecopyresampled(
    $image, $image_circle,
    0, 0, 0, 0,
    $image_w, $image_w,
    $image_circle_w, $image_circle_w
);
imagedestroy($image_circle);

if (count($argv)) {
    // Assuming command line run
    imagepng($image, dirname(__FILE__) . '/tmp/route_icon_' . $circle_text . '.png');
} else {
    if (strlen(ob_get_contents()) === 0) {
        header('Content-Type: image/png');
        imagepng($image);
    }
}

imagedestroy($image);