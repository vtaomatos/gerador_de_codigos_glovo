<?php

function GerarCodigoGlovo($entrada) {
    //Caminho para o arquivo de palavras
    $caminho = "/base/palavras.txt/";
    //Lê o arquivo, se não for possível retorna o erro
	if (!$entrada = file_get_contents($caminho)) {
	   return "O arquivo não foi encontrado no caminho indicado.";
	}
    //Retorna um array de uma string de palavras separadas por ","
    function explode_palavras($string) {
        $palavras = explode(",",$string);
        return $palavras;
    }
	$entrada = str_replace("<br>", "",str_replace("	", "",str_replace("\r", "",str_replace(" ", "",str_replace("\n", "",$entrada)))));
	$palavras = explode_palavras($entrada);
	    //cria uma cópia da var entrada
    $palavras_temporarias = $entrada;
    //Define valor default para as variaveis
    $saida = array();
    $saida2 = "";
    $f = 0;
    $i=0;
    //contador de elementos
    $qt_palavras = count($palavras);
    //Define uma quantidade de códigos a serem gerados
    $qt_codigos = ($qt_palavras*($qt_palavras-1)*($qt_palavras-2))/100;
    //Gera essa quantidade de códigos
    while($i < $qt_codigos) {
        //valores defaults para as var
        $j=0;
        $codigo = "";
        $qt_palavras = count($palavras);

        //Gera um numero randomico entre 2 e 3 para codigos de 2 ou de 3 palavras
        while($j<rand(2,3)) {
            //Escolhe randomicamente uma palavra no array;
            $rand = rand(0,$qt_palavras-1);
            $palavra = $palavras[$rand];
            //Retira a palavra da string de cópia;
            $palavras_temporarias = str_replace(",,",",",str_replace($palavra,"",$entrada));
            //Explode novamente as palavras, agora sem a palavra anterior;
            $palavras = explode_palavras($palavras_temporarias);
            //concatena em codigo
            $codigo .= $palavra;
            //decrementa a quantidade de palavras
            $qt_palavras--;
            //incrementa o contador
            $j++;
        }
        //Se o codigo se gerado não se repetir, guarda!
        if (!in_array($codigo, $saida)) {
            $saida[] = $codigo;
        }
        $i++;
    }
    return $saida;
}

print_r(GerarCodigoGlovo($arquivo));