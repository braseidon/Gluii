<?php namespace App\Http\Controllers\Account\Settings;

use Auth;
use App\Commands\Account\Settings\UpdateSettingsCommand;
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
     * Update settings
     *
     * @return Response
     */
    public function postUpdateSettings(\App\Http\Requests\Account\Settings\UpdateSettingsRequest $request)
    {
        $this->dispatch(
            new UpdateSettingsCommand(
                Auth::getUser()->id,
                $request->input()
            )
        );

        return redirect()->route('account/settings')->withSuccess('Your settings have been updated.');
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
