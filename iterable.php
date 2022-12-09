<?php

class Money
{
    public readonly int $amount;

    public function __construct(int $amount)
    {
        if ($amount < 1) {
            throw new Exception('Only more 0');
        }
        $this->amount = $amount;
    }
}

class Wallet implements Iterator
{
    private array $all;
    private int $current = 0;

    public function __construct(...$money)
    {
        $this->all = $money;
    }

    public function add(Money $money): void
    {
        $this->all[] = $money;
    }

    public function sum(): int
    {
        $result = 0;
        foreach ($this->all as $money) {
            $result += $money->amount;
        }

        return $result;
    }

    public function current(): mixed
    {
       return $this->all[$this->current];
    }

    public function next(): void
    {
        $this->current++;
    }

    public function key(): mixed
    {
        return $this->current;
    }

    public function valid(): bool
    {
        return isset($this->all[$this->current]);
    }

    public function rewind(): void
    {
        $this->current = 0;
    }
}

$one = new Wallet(new Money(5), new Money(4), new Money(8));

echo $one->sum() . PHP_EOL;

foreach ($one as $money) {
    echo $money->amount . PHP_EOL;
}
echo 'End';
echo '<br />';

class WalletTwo implements IteratorAggregate
{
    private array $all;

    public function __construct(...$money)
    {
        $this->all = $money;
    }

    public function add(Money $money): void
    {
        $this->all[] = $money;
    }

    public function sum(): int
    {
        $result = 0;
        foreach ($this->all as $money) {
            $result += $money->amount;
        }

        return $result;
    }

    public function getIterator(): Traversable
    {
       return new ArrayIterator($this->all);
    }
}

$two = new WalletTwo(new Money(5), new Money(4), new Money(8));

echo $two->sum() . PHP_EOL;

foreach ($two as $money) {
    echo $money->amount . PHP_EOL;
}
echo 'End';