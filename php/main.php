<?php

function isDataValid($x, $y, $r) {
    if (is_nan($x) || $x < -5 || $x > 3 || strlen($x) > 12) {
        return false;
    }
    if (!($y == -2 || $y == -1.5 || $y == -1 || $y == -0.5 || $y == 0 || $y == 0.5 || $y == 1 || $y == 1.5 || $y == 2)) {
        return false;
    }
    if (!($r == 1 || $r == 2 || $r == 3 || $r == 4 || $r == 5)) {
        return false;
    }
    return true;
}

function check($x, $y, $r) {
    if ($x <= 0 && $y >= 0) {
        return $y < $r && $x >= -1 * $r;
    } elseif ($x >= 0 && $y >= 0) {
        return $x ** 2 + $y ** 2 <= $r ** 2 / 4;
    } elseif ($x >= 0 && $y <= 0) {
        return $y >= 0.5 * $x - $r / 2 && $x <= 1 * $r;
    } else {
        return false;
    }
}

$xValue = $_POST['x'];
$yValue = $_POST['y'];
$rValue = $_POST['r'];
$timezoneOffset = $_POST['timezone'];

$currentTime = date('H:i:s', time() - $timezoneOffset * 60);

echo "<tr>";
if (isDataValid($xValue, $yValue, $rValue)) {
    $result = check($xValue, $yValue, $rValue);
    $text_result = $result ? 'HIT' : 'MISS';

    $executionTime = round((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000, 3);

    echo "<td>" . $xValue . "</td>";
    echo "<td>" . $yValue . "</td>";
    echo "<td>" . $rValue . "</td>";
    echo "<td>" . $text_result . "</td>";
    echo "<td>" . $currentTime . "</td>";
    echo "<td>" . $executionTime . "</td>";
} else {
    echo "<td colspan=\"6\">" . "data is invalid" . "</td>";
}
echo "</tr>";