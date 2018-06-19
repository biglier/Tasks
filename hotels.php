<?php
$inputFile = fopen('php://stdin', 'r');
$outputFile = fopen('php://stdout', 'w');
$input = array();
while (!feof($inputFile)) {
     $str =fgets($inputFile);
     $input[]= explode(" ",$str);
}
fwrite($outputFile, sprintf("%s\n", maxHotelSequencePrice($input[0][0],
                            $input[0][1], $input[1])));
fclose($outputFile);
fclose($inputFile);
function maxHotelSequencePrice($hotelsCount, $lottery, $hotels){
$curStart = $bestStart= 0;
$curLenght = $bestLength = 1 ;
$bestSum=$curSum=$hotels[0];
for ($i=1; $i <$hotelsCount ; $i++) {
  $curLength += 1;
  $curSum += $hotels[$i];
  while ($curSum >$lottery)
       {
         $curSum -=$hotels[$curStart];
         $curStart++;
         $curLength--;
       }

     if ($curSum > $bestSum)
     {
       $bestStart = $curStart;
       $bestLength = $curLength;
       $bestSum = $curSum;
     }
}
 return $bestSum;
}
