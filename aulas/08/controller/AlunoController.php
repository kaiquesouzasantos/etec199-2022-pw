<?php
    class AlunoController{

        function validaCPF($cpf){
            $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
            if (strlen($cpf) != 11) {return false;}	
            $digitos = substr($cpf, 0, 9);
    
            if(
                $digitos == "111111111" && $digitos == "222222222" && $digitos == "333333333"
                && $digitos == "444444444" && $digitos == "5555555555" && $digitos == "666666666"
                && $digitos == "777777777" && $digitos == "888888888" && $digitos == "999999999"
            ) return false;
    
            function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
                for($i = 0; $i < strlen($digitos); $i++) {
                    $soma_digitos = $soma_digitos + ($digitos[$i] * $posicoes);                    
                    $posicoes--;
                }
        
                $soma_digitos = $soma_digitos % 11;
        
                if ($soma_digitos < 2) {$soma_digitos = 0;
                } else {$soma_digitos = 11 - $soma_digitos;}
    
                return $digitos . $soma_digitos;            
            }
    
            $novo_cpf = calc_digitos_posicoes($digitos );
            $novo_cpf = calc_digitos_posicoes($novo_cpf, 11 );
            
            return $novo_cpf === $cpf;
        }

        function getDestino(){
            $destino = 'img/'.$_FILES['imgFoto']['name'];
            $arquivo_tmp = $_FILES['imgFoto']['tmp_name'];
            move_uploaded_file($arquivo_tmp, $destino); 
    
            return $destino;
        }
    }
?>