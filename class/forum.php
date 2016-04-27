<?php

/**
 * Description of class
 *
 * @author mike
 */
class Forum {

    public $id;
    public $url;
    public $text;
    public $dbc;

    function __construct() {
        if (!$this->dbc) {
            $this->getdb();
        }
    }
    
    function getLinks($limit){
        $query = "SELECT * FROM forum_links ORDER BY fl_id DESC LIMIT $limit;";
        return array_reverse($this->dbc->query($query));
    }
    function save($text, $url){
        $query = "INSERT INTO forum_links 
                    (fl_text, fl_url) VALUES
                    ('$text', '$url');";
        $this->dbc->insert($query);
    }

    private function getdb() {
        $this->dbc = dbc::getInstance();
    }

}