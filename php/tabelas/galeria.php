<?php
    class galeria {
        private $id;
        private $localizacao;
        private $imagem;

        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }
        public function getLocalizacao()
        {
            return $this->localizacao;
        }
        public function setLocalizacao($localizacao)
        {
            $this->localizacao = $localizacao;
            return $this;
        }
        public function getImagem()
        {
            return $this->imagem;
        }
        public function setImagem($imagem)
        {
            $this->imagem = $imagem;
            return $this;
        }
    }
?>