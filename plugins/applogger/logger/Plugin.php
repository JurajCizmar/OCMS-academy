<?php namespace AppLogger\Logger;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Logger',
            'description' => 'Logging application for students',
            'author' => 'AppLogger',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        // return []; // Remove this line to activate

        return [
            'logger' => [
                'label' => 'Logger',
                'url' => Backend::url('applogger/logger/attendance'),
                'icon' => 'icon-leaf',
                'permissions' => ['applogger.logger.*'],
                'order' => 500,
            ],
        ];
    }
}
