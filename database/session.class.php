<?php
  class Session {
    private array $messages;

    //-----------Construct----------------------------------------------------------------------------

    public function __construct() {
      session_start();

      if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = $this->generate_random_token();
      }

      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function generate_random_token() {
      return bin2hex(openssl_random_pseudo_bytes(32));
    }

    //-----------Login & Logout-----------------------------------------------------------------------

    public function isLoggedIn() : bool {
      return isset($_SESSION['id']);    
    }

    public function logout() {
      session_destroy();
    }

    //-----------Gets---------------------------------------------------------------------------------

    public function getId() : ?int {
      return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
    }

    /*public function getUsername() : ?string {
      return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function getEmail() : ?string {
      return isset($_SESSION['email']) ? $_SESSION['email'] : null;
    }

    public function getProfilePicture() : ?string {
      return isset($_SESSION['profilepicture']) ? $_SESSION['profilepicture'] : null;
    }*/  

    //-----------Sets-----------------------------------------------------------------------------------

    public function setId(int $id) {
      $_SESSION['id'] = $id;
    }

    /*public function setUsername(string $username) {
      $_SESSION['username'] = $username;
    }

    public function setName(string $name) {
      $_SESSION['name'] = $name;
    }

    public function setEmail(string $email) {
      $_SESSION['email'] = $email;
    }

    public function setProfilepicture(string $profilepicture) {
      $_SESSION['profilepicture'] = $profilepicture;
    }*/

    //-----------Messages----------------------------------------------------------------------------------

    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }
  }
?>