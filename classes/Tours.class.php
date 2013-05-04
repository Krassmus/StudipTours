<?php

class Tours extends SimpleORMap {
    
    static public function getByScript($script) {
        $tours = self::findBySQL("user_id = ? AND script = ?", array($GLOBALS['user']->id, $script));
        if (count($tours)) {
            return $tours[0];
        } else {
            $tour = new Tours();
            $tour['user_id'] = $GLOBALS['user']->id;
            $tour['script'] = $script;
            return $tour;
        }
    }
    
    public function __construct($id = null) {
        $this->db_table = "tours";
        parent::__construct($id);
    }
}