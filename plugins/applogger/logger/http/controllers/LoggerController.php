<?php namespace AppLogger\Logger\Http\Controllers;

use Illuminate\Http\Request;
use AppLogger\Logger\Models\Log;


class LoggerController
{
    // public function helloworld()
    // {
    //     return "hello World";
    // }

    // My custom routes for AppLogger.Logger
    public function getAllLogs()
    {
        $logs = Log::all();
        return ['data' => $logs];
    }

    public function createAttendance($name)
    {
        $log = new Log();
        $hour = date("H");

        $log->name = $name;
        $log->time_of_arrival = date("Y-m-d H:i:s");
        $log->is_late = ($hour >= 8);
        $log->save();

        return ['data' => $log];
    }

    public function getStudent($name)
    {
        // REVIEW - tu funkcia hľadá iba jedného študenta, ale používaš "get()", čo je zoznam. 
        // Viac by sa hodilo "first()", odporúčam "firstOrFail()"
        $data = Log::where('name', $name)->firstOrFail();

        return ['data' => $data];
    }

    public function deleteLogs()
    {
        // Log::query()->delete()

        Log::truncate();

        return response()->json(['message' => "All logs were deleted successfully"]);
    }
}