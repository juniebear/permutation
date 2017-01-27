<?php 
# Author: June K.
# Date: January 2017
#
# PHP permutations function adapted from Python's permutations function 
# itertools.permutations(iterable[, r]) which allows
# you to return r length permutations of the iterable.

#input as an array
$letters = range('A','D');

function permutations($items=array(), $r=NULL){
	$n = count($items);
	if ($r == NULL){
		$r = $n;
	}
	if ($r > $n){
		return;
	}
	$indices = range(0,$n-1);
	$cycles = array_reverse(range($n-$r+1, $n));
	$m = array_reverse(range(0,$r-1));
	yield array_slice($items, 0, $r);
	while($n){
		foreach ($m as $i){
				$newset = array();
				$cycles[$i]--;
			if ($cycles[0]!=0){
				if ($cycles[$i] == 0){
					$piece1 = array_splice($indices, $i+1);
					$piece2 = array_splice($indices, $i, 1);
					$indices = array_merge($indices,$piece1,$piece2);
					$cycles[$i] = $n-$i;
				}
				else{
					$j = $cycles[$i];
					$switch2 = $indices[$i];
					$indices[$i] = $indices[count($indices)-$j];
					$indices[count($indices)-$j] = $switch2;
					for ($x = 0; $x<$r; $x++){
							$newset[] = $items[$indices[$x]];
					}
					yield $newset;
					break;
				}
			} else {
				break 2;
			}
		} # end foreach
	}  # endwhile
	return;
} # end permutations()

# 2nd Parameter can be changed anywhere ranging from 1
# to however many elements you have in $letters.
$generator = permutations($letters, 4);

foreach($generator as $g){
	print_r($g);
	echo '</br>';
}
?>
