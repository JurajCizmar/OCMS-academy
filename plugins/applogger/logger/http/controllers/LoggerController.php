<?php namespace AppLogger\Logger\Http\Controllers;

use AppLogger\Logger\Models\Log;

class LoggerController
{
    // My custom routes for AppLogger.Logger
    public function getAllLogs()
    {
        $logs = Log::all();
        return ['data' => $logs];
    }

    public function createAttendance()
    {
        $log = new Log();
        $hour = date("H");

        $log->name = post('name');
        $log->time_of_arrival = date("Y-m-d H:i:s");
        $log->is_late = ($hour >= 8);
        $log->save();

        return ['data' => $log];
    }

    public function getStudent($name)
    {
        $data = Log::where('name', $name)->get();

        if ($data->isEmpty()){
            return response()->json(['message' => "No records found"]);

        } else {
            return ['data' => $data];
        }
    }

    public function deleteLogs()
    {
        Log::truncate();

        return response()->json(['message' => "All logs were deleted successfully"]);
    }
}