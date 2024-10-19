<?php
    class agendamentos {
        private $svc_id;
        private $fk_unidade;
        private $servico;
        private $preco;
        private $dia;
        private $horario;
        private $fk_email;

        public function getSvc_id()
        {
            return $this->svc_id;
        }
        public function setSvc_id($svc_id)
        {
            $this->svc_id = $svc_id;
            return $this;
        }
        public function getFk_unidade()
        {
            return $this->fk_unidade;
        }
        public function setFk_unidade($fk_unidade)
        {
            $this->fk_unidade = $fk_unidade;
            return $this;
        }
        public function getServico()
        {
            return $this->servico;
        }
        public function setServico($servico)
        {
            $this->servico = $servico;
            return $this;
        }
        public function getPreco()
        {
            return $this->preco;
        }
        public function setPreco($preco)
        {
            $this->preco = $preco;
            return $this;
        }
        public function getDia()
        {
            return $this->dia;
        }
        public function setDia($dia)
        {
            $this->dia = $dia;
            return $this;
        }
        public function getHorario()
        {
            return $this->horario;
        }
        public function setHorario($horario)
        {
            $this->horario = $horario;
            return $this;
        }

        public function getFk_email()
        {
            return $this->fk_email;
        }
        public function setFk_email($fk_email)
        {
            $this->fk_email = $fk_email;
            return $this;
        }
    }

?>