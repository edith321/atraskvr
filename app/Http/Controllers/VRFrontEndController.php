<?php

namespace App\Http\Controllers;

use App\Models\VRMenus;
use App\Models\VRMenusTranslations;
use App\Models\VRPages;
use App\Models\VRPagesTranslations;
use Illuminate\Http\Request;

class VRFrontEndController extends Controller
{
    /**
     * Gets data from menu and menu translations
     * and sends it to home blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function displayMenu() {

        $data['about'] = VRPages::with(['translation', 'coverImages'])->find('apie')->toArray();
        $data['menus'] = VRMenus::with(['translationsLang', 'children'])->where('parent', "")->get()->toArray();

        return view('front-end.front-endHome', $data);
    }
}
