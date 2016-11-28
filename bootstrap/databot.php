<?php
use \Illuminate\Database\Eloquent\Model;
use GigaAI\Storage\Storage;

class DataBot extends Model {
    public $table = "bot_data";
    public $timestamps = false;
    public $bot;
    protected $fillable = [
        'lead_id', 'key', 'value'
    ];

    function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->bot = require __DIR__ . '/../bootstrap/bot.php';
    }

    /**
     * Set data
     * @param $leadId
     * @param $key
     * @param $value
     */
    public static function setData($leadId, $key, $value){
        new static;
        $data = DataBot::where('lead_id', $leadId)->where('key', $key)->first();
        if($data == null) $data = new DataBot();
        $data->lead_id  = $leadId;
        $data->key      = $key;
        $data->value    = serialize($value);
        $data->save();
        return true;
    }

    /**
     * Get data
     * @param $leadId
     * @param $key
     * @return mixed|null
     */
    public static function getData($leadId, $key){
        new static;
        $data = DataBot::where('lead_id', $leadId)->where('key', $key)->first();
        if($data)
            return unserialize($data->value);
        return null;
    }
}