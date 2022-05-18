<?php

class ShoppingCart
{

    protected $items;

    protected $name;

    
    public function __construct($name = 'shopping_cart')
    {

        $this->name = $name;

        if (!empty($_SESSION[$this->name]) && is_array($_SESSION[$this->name])) {
            $this->items = $_SESSION[$this->name];
        } else {
            $this->items = array();            
        } 
    }

    /**
     * Return the items
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * Clean the shopping cart
     */
    public function clean()
    {
        $this->items = array();
        $this->save();
    }

    /**
     * Checks if the cart is empty
     */
    public function isEmpty()
    {
        return ($this->numItems() <= 0);
    }

    /**
     * Checks the total items in the cart
     */
    public function numItems()
    {
        return count($this->items);
    }

    public function add($id, $amount = 1)
    {


        if (array_key_exists($id, $this->items)) {
            $this->items[$id]['amount'] += intval($amount);
        } else {
            $this->items[$id] = array(
                'id'        =>  $id,
                'amount'    =>  intval($amount)
            );
        }
        $this->save();
    }
    public function delete($id)
    {
        $u_id = md5($id);

        if (array_key_exists($u_id, $this->items)) {
            unset($this->items[$u_id]);
            $this->save();
        }
    }

    protected function save()
    {
        $_SESSION[$this->name] = $this->items;
    }
}