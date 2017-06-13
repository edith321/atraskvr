<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrLanguageCodes;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VrCategoriesController extends Controller {


	/**
	 * Display a listing of the resource.
	 * GET /vrcategories
	 *
	 * @return Response
     *
	 */
	public function index()
	{
        $config['list'] = VrCategories::get()->toArray();
        $config['title'] = trans('app.adminMenuCategories');
        $config['no_data'] = trans('app.adminNoData');
        $config['new'] = 'app.categories.create';
        return view('admin.adminList', $config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrcategories/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $config['submit'] = 'app.categories.create';
        $config['title'] = trans('app.adminMenuCategories');
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguages(),
            "label" => trans('app.adminLanguages')

        ];
        $config['fields'][] = [
            "type" => "single_line",
            "key" => "name",
            "label" => trans('app.adminName')
        ];

        return view('admin.adminForm', $config);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrcategories
	 *
	 * @return Response
	 */
	public function store()
	{
	    $data = request()->all();
	    $record = VrCategories::create();
	    $data['record_id'] = $record->id;
	    VrCategoriesTranslations::create($data);

	    return redirect(route('app.categories.edit', [$record->id])); // arba $data['record_id']
	}

	/**
	 * Display the specified resource.
	 * GET /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrcategories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

}