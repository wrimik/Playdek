<?php

/**
 * Description of class
 *
 * @author mike
 */
class Game {

    public $id;
    public $dbc;
    public $published;
    public $name;
    public $top;
    public $bottom;
    public $itunes;
    public $banner;
    public $badge;
    public $features;
    public $highlights;
    public $forum;
    public $rootLocation = '../';

    function __construct() {
        if (!$this->dbc) {
            $this->getdb();
        }
    }
    
    function newDlc(){
        $query = "INSERT INTO game_dlc 
                    () values ();";
        return $this->dbc->insert($query);
    }
    
    function updateDlc($dlc_id, $game_id, $published, $title, $content){
        $query = "UPDATE game_dlc SET
                    dlc_gameID = '$game_id',
                    dlc_published = '$published',
                    dlc_title = '$title',
                    dlc_content = '$content'
                    WHERE dlc_id = '$dlc_id' LIMIT 1;";
        return $this->dbc->insert($query);
    }
    
    function getGameDlc($game_id){
        $query = "SELECT * FROM game_dlc WHERE dlc_gameID = '$game_id' ORDER BY dlc_id ASC;";
        $result= $this->dbc->query($query);
        
        foreach($result as $key => $val){
            $result[$key]['imgs'] = $this->dlcImgs($val['dlc_id']);
        }
        
        return $result;
    }
    function getDlc($dlc_id){
        $query = "SELECT * FROM game_dlc WHERE dlc_id = '$dlc_id' ORDER BY dlc_id ASC;";
        $result= $this->dbc->query($query);
        
        foreach($result as $key => $val){
            $result[$key]['imgs'] = $this->dlcImgs($val['dlc_id']);
        }
        
        return $result[0];
    }
    
    function fromPost($post){
        $this->id = $post['game_id'];
        $this->published = $post['game_published'];
        $this->name   = $post['game_name'];
        $this->top    = $post['game_top'];
        $this->bottom = $post['game_bottom'];
        $this->android_v = $post['game_android_v'];
        $this->ios_v   = $post['game_ios_v'];
        $this->highlights = $post['game_highlights'];
        $this->features   = $post['game_features'];
        
        // URLs throw security issues in post data. Script adds a space character before all values. this removes it.
        $this->itunes = trim($post['game_itunes']);
        $this->google_play =trim( $post['game_google_play']);
        $this->amazon = trim($post['game_amazon']);
        $this->pc     = trim($post['game_pc']);
        $this->steam  = trim($post['game_steam']);
        $this->mac    = trim($post['game_mac']);
        $this->forum   = trim($post['game_forum']);
        
        foreach($post['available'] as $a){
            $this->available[$a] = 1;
        } 
    }
    
    function saveGame(){
        if($this->id == 'new'){
            $query = "INSERT INTO games () VALUES ();";
            $this->id = $this->dbc->insert($query);
        }
        
        $query = "UPDATE games SET
                    game_published = '{$this->published}',
                    game_name   = '{$this->name}',
                    game_top    = '{$this->top}',
                    game_bottom = '{$this->bottom}',
                    game_itunes = '{$this->itunes}',
                    game_google_play = '{$this->google_play}',
                    game_amazon = '{$this->amazon}',
                    game_pc     = '{$this->pc}',
                    game_steam  = '{$this->steam}',
                    game_mac    = '{$this->mac}',
                    game_ios_v  = '{$this->ios_v}',
                    game_android_v  = '{$this->android_v}',
                    game_forum  = '{$this->forum}'
                        WHERE game_id = '{$this->id}' 
                            LIMIT 1;";
        $this->dbc->update($query);
        $this->saveList($this->highlights, 'highlights');
        $this->saveList($this->features, 'features');
        
        $this->saveAvailable();
        
    }
    
    function saveAvailable(){
        $query = "DELETE FROM game_available WHERE ga_gameID = '{$this->id}';";
        $this->dbc->update($query);
        
        foreach($this->available as $key => $val){
            $query = "INSERT INTO game_available
                        (ga_gameID, ga_type) VALUES
                        ('{$this->id}', '$key');";
            $this->dbc->insert($query);
        }
    }
    
    function saveList($list, $type){
        $query = "DELETE FROM game_lists 
                    WHERE gl_gameID = '{$this->id}' 
                    AND gl_type = '$type';";
        $this->dbc->update($query);
        
        $query = "INSERT INTO game_lists 
                    (gl_gameID, gl_type, gl_text) VALUES 
                    ('{$this->id}', '$type', '$list');";
        $this->dbc->insert($query);
    }
    
    function getGames(){
        $query = "SELECT game_id, game_name, game_top, game_itunes, 
                    game_banner, game_published
                    FROM games 
                    ORDER BY game_name ASC;";
        $result= $this->dbc->query($query);
        
        return $result;
    }
    
    function getGame($game_id){
        $query = "SELECT *
                    FROM games 
                    WHERE game_id = '$game_id'
                    LIMIT 1;";
        $result= $this->dbc->query($query);
        $result= $this->dbc->uncleanArray($result[0]);
        
        $lists = $this->getLists($result['game_id']);
        $result['features']   = $lists['features'];
        $result['highlights'] = $lists['highlights'];
        
        $result['nl_features']   = implode("\r\n\r\n", $lists['features']);
        $result['nl_highlights'] = implode("\r\n\r\n", $lists['highlights']);
        
        $result['imgs'] = $this->gameImgs($game_id);
        
        $result['available'] = $this->getAvailable($game_id);
        
        return $result;
    }
    function getAvailable($game_id){
        $query = "SELECT * FROM game_available WHERE ga_gameID = '$game_id';";
        $result= $this->dbc->query($query);
        $avail = array();
        
        foreach($result as $r){
            $key = str_replace(' ', '_', $r['ga_type']);
            $avail[$key]['name'] = $r['ga_type'];
            $avail[$key]['on'] = true;
        }
        return $avail;
    }
    function gameImgs($game_id){
        $folder = $this->rootLocation.'uploads/game-imgs/'.$game_id;
        $dir = opendir($folder);
        while(false !== ($file = readdir($dir)) && $dir){
            if(strpos($file, 'jpg') || strpos($file, 'png') ){
                $files[] = $folder.'/'.$file;
            }
        }
        return $files;
    }
    
    function dlcImgs($dlc_id){
        $folder = $this->rootLocation.'uploads/dlc-imgs/'.$dlc_id;
        $dir = opendir($folder);
        while(false !== ($file = readdir($dir)) && $dir){
            if(strpos($file, 'jpg') || strpos($file, 'png') ){
                $files[] = $folder.'/'.$file;
            }
        }
        return $files;
    }
    
    function getLists($game_id){
        $query = "SELECT gl_text, gl_type
                    FROM game_lists
                    WHERE gl_gameID = '$game_id'
                    ORDER BY gl_id ASC;";
        $result= $this->dbc->query($query);
        $list = array();
        foreach($result as $r){
            $list[$r['gl_type']] = explode("\r\n\r\n", $r['gl_text']);
        }
        
        return $list;
    }
    
//    function saveDetails($text, $type, $game_id){
//        $list    = explode("\n", $text);
//        
//        foreach($list as $text){
//            $text = $this->dbc->clean($text);
//            $query = "INSERT INTO game_details
//                        (gd_gameID, gd_text, gd_type) VALUES
//                        ('$game_id', '$text', '$type')";
//            $this->dbc->insert($query);
//        }
//    }
    function defaultGame(){ //returns the empty array for a New Game entry
        $game = array(
            'game_id' => 'new',
            'game_name'=> '', 
            'game_top'=> '', 
            'game_itunes'=> '',
            'game_top'=> '', 
            'game_bottom'=> ''
        );
        return $game;
    }
    
    function addImg(){
        $file = $_FILES['img'];
        if($file['tmp_name']){
            $new_name = 'profile_pictures/'.$user_id.'.jpg';
            $location = '../'.$new_name;
            move_uploaded_file($file['tmp_name'], $location);

            $query = "UPDATE users SET user_profile_img = '$new_name' WHERE user_id = '$user_id' LIMIT 1;";
            $this->dbc->update($query);
        }
    }
    
    function addList($game_id, $type, $listItem){
        $query = "INSERT INTO  
                        game_lists 
                        (gl_gameID, gl_type, gl_text) VALUES
                        ('$game_id',  '$type',  '$listItem');";
        $this->dbc->insert($query);
    }
    
    function getBanners($dir_levels = 0){
        $query = "SELECT * FROM banners;";
        $result= $this->dbc->query($query);
        
        $active = 'active';
        foreach($result as $key => $r){
            $result[$key]['src'] = str_repeat('../', $dir_levels)."uploads/banners-home/{$r['b_id']}.jpg";
            $result[$key]['key'] = $key;
            $result[$key]['active'] = $active;
            $active = '';
        }
        return $result;
    }
    function updateBanner($id, $url){
        $query = "UPDATE banners SET b_url = '$url' WHERE b_id = '$id' LIMIT 1;";
        $this->dbc->update($query);
    }

    private function getdb() {
        $this->dbc = dbc::getInstance();
    }

}

$game = new Game();
$games= $game->getGames();