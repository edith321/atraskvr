<?php namespace App\Http\Controllers;

use App\Models\VRCategories;
use Illuminate\Routing\Controller;

class VRCategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrcategories
	 *
	 * @return Response
	 */

    public function adminIndex()
    {
       // $configuration = $this->getRoutesData();
        $configuration ['listName'] = 'Categories list';
        $configuration ['list'] =  VRCategories::with(['categoryTranslations'])->get()->toArray();
        $configuration ['ignore'] = '';

        return view('admin.adminList', $configuration);
    }

    public function getRoutesData()
    {
        $configuration = [];
       // $configuration ['showDelete'] = 'app.admin.categories.index';
       // $configuration ['edit'] = 'app.admin.categories.index';
        return $configuration;
    }
}