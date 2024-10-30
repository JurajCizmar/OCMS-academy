<?php namespace AppLogger\Logger\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use AppLogger\Logger\Models\Log;
use Illuminate\Http\Request;

/**
 * Attendance Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Attendance extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['applogger.logger.attendance'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('AppLogger.Logger', 'logger', 'attendance');
    }

    // My custom routes for AppLogger.Logger

    public function getAllLogs()
    {
        $logs = Log::all();
        return response()->json(['data' => $logs]); // REVIEW - Tip - toto sa dá zjednodušiť na "return ['data' => $logs];", keď vrátiš array tak OCMS automaticky zaregistruje že je to json response
    }

    public function createAttendance($name)
    {
        $log = new Log();
        $hour = date("H");

        $log->name = $name;
        $log->time_of_arrival = date("Y-m-d H:i:s");
        $log->is_late = ($hour >=8);
        $log->save();

        return response()->json(['data' => $log]);
    }

    public function getStudent($name)
    {
        // REVIEW - tu funkcia hľadá iba jedného študenta, ale používaš "get()", čo je zoznam. Viac by sa hodilo "first()"
        // REVIEW - taktiež tu nie je pokrytý prípad, kedy študent s menom "$name" neexistuje. Odporúčam "firstOrFail()"
        $data = Log::where('name', $name)->get();

        return response()->json(['data' => $data]);
    }

    public function deleteLogs()
    {
        // REIVEW - Tip - Tu by sa to určite dalo urobiť bez foreach loopu, napr. "Log::query()->delete()" by mohlo fungovať ale určite si to over :D
        $logs = Log::all();
        
        foreach($logs as $log){
            $log->delete();    
        }

        return response()->json(['message' => "All logs were deleted successfully"]);
    }
}
