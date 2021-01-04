<?php

namespace devanych\cart\calculators;

interface CalculatorInterface
{
    /**
     * @param \devanych\cart\CartItem[] $items
     * @return integer
     */
    public function getCost(array $items);
    /**
     * @param \devanych\cart\CartItem[] $items
     * @return integer
     */
    public function getOldPriceCost(array $items);
    /**
     * @param \devanych\cart\CartItem[] $items
     * @return integer
     */
    public function getPriceCostWithoutDiscount(array $items);
    /**
     * @param \devanych\cart\CartItem[] $items
     * @return integer
     */
    public function getCount(array $items);
}
