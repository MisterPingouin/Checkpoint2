<?php

namespace App\Controller;

use App\Model\AccessoryManager;

/**
 * Class AccessoryController
 *
 */
class AccessoryController extends AbstractController
{
    /**
     * Display accessory creation page
     * Route /accessory/add
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
            $url = $data['url'];

            if (!isset($name) || empty($name)) {
                $this->errors[] = 'You must write a name';
            }
            if (!isset($url) || empty($url)) {
                $this->errors[] = 'Please fill in url field.';
            }
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $this->errors[] = 'Wrong URL format';
            }
            if (empty($this->errors)) {
                $accessoryManager = new AccessoryManager();
                $accessoryManager->insertAccessory($name, $url);
                header('Location:/accessory/list');
                die();
            }
            return $this->twig->render('/accessory/add.html.twig', [
                'errors' => $this->errors,
            ]);
            //TODO Add your code here to create a new accessory
        }
        return $this->twig->render('Accessory/add.html.twig');
    }

    /**
     * Display list of accessories
     * Route /accessory/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

        public function list()
        {
            $accessoryManager = new AccessoryManager();
            $accessories = $accessoryManager->selectAll('id');
            //TODO Retrieve all cupcakes
            return $this->twig->render('Accessory/list.html.twig', [ 'accessories' => $accessories]);
        }
    
}
