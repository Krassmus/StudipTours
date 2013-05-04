<?php

class JoyrideTours extends SimpleORMap {
    
    static public function getByScript($script) {
        $tours = self::findBySQL("user_id = ? AND script = ?", array($GLOBALS['user']->id, $script));
        if (count($tours)) {
            return $tours[0];
        } else {
            $tour = new JoyrideTours();
            $tour['user_id'] = $GLOBALS['user']->id;
            $tour['script'] = $script;
            return $tour;
        }
    }
    
    public function __construct($id = null) {
        $this->db_table = "joyride_tours";
        parent::__construct($id);
    }
}