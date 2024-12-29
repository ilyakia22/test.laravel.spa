<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    const UPDATED_AT = null;

    const TYPE_OK    = 1;
    const TYPE_ERROR = 2;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function listTypes()
    {
        return [
            self::TYPE_OK    => 'Ok',
            self::TYPE_ERROR => 'Error',
        ];
    }

    public function typeLabel()
    {
        $list = self::listTypes();
        return isset($list[$this->type]) ? $list[$this->type] : $this->type;
    }

    public static function addMsg($msg, $type)
    {
        $log = new Log();
        $log->type = $type;
        $log->comment = $msg;
        $log->save();
    }

    public static function addOk($msg)
    {
        self::addMsg($msg, self::TYPE_OK);
    }

    public static function addError($msg)
    {
        self::addMsg($msg, self::TYPE_ERROR);
    }
}
