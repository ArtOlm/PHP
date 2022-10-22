<?php
    //helper fucntion to check users inputs do not have whitespace
    function containsWhiteSpace($str){
        $length = strlen($str);
        for($i = 0; $i < $length;$i++){
            if($str[$i] == ' '){
                return true;
            }
        }
        return false;
    }
    //function helps update data, this is used everytime an action is done by the user
    function update_file_info($username,$ser_data){
        $file = fopen('writable/' . $username . '.txt',"w");
        fwrite($file,$ser_data);
        fclose($file);

    }
    class user{
        var $username;
        var $password;
        var $libarary;
        var $playlists;
        public function __construct()
         {  $base_array = array("b");
            $this->library = serialize($base_array);
       
        }
        public function get_username(){
            return $this->username;
        }
        public function get_password(){
            return $this->password;
        }
        public function set_username($username){
            $this->username = $username;
        }
        public function set_password($password){
            $this->password = $password;
        }
        public function add_song($song_name){
            $this->libarary[$song_name] = null;
        }
        public function get_library(){
            return $this->libarary;
        }
        public function set_library($libarary){
            $this->libarary = $libarary;
        }
        public function set_playlists($playlist){
            $this->playlists = $playlist;
        }
        public function get_playlists(){
            return $this->playlists;
        }
        public function add_playlist($ser_plylst){
            $temp_plylst = unserialize($ser_plylst);
            $temp_plylsts = unserialize($this->playlists);
            $temp_plylsts['a' . $temp_plylst->get_name()] = $ser_plylst;
            $this->playlists = serialize($temp_plylsts);
        }
    }
?>