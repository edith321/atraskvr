<?php namespace App\Http\Controllers;

use App\Models\VrResources;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;

class VrResourcesController extends Controller {


	/**
	 * Display a listing of the resource.
	 * GET /vrresources
	 *
	 * @return Response
	 */
	public function index()
	{
        $config['list'] = VrResources::get()->toArray();
        $config['title'] = trans('app.adminMenuResources');
        $config['no_data'] = trans('app.adminNoData');
        $config['new'] = route('app.resources.create');
        $config['edit'] = 'app.resources.edit';
        $config['delete'] = 'app.resources.destroy';
        return view('admin.adminList', $config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrresources/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $config = $this->getFormData();
        $config['submit'] = route('app.resources.create');
        $config['title_name'] = trans('app.adminCreate');

        return view('admin.adminForm', $config);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrresources
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = request()->all();
		dd($data);
	}

	/**
	 * Display the specified resource.
	 * GET /vrresources/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrresources/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrresources/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrresources/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getFormData() {

        $lang = request('language_code');

        if($lang == null) {
            $lang = app()->getLocale();
        }

        $config['title'] = trans('app.adminMenuMenus');
        $config['back'] = route('app.menu.index');
        $config['fields'][] = [
            "type" => "image",
            "key" => "image",
            "label" => trans('app.adminLanguages')
        ];
        return $config;
    }
}