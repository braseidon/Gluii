<?php namespace app\Http\Controllers\Account\Settings;

use Auth;
use App\Http\Controllers\BaseController;
use App\Http\Requests;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    /**
     * View settings
     *
     * @return Response
     */
    public function getSettings()
    {
        return view('account.settings.settings');
    }

    /**
     * View notification settings
     *
     * @return Response
     */
    public function getNotifications()
    {
        return view('account.settings.notifications');
    }
}
