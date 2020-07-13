<?php

//=========================================================================
// Esse código tem como finalidade transformar questões copiadas (CTRL + C)
// do exercício de uma UA do Sagah, em um arquivo .txt para importação no
// Moodle (importação no formato Aiken).
//=========================================================================

/*
* Arquivos de entrada e saída são carregados
*/
$arquivo = fopen('arquivo.txt', 'r+');
$saida = fopen('saida.txt','a+');
/*
* Fim
*/

$lista = []; // Lista com a pergunta, alternativas e resposta
$linha = fgets($arquivo); // Recupera a primeira linha do arquivo de entrada (a pergunta)
$lista[] = $linha; // Insere a pergunta na lista

while ($linha = fgets($arquivo)){ // Enquanto o ponteiro no arquivo de entrada não chegar ao fim

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
        case ("RESPOSTA CORRETA\r\n"): // Se a linha lida for "Resposta Correta", significa que a úiltima alternativa inserida na lista é a resposta da questão
            $resposta = end($lista);
            $resposta = $resposta[0];
        default:
            break;
    }
$lista[] = 'ANSWER: '.$resposta."\r\n";  // Insere a resposta ao final da lista
}

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