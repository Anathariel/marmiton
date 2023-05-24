<?php

class SearchController extends Controller {
    public function searchrecipe() {
        global $router;

        if (isset($_GET["submit"])) {
            $search = $_GET['search'];
            $search = trim($search);
            $search = strip_tags($search);

            $model = new SearchModel();
            $results = $model->getSearchResult($search);

            $searchlink = $router->generate('search');
            echo self::getRender('searchresult.html.twig', ['results' => $results, 'searchlink' => $searchlink]);
        } else {
            echo 'Nothing to see here, why not write it yourself ?';
        }
    }
}