<?php

/**
 * Description of class
 *
 * @author mike
 */
class Article {

    public $id;
    public $dbc;

    function __construct() {
        if (!$this->dbc) {
            $this->getdb();
        }
    }
    
    function saveArticle($id, $type, $title, $forwarding_url, $date, $published, $content, $preview){
        if($id == 'new'){
            $query = "INSERT INTO articles () VALUES ();";
            $id = $this->dbc->insert($query);
        }
        
        $date = strtotime($date);
        if($date == 0){
            $date = '';
        }
        $query = "UPDATE articles SET
                    a_type = '$type',
                    a_title = '$title',
                    a_forwarding_url = '$forwarding_url',
                    a_url = '', 
                    a_date = '$date', 
                    a_published = '$published',
                    a_html = '$content', 
                    a_preview = '$preview'
                        WHERE a_id = '$id' LIMIT 1;";
        $this->dbc->update($query);
        
        $folder  = '../../uploads/articles/'.$id;
        uploadFile('img', $folder, 'article.jpg');
    }
    
    function getArticles($type, $limit = 100){
        $limit ? $limit = "ORDER BY a_id DESC LIMIT $limit" : $limit = '';
        $query = "SELECT * FROM articles
                    WHERE a_type = '$type' $limit";
        $result= $this->dbc->query($query);
        foreach($result as $key => $r){
            $result[$key] = $this->output($r);
        }
        return $result;
    }
    function output($array){
        $array['edit_title'] = ucwords('Edit: '.$array['a_title']);
        $editUrls = array(
            'news' => 'news.php?id=',
            'support' => 'support.php?id=',
            'troubleshooting' => 'troubleshooting.php?id=',
            'features' => 'features.php?id=',
            'press' => 'press.php?id='
        );
        if($array['a_date'] > 0){
            $array['date']   = strtoupper(date('M d, Y', $array['a_date']));
            $array['a_date'] = mdy($array['a_date']);
        }
        $array['a_short_title'] = $array['a_title'];
        $max = 46;
        if(strlen($array['a_title']) > $max){
            $array['a_short_title'] = substr($array['a_title'], 0, $max).'...';
        }
        $array['edit_url'] = $editUrls[$array['a_type']].$array['a_id'];
        $array['img'] = $this->articleImg($array['a_id']);
        return $array;
    }
    
    function getArticle($id, $type = false){
        $query = "SELECT * FROM articles
                    WHERE a_id = '$id'";
        $result= $this->dbc->query($query);
        $article = $result[0];
        if(!is_array($article)){
            $article = array(
                'a_id' => 'new',
                'a_published' => 0,
                'a_type' => $type, 
                'edit_title' => ucwords("New $type article")
            );
        }else{
            $result[$key] = $this->output($r);
        }
        $article['img'] = $this->articleImg($id);
        $article['a_date'] = mdy($article['a_date']);
        return $article;
    }
    
    function articleImg($id){
        $file = "uploads/articles/$id/article.jpg";
        if(file_exists($file)){
            $src = $file;
        }else{
            $src = "images/news.jpg"; 
        }
        return "<img src='{$src}'/>";
    }

    private function getdb() {
        $this->dbc = dbc::getInstance();
    }

}