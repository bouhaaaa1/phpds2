<?php
class Cart{
    private $items = array();
    private $subtotals = array();
    private $quantity;
    private $total_price;
    function __construct(){
			
        $this->items=array();
        $this->subtotals=array();
        $this->quantity=0;
        $this->total_price=0;
    }

    function Add($id,$q){
        // $this->items = array();
        if(array_key_exists($id,$this->items)){
            echo"<script>alert('hello');</script>";
            $this->items[$id]+=$q;
        }else{
            $this->items = $this->items + array($id => $q);
        }
    }
}
?>