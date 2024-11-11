<?php namespace AppLogger\Logger\Http\Controllers;

use AppLogger\Logger\Models\Log;
use Illuminate\Http\Request;
use AppUser\User\Http\Resources\UserService;

class LoggerController
{
    // My custom routes for AppLogger.Logger
    public function getAllLogs(Request $request)
    {
        $token = UserService::getTokenFromAuth($request);
        $user_id = UserService::getUserByToken($token)->id;

        $logs = Log::where('user_id', $user_id)->get();
        return ['data' => $logs];

        if ($logs->isEmpty()){
            return response()->json(['message' => "No records found"]);

        } else {
            return ['data' => $logs];
        }
    }

    public function createAttendance(Request $request)
    {
        $hour = date("H");
        $token = UserService::getTokenFromAuth($request);

        $log = new Log();
        $log->name = post('name');
        $log->time_of_arrival = date("Y-m-d H:i:s");
        $log->is_late = ($hour >= 8);
        $log->user_id = UserService::getUserByToken($token)->id;
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