<?php
class CategoryController extends Controller {
    public function getOne($id) {
        $model = new CategoryModel();
        $category = $model->getOneCategory($id);
        $recipes = $model->getRecipesByCategory($id);

        echo self::getRender('category.html.twig', ['category' => $category, 'recipes' => $recipes]);
    }
}