<?php
    class unidade {
        private $id;
        private $unidade;

        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }
        public function getUnidade()
        {
            return $this->unidade;
        }
        public function setUnidade($unidade)
        {
            $this->unidade = $unidade;
            return $this;
        }
    }
?>