<?php namespace AppUser\User\Models;

use Model;
use AppLogger\Logger\Models\Log;

/**
 * User Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class User extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Hashable;

    /**
     * @var string table name
     */
    public $table = 'appuser_user_users';

    /**
     * @var array List of attributes to hash.
     */
    protected $hashable = ['password'];

    public $hasMany = [
        'logs' => Log::class
    ];

    /**
     * @var array rules for validation
     */
    public $rules = [
        'username' => 'required|unique:appuser_user_users',
        'password' => 'required:create|min:8'
    ];
}
