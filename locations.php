<?php
class Location {
    private $id;
    private $name;
    private $address;
    private $email;
    private $phone;
    private $menu;
    private $latitude;
    private $longitude;
    private $conn;
    private $tableName = "form_data";

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    public function setAddress($address) { $this->address = $address; }
    public function getAddress() { return $this->address; }

    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }

    public function setLatitude($latitude) { $this->latitude = $latitude; }
    public function getLatitude() { return $this->latitude; }

    public function setLongitude($longitude) { $this->longitude = $longitude; }
    public function getLongitude() { return $this->longitude; }

    public function setPhone($phone) { $this->phone = $phone; }
    public function getPhone() { return $this->phone; }

    public function setMenu($menu) { $this->menu = $menu; }
    public function getMenu() { return $this->menu; }

    public function __construct() {
        require_once('dbconnection.php');
        $conn = new DbConnect;
        $this->conn = $conn->connect();
    }

    public function getLatLng() {
        try {
            $sql = "SELECT latitude, longitude FROM $this->tableName";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>