<?php


class StudentTest extends Module
{

    public function __construct()
    {
        $this->name = 'studenttest';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Nhust';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Module Student');
        $this->description = $this->l('Displays something in product page.');
    }


    public function install()
    {
        return
            parent::install();
    }

    public function hookDisplayAdminProductsExtra($params)
    {



        // return the html form
        // the submit button must have submitAddCustomField as name to work
        // the input text must have short_desc as name

        // instanciate the product class with the parameter get id_product
        // save the value of the form short_desc on product class
        // use the method save on product class to persist date in database
        $product = new Product($_GET['id_product']);

        $output = '<form action="" method="POST">
            <label for="">Short description</label>
            <input type="text" name="short_desc" value="'.$product->short_desc.'">
            <input type="submit" name="submitAddCustomField">
        </form>';
        return $output;
    }

    public function hookDisplayProductTab($params)
    {

        // Here you have to return the value of short_desc with some html integration
        // instanciate the product class with the parameter get id_product
        // Get the product category default
        // instanciate the class Category with the field id_category_default from product class
        // use method getProducts from category class to get all the product from the category

        // return a html with the value with the 2 products you get
        $product = new Product($_GET['id_product']);

        $cat = new Category($product->id_category_default);
        $products = $cat->getProducts(1,1,3);

        $st = '';
        foreach($products as $item){

            $st .= '
            <div style="width:30%;">
            <div><img src="http://test.lan/1-large_default/t-shirt-delave-manches-courtes.jpg" alt=""></div>
            <div style="display: flex;align-items: center">
                <div><p>'.$item["name"].'</p>
                <p>'.$item["price"].' €</p></div>
                <div style="padding-left:25px"><a href="#" style="background:#55c65e;color:#fff;padding: 3px 8px 4px">Add to cart</a></div>
               
            </div>
            </div>';


        }


        return '<div>
            <p>' . $product->short_desc . '</p>
                </div>
                <div style="overflow:scroll;width:100%;display:flex;justify-content: space-around">
                ' . $st . '
            </div>';


    }

}
