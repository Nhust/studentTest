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
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6.99.99');
    }


    public function install()
    {
        return
            parent::install() && $this->registerHook('displayHeader')
            && $this->registerhook('displayAdminProductsExtra')
            && $this->registerhook('displayProductTab');
    }

    public function hookDisplayAdminProductsExtra($params)
    {


        $formesc = 
        
        '<form action="#" method="post">
        <div>
            <label for="Sdesc">Quelle est la description du produit ?</label>
            <input type="text" id="Sdesc" name="short_desc" value="desc">
        </div>
        <div>
            <button name="submitAddCustomField">Envoyer mes salutations</button>
        </div>
       
        </form>'

        if (isset($_POST["short_desc"])) {
            $shortDesc = htmlspecialchars ($_POST['shortDesc']);
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli = new mysqli("test.lan", "root", "", "studenttest");

            $mysqli->query("INSERT INTO ps_product (short_desc) VALUES ($shortDesc) WHERE id_product = $params");

        };
        else {

        };


        



        $output2 = $formesc;
        return $output2;
    }

    public function hookDisplayProductTab($params)
    {

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("test.lan", "root", "", "studenttest");

        $sDesc = $mysqli->query("SELECT short_desc FROM ps_product WHERE id_product = $params");

        return $output = '<p>'$sDesc'</p>';


    }

}


?>