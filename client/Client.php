<?php
class Client {
    
    public $customers;
    public $products;
    public $invoices;

    /**
     * Initializes the client facing section of the web store
     * 
     * @param Customers $customers
     * @param Products $products
     * @param Invoices $invoices
     */
    public function __construct(Customers $customers, Products $products, Invoices $invoices){
        
        $this->customers = $customers;
        $this->products = $products;
        $this->invoices = $invoices;
    }
    
    /**
     * Displays all the various aspects
     */
    public function showAll() {
        
        //$this->customers->show();
        //$this->products->show();
        $this->invoices->show();
    }
    
    /**
     * Navigates to various sections based on input
     * 
     * @param type $io_type
     * @param type $io_value
     */
    public function show($io_type, $io_value) {
        
        switch ($io_type) {
            
            case 'invoice':
                $this->invoices->show($io_value);
                break;
        }
    }
}
