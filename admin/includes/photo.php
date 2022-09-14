<?php

class Photo extends Db_object
{

  protected static $db_table = 'photos';
  protected static $db_table_fields = ['id', 'title', 'caption', 'decription', 'filename','altenate_text','type', 'size','user_id'];
  public $id, $title, $decription, $filename, $type, $size ,$caption , $altenate_text , $user_id;
  public $tmp_path;
  public $upload_directory = 'images';
  public $errors = [];
  public $upload_errors_array = [
    UPLOAD_ERR_OK => ' There is no error, the file uploaded with success.', UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini', UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.', UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded', UPLOAD_ERR_NO_FILE => 'No file was uploaded.', UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.', UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.', UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
  ];

  public function set_file($file)
  {
    if (empty($file) || !$file || !is_array($file)) {
      $this->errors[] = 'No file was uploaded';
      return false;
    } else if ($file['error'] != 0) {
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;
    } else {
      $this->filename = basename($file['name']);
      $this->size = $file['size'];
      $this->type = $file['type'];
      $this->tmp_path = $file['tmp_name'];
    }
  }
  public function save_photo_and_file()
  {
    if ($this->id) {
      $this->update();
    } else {
      if (!empty($this->errors)) {
        return false;
      }
      if (empty($this->filename) || empty($this->tmp_path)) {
        $this->errors[] = 'the file was not available';
        return false;
      }
      $target_path = SITEROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
      if (file_exists($target_path)) {
        $this->errors[] = "this file {$this->filename} already exists";
        return false;
      }
      if (move_uploaded_file($this->tmp_path, $target_path)) {
        if ($this->create()) {
          unset($this->tmp_path);
          return true;
        }
      } else {
        $this->errors[] = "The file directory does not have permission ";
      }
    }
  }
  public function picture_path()
  {
    return $this->upload_directory . DS . $this->filename;
  }
  public function delete_photo()
  {
    if ($this->delete()) {

      $target_path = SITEROOT . DS . "admin" . DS . $this->picture_path();
      return unlink($target_path) ? true : false;
    }
    else{
      return false;
    }
  }
  public static function display_sidebar_data($photo_id){
    $photo = Photo::findById($photo_id);
    $output="<a class='thumbnail' data-toggle='modal' data-target='#photo-library' href='#'><img width=500 height=200 src=".$photo->picture_path()."  alt=''></a>";
    $output.="<p>$photo->filename</p>";
    $output.="<p>$photo->type</p>";
    $output.="<p>$photo->size</p>";

    echo $output;

  }


}
