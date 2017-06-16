<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use App\Models\VrResources;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class VrPagesController extends Controller {

    use ValidatesRequests;
	/**
	 * Display a listing of the resource.
	 * GET /vrpages
	 *
	 * @return Response
	 */

	public function index()
	{
        $config['list'] = VrPages::get()->toArray();
        $config['title'] = trans('app.adminPages');
        $config['no_data'] = trans('app.adminNoData');
        $config['new'] = route('app.pages.create');
        $config['edit'] = 'app.pages.edit';
        $config['delete'] = 'app.pages.destroy';
        return view('admin.adminList', $config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrpages/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $config = $this->getFormData();
        $config['submit'] = route('app.pages.create');
        $config['title_name'] = trans('app.adminCreate');

        return view('admin.adminForm', $config);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrpages
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = request()->all();

        $this->validate(request(), [
            'category_id' => 'required',
        ]);
        $record = VrPages::create($data);
        $data['record_id'] = $record->id;
        VrPagesTranslations::create($data);

        return redirect(route('app.pages.edit', [$record->id]));
    }

	/**
	 * Display the specified resource.
	 * GET /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrpages/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $config = $this->getFormData();
        $config['title_name'] = trans('app.adminEdit');
        $config['submit'] = route('app.pages.edit', $id);
        $config['edit'] = VrPages::find($id)->toArray();
        $config['edit']['language_code'] = $config['edit']['translation']['language_code'];
        $config['edit']['title'] = $config['edit']['translation']['title'];
        $config['edit']['description_short'] = $config['edit']['translation']['description_short'];
        $config['edit']['description_long'] = $config['edit']['translation']['description_long'];
        $config['edit']['slug'] = $config['edit']['translation']['slug'];

        return view('admin.adminForm', $config);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}
    public function getFormData() {

        $lang = request('language_code');

        if($lang == null) {
            $lang = app()->getLocale();
        }

        $config['title'] = trans('app.adminPages');
        $config['back'] = route('app.pages.index');
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguages(),
            "label" => trans('app.adminLanguages')
        ];
        $config['fields'][] = [
            "type" => "single_line",
            "key" => "title",
            "label" => trans('app.adminName')
        ];
        $config['fields'][] = [
            "type" => "single_line",
            "key" => "slug",
            "label" => trans('app.adminURL')
        ];
        $config['fields'][] = [
            "type" => "short_text",
            "key" => "description_short",
            "label" => trans('app.adminDescriptionShort')
        ];
        $config['fields'][] = [
            "type" => "long_text",
            "key" => "description_long",
            "label" => trans('app.adminDescriptionLong')
        ];
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "category_id",
            "label" => trans('app.adminChooseCategory'),
            "options" => VrCategoriesTranslations::where('language_code', $lang)->pluck('name', 'record_id'),
        ];
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "cover_id",
            "label" => trans('app.adminCoverImage'),
            "options" => VrResources::pluck('path', 'id'),
        ];
        return $config;
    }

}