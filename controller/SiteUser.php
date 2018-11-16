<?php
    // Didn't want to save whole user row in session.
    // A new class wasn't really necessary, but ¯\_(ツ)_/¯
    class SiteUser {
        private $id;
        private $type;

        function __construct($id, $type)
        {
            $this->id = $id;
            $this->type = $type;
        }

        function getId()
        {
            return $this->id;
        }

        function getType()
        {
            return $this->type;
        }
    }
?>
