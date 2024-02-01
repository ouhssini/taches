<?php

$notes = [20,19, 3, 14, 17, 12, 12, 18,19.5];

foreach ($notes as $note) {
    for ($i = 0; $i < count($notes); $i++) {

        for ($j = 0; $j < count($notes) ; $j++) {
            if ($notes[$i] > $notes[$j]) {
                $inter = $notes[$i];
                $notes[$i] = $notes[$j];
                $notes[$j] = $inter;
            }
        }
    }
}

print_r($notes);