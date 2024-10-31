<?php namespace AppLogger\Logger\Models;

use Model;

/**
 * Log Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Log extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'applogger_logger_logs';
    
    /**
     * @var array rules for validation
     */
    public $rules = [];
    /* REVIEW - Treba si definovať rules pre model, aby sa ti tam nedostali zlé typy dát a podobne
    V tvojom prípade ti to API vstupuje len "$name", všetko ostatné sa generuje v rámci API, takže potrebuješ len pravidlá pre "$name"
    Pozri si aké validation rules existujú, tu konkrétne použiješ tak 1 pravidlo, max 2, ale viac pravidiel budeš potrebovať v ďalších leveloch */
}
