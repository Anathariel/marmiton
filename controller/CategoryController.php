<?php
class CategoryController extends Controller {

    public function showAll(){
        global $router;
        $model = new CategoryModel();
        $datas = $model->getAllCategory();
        $link = $router->generate('catMenu');

        echo self::getTwig()->render('header.html.twig', ['categories' => $datas, 'link' => $link]);
    }
}