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
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        // return []; // Remove this line to activate

        // return [
        //     'AppLogger\Logger\Components\MyComponent' => 'myComponent',
        // ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions() // REVIEW - Permissions väčšinou neriešime pomocou OCMS, keď ich je treba, urobia sa custom, takže toto + všetky ostatné funkcie v ktorých tu nič nemáš môžeš odstrániť
    {
        // return []; // Remove this line to activate

        return [
            'applogger.logger.some_permission' => [
                'tab' => 'Logger',
                'label' => 'Some permission'
            ],
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
