<?php
/**
 * Services Data and Helpers
 */

$services = [
    [
        'day' => 0,
        'name' => 'Sunday Worship Service',
        'shortName' => 'Sunday Service',
        'time' => '11:00 AM',
        'hour' => 11,
        'minute' => 0,
        'type' => 'in-person',
        'address' => '4727 Concord Pike, Wilmington, DE 19803',
        'icon' => '⛪',
        'primary' => true,
    ],
    [
        'day' => 2,
        'name' => 'Night Prayer',
        'shortName' => 'Tuesday Prayer',
        'time' => '8:00 PM',
        'hour' => 20,
        'minute' => 0,
        'type' => 'conference-call',
        'dialIn' => '(605) 472-5528',
        'passcode' => '247705',
        'icon' => '📞',
    ],
    [
        'day' => 4,
        'name' => 'Bible Study',
        'shortName' => 'Bible Study',
        'time' => '7:00 PM',
        'hour' => 19,
        'minute' => 0,
        'type' => 'zoom',
        'zoomId' => '881 6448 5478',
        'zoomPasscode' => '695271',
        'icon' => '📖',
    ],
    [
        'day' => 5,
        'name' => 'Intercessory Prayer',
        'shortName' => 'Friday Prayer',
        'time' => '7:00 PM',
        'hour' => 19,
        'minute' => 0,
        'type' => 'conference-call',
        'dialIn' => '(605) 472-5528',
        'passcode' => '247705',
        'icon' => '🙏',
    ],
];

function getAllServices() {
    global $services;
    return $services;
}
