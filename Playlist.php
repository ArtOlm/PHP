<?php 
    class playlist{
        var $playlist;
        var $name;
        public function __construct()
        {
            
        }
        public function set_playlist($playlist){
            $this->playlist = $playlist;
        }
        public function set_name($name){
            $this->name = $name;
        }
        public function get_playlist(){
            return $this->playlist;
        }
        public function get_name(){
            return $this->name;
        }
        public function add_song($song){
            $tmp_arr = unserialize($this->playlist);
            //add song
            $tmp_arr[$song] = $song;
            //update song
            $this->playlist = serialize($tmp_arr);
        }
        public function song_exists($song){
            $tmp_arr = unserialize($this->playlist);
            return array_key_exists($song,$tmp_arr);
        }
        public function remove_song($name){
            //get temp list to modify info
            $tmp_lst = unserialize($this->playlist);

            //remove song from playlsit
            unset($tmp_lst[$name]);

            //update data
            $updated_lst = serialize($tmp_lst);
            $this->playlist = $updated_lst;

        }
    }
?>