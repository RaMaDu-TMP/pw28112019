<?php
    require_once 'enum_check.php';

    class DIA_SEMANA implements EnumCheck {
        
        private const SEG = 'SEG';
        private const TER = 'TER';
        private const QUA = 'QUA';
        private const QUI = 'QUI';
        private const SEX = 'SEX';
        private const SAB = 'SAB';
        private const DOM = 'DOM';

        static function validEnum($value) {
            return $value == DIA_SEMANA::SEG || $value == DIA_SEMANA::TER || $value == DIA_SEMANA::QUA || $value == DIA_SEMANA::QUI || $value == DIA_SEMANA::SEX || $value == DIA_SEMANA::SAB || $value == DIA_SEMANA::DOM;
        }

        static function values() {
            $values = array();
            
            $values['SEG'] = DIA_SEMANA::SEG;
            $values['TER'] = DIA_SEMANA::TER;
            $values['QUA'] = DIA_SEMANA::QUA;
            $values['QUI'] = DIA_SEMANA::QUI;
            $values['SEX'] = DIA_SEMANA::SEX;
            $values['SAB'] = DIA_SEMANA::SAB;
            $values['DOM'] = DIA_SEMANA::DOM;

            return $values;
        }
    }
?>