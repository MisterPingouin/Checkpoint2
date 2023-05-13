<?php

namespace App\Controller;

use App\Model\CupcakeManager;
use App\Model\AccessoryManager;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);

            $name = $data['name'];
            $color1 = $data['color1'];
            $color2 = $data['color2'];
            $color3 = $data['color3'];
            $accessory = intval($data['accessory']);;

            if (!isset($name) || empty($name)) {
                $this->errors[] = 'You must write a name';
            }
            if (!is_int($accessory) || $accessory <= 0) {
                $this->errors[] = 'Invalid accessory';
            }
            if (empty($this->errors)) {
                $cupcakeManager = new CupcakeManager();
                $cupcakeManager->insertCupcake($name, $color1, $color2, $color3, $accessory);
                header('Location:/cupcake/list');
                die();
            }
            return $this->twig->render('/cupcake/add.html.twig', [
                'errors' => $this->errors,
            ]);
        }
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll('id');
        //TODO retrieve all accessories for the select options
        return $this->twig->render('Cupcake/add.html.twig', ['accessories' => $accessories]);
    }

    /**
     * Display list of cupcakes
     * Route /cupcake/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAllCupcake('id');
        //TODO Retrieve all cupcakes
        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }

    public function show()
    {
        $cupcakeManager = new CupcakeManager();
        if (!isset($_GET['id'])) {
            header('Location: /404');
            die();
        }
        $id = $_GET['id']; 
        $cupcake = $cupcakeManager->selectCupcakeById($id); 
        return $this->twig->render('Cupcake/show.html.twig', ['cupcake' => $cupcake]);
    }
    

}
