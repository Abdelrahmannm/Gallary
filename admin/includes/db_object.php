<?php

class Db_object
{
    protected static $db_table;
    protected static $db_table_fields;

    public $upload_errors_array = [
        UPLOAD_ERR_OK => ' There is no error, the file uploaded with success.', UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini', UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.', UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded', UPLOAD_ERR_NO_FILE => 'No file was uploaded.', UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.', UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.', UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
    ];
    public $errors = [];

    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = 'No file was uploaded';
            return false;
        } else if ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->size = $file['size'];
            $this->type = $file['type'];
            $this->tmp_path = $file['tmp_name'];
        }
    }
    public static function findAll()
    {
        return static::find_by_query("SELECT * FROM " . static::$db_table . " ");
    }
    public static function findById($id)
    {
        global $database;
        $result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    public static function find_by_query($sql)
    {
        global $database;
        $result = $database->query($sql);
        $the_object_array = [];
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = static::instantation($row);
        }
        return $the_object_array;
    }
    public static function instantation($record)
    {
        $calling_class = get_called_class();
        $theObject = new  $calling_class;
        foreach ($record as $attribute => $value) {
            if ($theObject->has_the_attribute($attribute)) {
                $theObject->$attribute = $value;
            }
        }
        return $theObject;
    }
    private function has_the_attribute($attribute)
    {
        $objectvars = get_object_vars($this);
        return array_key_exists($attribute, $objectvars);
    }
    public function create()
    {
        global $database;
        $properties = $this->clean();
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(',', array_keys($properties)) . ") ";
        $sql .= "VALUES('" .  implode("','", array_values($properties))  . "')";
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }
    public function update()
    {
        global $database;
        $properties = $this->clean();
        $properties_pairs = [];
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "$key = '$value'   ";
        }
        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(",", $properties_pairs);
        $sql .= " WHERE id= " . $database->escape_string($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= " WHERE id= " . $database->escape_string($this->id);
        $sql .= " LIMIT 1 ";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }
    protected function properties()
    {
        $properties = [];
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }
    protected function clean()
    {
        global $database;
        $clean_proprties = [];

        foreach ($this->properties() as $key => $value) {
            $clean_proprties[$key] = $database->escape_string($value);
        }
        return $clean_proprties;
    }
    public static function count_all(){
        global $database;
        $sql="SELECT COUNT(*) FROM ". static::$db_table;
        $result=$database->query($sql);
        $row=mysqli_fetch_array($result);
        return array_shift($row);
    }
}
