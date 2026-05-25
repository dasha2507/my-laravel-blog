<?php
// завдання 1
echo "Завдання 1:\n";
$numbers = [];

for ($i = 0; $i < 15; $i++) {
    $numbers[] = rand(1, 100);
}

echo "Початковий масив: " . implode(", ", $numbers) . "\n";

$oddNumbers = array_filter($numbers, function($num) {
    return $num % 2 !== 0;
});

echo "Масив без парних чисел: " . implode(", ", $oddNumbers) . "\n";
// завдання 2
echo "Завдання 2:\n";
echo "Введіть числа через кому: ";
$userInput = readline();
$cleanInput = str_replace(' ', '', $userInput);
$array = explode(',', $cleanInput);
$reversedArray = array_reverse($array);
if ($array === $reversedArray) {
    echo "Результат: Масив є паліндромом!\n";
} else {
    echo "Результат: Масив НЕ є паліндромом.\n";
}
// завдання 3
echo "Завдання 3:\n";
echo "Введіть числа через кому: ";
$userInput = readline();

$cleanInput = str_replace(' ', '', $userInput);

$array = explode(',', $cleanInput);

$evenCount = 0;
foreach ($array as $num) {
    if ($num % 2 == 0) {
        $evenCount = $evenCount + 1;
    }
}

echo "Результат: Кількість парних чисел = $evenCount\n";

echo "Кількість парних чисел: $evenCount\n";
// завдання 4
echo "Завдання 4:\n";
$sum = 0;

for ($i = 100; $i <= 200; $i++) {
    if ($i % 4 == 0) {
        $sum += $i;
    }
}

echo "Сума чисел від 100 до 200, кратних 4: $sum\n";
// завдання 5
echo "Завдання 5:\n";
$numbers = [];
for ($i = 0; $i < 10; $i++) {
    $numbers[] = rand(0, 50);
}
echo "Масив: " . implode(", ", $numbers) . "\n";
$uniqueNumbers = array_unique($numbers);

rsort($uniqueNumbers);

if (isset($uniqueNumbers[1])) {
    echo "Друге за величиною число: " . $uniqueNumbers[1] . "\n";
} else {
    echo "У масиві немає другого за величиною числа.\n";
}
// завдання 6
echo "Завдання 6:\n";
$numbers = [];
for ($i = 0; $i < 15; $i++) {
    $numbers[] = rand(1, 100);
}

echo "Масив: " . implode(", ", $numbers) . "\n";

$product = 1;
$hasOdd = false;

foreach ($numbers as $num) {
    if ($num % 2 !== 0) {
        $product *= $num;
        $hasOdd = true;
    }
}

if ($hasOdd) {
    echo "Добуток непарних чисел: $product\n";
} else {
    echo "У масиві немає непарних чисел.\n";
}
// завдання 7
echo "Завдання 7:\n";
echo "Введіть дату у форматі день.місяць.рік (наприклад 18.05.2026): ";
$userInput = readline();

$parts = explode('.', $userInput);

$day = $parts[0];
$monthNumber = (int)$parts[1];
$year = $parts[2];

$months = [
    1 => 'січня', 2 => 'лютого', 3 => 'березня', 4 => 'квітня',
    5 => 'травня', 6 => 'червня', 7 => 'липня', 8 => 'серпня',
    9 => 'вересня', 10 => 'жовтня', 11 => 'листопада', 12 => 'грудня'
];

$monthText = $months[$monthNumber];

echo "Результат: $day $monthText $year року\n";
// завдання 8
echo "Завдання 8:\n";
$numbers = [];
for ($i = 0; $i < 20; $i++) {
    $numbers[] = rand(50, 500);
}

echo "Масив: " . implode(", ", $numbers) . "\n";

$count100 = 0;

foreach ($numbers as $num) {
    if ($num % 100 == 0) {
        $count100++;
    }
}

echo "Кількість чисел, кратних 100: $count100\n";
// завдання 9
echo "Завдання 9:\n";
$sum = 0;
$multiplesOf5 = [];

for ($i = 20; $i <= 45; $i++) {
    if (fmod($i, 5) == 0) {
        $multiplesOf5[] = $i;
        $sum += $i;
    }
}

echo "Числа, що діляться на 5: " . implode(", ", $multiplesOf5) . "\n";
echo "Їх сума: $sum\n";
// завдання 10
echo "Завдання 10:\n";
echo "Введіть хвилину (від 1 до 60): ";
$minute = readline();
$cycle = $minute % 5;

if ($cycle == 1 || $cycle == 2 || $cycle == 3) {
    echo "Результат: Зараз горить ЗЕЛЕНИЙ сигнал.\n";
} else {
    echo "Результат: Зараз горить ЧЕРВОНИЙ сигнал.\n";
}
?>
