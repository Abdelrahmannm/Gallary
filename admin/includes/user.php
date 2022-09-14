<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class User extends Db_object
{
    protected static $db_table = 'users';
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name', 'user_image'];
    public $username, $id, $password, $first_name, $last_name, $user_image;
    public $upload_directory = 'images';
    public $image_placeholder = 'https://via.placeholder.com/150';


    public function upload_photo()
    {

        if (!empty($this->errors)) {
            return false;
        }
        if (empty($this->user_image) || empty($this->tmp_path)) {
            $this->errors[] = 'the file was not available';
            return false;
        }
        $target_path = SITEROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
        if (file_exists($target_path)) {
            $this->errors[] = "this file {$this->user_image} already exists";
            return false;
        }
        if (move_uploaded_file($this->tmp_path, $target_path)) {
            unset($this->tmp_path);
            return true;
        } else {
            $this->errors[] = "The file directory does not have permission ";
        }
    }
    public function image_path_and_placeholder()
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '$username' AND ";
        $sql .= "password ='$password' ";
        $result_array = self::find_by_query($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    public function ajax_save_user_image($user_image, $user_id)
    {
        global $database;
        $user_image = $database->escape_string($user_image);
        $user_id = $database->escape_string($user_id);
        $this->id = $user_id;
        $this->user_image = $user_image;

        $sql = "UPDATE " . self::$db_table . " SET user_image= '$this->user_image' ";
        $sql .= " WHERE id= $this->id ";
        $updated_image = $database->query($sql);
        echo $this->image_path_and_placeholder();
    }
    public function delete_photo()
    {
        if ($this->delete()) {
            $target_path = SITEROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->user_image;
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }
    public function photos()
    {
       return Photo::find_by_query("SELECT * FROM photos WHERE user_id=".$this->id);
    }
}
