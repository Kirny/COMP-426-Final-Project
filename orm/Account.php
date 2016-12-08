<?php

class Account{
  private $id;
  private $balance;
  private $user_id;

  public static function connect(){
      return new mysqli("classroom.cs.unc.edu",
                        "dyj",
                        "dudwp524",
                        "dyjdb");
  }
  public static function create($balance, $user_id) {
    $mysqli = Account::connect();

    $result = $mysqli->query("insert into Account values (0, " .
			                       $balance . ", " .
			                       $user_id . ")");

    if ($result) {
      $id = $mysqli->insert_id;
      return new Account($id, $balance, $user_id);
    }
    return null;
  }

  public static function findByID($id){
    $mysqli = Account::connect();

    $result = $mysqli->query("SELECT * FROM Account WHERE id = " . $id);

    if($result){
      if($result->num_rows == 0){
        return null;
      }
    $account_info = $result->fetch_array();

    return new Account(intval($account_info['id']),
                       floatval($account_info['balance']),
                       intval($account_info['user_id']));
    }
    return null;
  }

  public static function getAllIDs(){
    $mysqli = Account::connect();

    $result = $mysqli->query("SELECT id FROM Account");
    $id_array = array();

    if ($result) {
      while ($next_row = $result -> fetch_array()){
          $id_array[] = intval($next_row['id']);
      }
    }
    return $id_array;
  }

  private function __construct($id, $balance, $user_id) {
      $this->id = $id;
      $this->balance = $balance;
      $this->user_id = $user_id;
  }

  public function getID(){
    return $this->id;
  }
  public function getBalance(){
    return $this->balance;
  }
  public function getUserID(){
    return $this->user_id;
  }

  public function setBalance($balance){
    $this->balance = $balance;
    return $this->update();
  }

  private function update(){
    $mysqli = Account::connect();

    $result = $mysqli->query("update Account set " .
                             "balance=" . $this->balance .
                             " where id=" . $this->id);
    return $result;
  }

  public function delete(){
    $mysqli = Account::connect();
    $mysqli->query("delete from Account where id = " . $this->id);
  }

  public function getJSON() {
    $json_obj = array('id' => $this->id,
                      'balance' => $this->balance,
                      'user_id' => $this->user_id);
    return json_encode($json_obj);
  }


}
?>
