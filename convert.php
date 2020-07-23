<?php

//=========================================================================
// Esse código tem como finalidade transformar questões copiadas (CTRL + C)
// do exercício de uma UA do Sagah, em um arquivo .txt para importação no
// Moodle (importação no formato Aiken).
//=========================================================================

/*
* Arquivos de entrada e saída são carregados
*/
$arquivo = fopen('entrada.txt', 'r+');
$saida = fopen('saida.txt','a+');
/*
* Fim
*/

$lista = []; // Lista com a pergunta, alternativas e resposta
$fimPergunta = false; // A linha atual ainda é da pergunta?
$pergunta = []; // Lista para montar a pergunta a partir das linhas
$numeroPergunta = ["1)\r\n", "2)\r\n", "3)\r\n", "4)\r\n", "5)\r\n", "\r\n"];

while ($linha = fgets($arquivo)){ // Enquanto o ponteiro no arquivo de entrada não chegar ao fim

    if(!$fimPergunta){ // Verifica se a pergunta já acabou
        if($linha == "a)\r\n"){ // Se a linha atual for a), significa que acabaram as linhas da pergunta
            $lista[] = implode(' ',$pergunta)."\r\n"; // A pergunta formatada é inserida na lista final
            $fimPergunta = true;
        }else{
            if (!in_array($linha,$numeroPergunta)) { // Verifica se a linha atual está na lista, se estiver, significa que a linha atual não faz parte da pergunta final
                $pergunta[] = trim(preg_replace('/\s\s+/', ' ', $linha)); // Se a linha atual não estiver na lsita de controle, essa linha é adicionada na lista que irá se tornar a pergunta final
            }
        }
    }

    switch($linha) { // Verifica qual linha está sendo lida, e se ela é relevante para o processo
        case ("a)\r\n"):
            $input = 'A) '.fgets($arquivo);
            $lista[] = $input;
            break;
        case ("b)\r\n"):
            $input = 'B) '.fgets($arquivo);
            $lista[] = $input;
            break;
        case ("c)\r\n"):
            $input = 'C) '.fgets($arquivo);
            $lista[] = $input;
            break;
        case ("d)\r\n"):
            $input = 'D) '.fgets($arquivo);
            $lista[] = $input;
            break;
        case ("e)\r\n"):
            $input = 'E) '.fgets($arquivo);
            $lista[] = $input;
            break;
        case ("RESPOSTA CORRETA\r\n"): // Se a linha lida for "Resposta Correta", significa que a última alternativa inserida na lista é a resposta da questão
            $resposta = end($lista);
            $resposta = $resposta[0];
        default:
            break;
    }
    
}
$lista[] = 'ANSWER: '.$resposta."\r\n";  // Insere a resposta ao final da lista
print_r($lista);

/*
* Cria as linha no arquivo de saída
*/
foreach($lista as $linha){
    fputs($saida,$linha);
}
fputs($saida,"\r\n");
/*
* Fim
*/

/*
* Arquivos de entrada e saída são finalizados
*/
fclose($arquivo);
fclose($saida);
/*
* Fim
*/