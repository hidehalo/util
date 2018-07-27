<?php
include __DIR__.'/../../vendor/autoload.php';

$realNumberElments = [];
$number = 1e5;
$spl = "SPL_MAX_HEAP";
$purePhp = "PHP_MAX_HEAP";
$splTotalTimes = 0.0;
$purePhpTotalTimes = 0.0;
$line = str_repeat('-', 63);
for ($i=1; $i<=$number; $i++) {
    $realNumberElments[] = $number;
}
printf("%s\n", $line);
printf("Benchmarking start...\n");
printf("%s\n", $line);

$s = microtime(1);
$splMaxHeap = new \SplMaxHeap();
foreach ($realNumberElments as $number) {
    $splMaxHeap->insert($number);
}
$f = microtime(1);
$splTotalTimes += $f-$s;
printf("$spl build heap time used: %f s\n",$f-$s);

$s = microtime(1);
$rawPhpMaxHeap = new \Hidehalo\Util\Ds\Heap\MaxHeap($realNumberElments);
$f = microtime(1);
$purePhpTotalTimes += $f-$s;
printf("$purePhp build heap time used: %f s\n",$f-$s);

$s = microtime(1);
$splMaxHeap->top();
$f = microtime(1);
$splTotalTimes += $f-$s;
printf("$spl get root time used: %lf s\n",$f-$s);

$s = microtime(1);
$rawPhpMaxHeap->getMax();
$f = microtime(1);
$purePhpTotalTimes += $f-$s;
printf("$purePhp get root time used: %lf s\n",$f-$s);

$s = microtime(1);
$splMaxHeap->extract();
$f = microtime(1);
$splTotalTimes += $f-$s;
printf("$spl extract root time used: %lf s\n",$f-$s);

$s = microtime(1);
$rawPhpMaxHeap->extractMax();
$f = microtime(1);
$purePhpTotalTimes += $f-$s;
printf("$purePhp extract root time used: %lf s\n",$f-$s);

echo PHP_EOL;

printf("%s\n", $line);
printf("Conclustion:\n");
printf("%s\n", $line);
$faster = $purePhpTotalTimes < $splTotalTimes? $purePhp: $spl;
$slower = $purePhpTotalTimes > $splTotalTimes? $purePhp: $spl;
$fasterTimes = $purePhpTotalTimes < $splTotalTimes? $purePhpTotalTimes: $splTotalTimes;
$slowerTimes = $purePhpTotalTimes > $splTotalTimes? $purePhpTotalTimes: $splTotalTimes;
$performanceX = $slowerTimes/$fasterTimes;
switch (intval($performanceX)) {
    case 1:
        printf("Boring...\n");
        break;
    case 2:
        printf("Opps!\n");
        break;
    case 3:
        printf("Awesome!!\n");
        break;
    case 4:
        printf("Marvelous!!!\n");
        break;
    default:
        printf("%s is totally shit!!!!\n", $slower);
        break;
}
printf("%s is %.2f times faster than %s, the winner is %s.\n", $faster, $performanceX, $slower, $faster);