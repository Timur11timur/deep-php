<?php

namespace App;

class ArrayRand
{
    const MIN = 50;
    const MAX = 200;

    private $items = 6;
    private $result = [];

    public function get(int $sum): array
    {
        if (($sum < ($this->items * self::MIN)) || ($sum > ($this->items * self::MAX)) ) {
            throw new \Exception('Error');
        }

        do {
            $this->items--;
            $current_min = $this->items * self::MIN;
            $current_max = $this->items * self::MAX;
            do {
              if ($this->items === 0) {
                $rand = $sum;
              } else {
                $rand = rand(self::MIN, self::MAX);
              }
              $temp_sum = $sum - $rand;
            } while (!(($temp_sum >= $current_min) && ($temp_sum <= $current_max)));

            $sum -= $rand;
            $this->result[] = $rand;
        } while($this->items !== 0);

      return $this->result;
    }
}
