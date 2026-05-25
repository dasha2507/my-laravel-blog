<?php
$numbers = [];

for ($i = 0; $i < 15; $i++) {
    $numbers[] = rand(1, 100);
}
echo "Початковий масив: " . implode(", ", $numbers) . "\n";

$oddNumbers = array_filter($numbers, function($num) {
    return $num % 2 !== 0;
});

echo "Масив без парних чисел: " . implode(", ", $oddNumbers) . "\n";
?>

