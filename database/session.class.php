<?php

    class Session {

        public function __construct() {
            session_start();
            if (!isset($_SESSION['csrf'])) {
                $_SESSION['csrf'] = $this->generate_random_token();
            }
        }

        public function isLoggedIn() : bool {
            return isset($_SESSION['id']);
        }

        public function logout() {
            session_destroy();
        }

        public function generate_random_token() {
            return bin2hex(openssl_random_pseudo_bytes(32));
        }
    }

?>