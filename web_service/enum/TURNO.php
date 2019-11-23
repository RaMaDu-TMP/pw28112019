<?php
    require_once 'enum_check.php';

    class TURNO implements EnumCheck {
        
        private const MATUTINO = 'MATUTINO';
        private const VESPERTINO = 'VESPERTINO';
        private const NOTURNO = 'NOTURNO';

        static function validEnum($value) {
            return $value == TURNO::MATUTINO || $value == TURNO::VESPERTINO || $value == TURNO::NOTURNO;
        }

        static function values() {
            $values = array();
            
            $values['MATUTINO'] = TURNO::MATUTINO;
            $values['VESPERTINO'] = TURNO::VESPERTINO;
            $values['NOTURNO'] = TURNO::NOTURNO;

            return $values;
        }
    }
?>