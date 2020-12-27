<?php

namespace devanych\cart;
use common\models\Category;

class CartItem
{
    /**
     * @var object $product
     */
    private $product;
    /**
     * @var integer $quantity
     */
    private $quantity;
    /**
     * @var array $params Custom configuration params
     */
    private $params;
    private $options = false;
    private $options_prices = array();

    public function __construct($product, $quantity, array $params, $options = false, $options_prices = array())
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->params = $params;
        $this->options = $options;
        $this->options_prices = $options_prices;
    }

    /**
     * Returns the id of the item
     * @return integer
     */
    public function getId()
    {
        return $this->product->{$this->params['productFieldId']};
    }

    /**
     * Returns the price of the item
     * @return integer|float
     */
    public function getPrice()
    {
        if ($this->getOptions()) {
            $prices = array_sum($this->getOptionsPrices());
            return $this->product->{$this->params['productFieldPrice']} + $prices;
        } else {
            return $this->product->{$this->params['productFieldPrice']};
        }
    }

    /**
     * Returns the discount price of the item
     * @return integer|float
     */
    public function getDiscount()
    {
        if ($this->getOptions()) {
            $prices = array_sum($this->getOptionsPrices());
            return $this->product->{$this->params['productFieldDiscount']} + $prices;
        } else {
            return $this->product->{$this->params['productFieldDiscount']};
        }
    }

    /**
     * Returns the product, AR model
     * @return object
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Returns an category_url for item
     * @param integer $id
     * @return CartItem
     */
    public function getCategory($id)
    {
        return Category::find()->select('url')->where(['id'=>$id])->one();
    }

    /**
     * Returns the cost of the item
     * @return integer|float
     */
    public function getCost()
    {
        return ceil($this->getPrice() * $this->quantity);
    }

    /**
     * Returns the discount cost of the item
     * @return integer|float
     */
    public function getDiscountCost()
    {
        return ceil($this->getDiscount() * $this->quantity);
    }

    /**
     * Returns the quantity of the item
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the quantity of the item
     * @param integer $quantity
     * @return void
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getOptions()
    {
        return $this->options?$this->options:false;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }
    public function getOptionsPrices()
    {
        return $this->options_prices;
    }

    public function setOptionsPrices($options_prices)
    {
        $this->options_prices = $options_prices;
    }
}
