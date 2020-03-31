<?php
/**
 * Plugin Name: Certificados
 * Description: Encontra certificado.
 * Plugin URI: http://dcc.ufmg.br/
 * Author: DCC
 * Version: 1.0.0
 * Author URI: http://dcc.ufmg.br/
*/

function change_template_include( $t ) {
      $url = explode( '/', $_SERVER['REQUEST_URI'] );
      $url = array_filter( $url );
      $url = array_pop( $url );
      if( $url == 'certificados' ) {
        $new = plugin_dir_path( __FILE__ ) . 'page-certificados.php' ;
        return $new;
        }

      return $t;
    }
add_filter( 'template_include', 'change_template_include',1, 1 );
function consulta_certificado($name){
  $lista = busca_certificado($name);
    echo "<div id='certificados_result'><table>";
  $folder = './wp_content/downloads/';
        if(sizeof($lista) > 0){
            echo '<h2>Clique no seu nome para download do certificado</h2> <br/>';    
            foreach ($lista as $chave => $valor){
                $line_number = substr($chave, 1);
                $path = get_site_url() . '/wp-content/downloads/' . $chave . '_certificados2020.pdf';

                echo  "    <td class='download_link'> <a href=\"".$path."\" target=_blank>".strtoupper($valor)."</a> </td></tr>";
                    }
            }
            else{

                    echo "<tr><td>Nenhum resultado encontrado para <b>".$name."</b>. <br/>Por favor entre em contato conosco: evcomp@dcc.ufmg.br</td></tr>";
            }


            echo "</table></div>";
}

function busca_certificado($nome){
  $path = plugin_dir_path( __FILE__ ) . '/certificados.csv';
  $handle = fopen($path, "r") or die ("Não foi possível abrir o arquivo: $folder$file");
  $nome = preg_replace('/\s+/', ' ',$nome); // substitui espaços duplos por simples
    $nome = strtolower($nome);
    $nome = remove_accents($nome);
  $nomes = preg_split('/[ ]/', $nome);
   while (($line = fgets($handle)) !== false) {

        $line = strtolower($line);
        $line = remove_accents($line);

        $row = array();
        $row = preg_split('/[;,]/', $line, 2);
        if (strpos($row[1], $nomes[0]) !== FALSE){
        $result[$row[0]] = $row[1];
    }
  }
        //print_r($result);
        $size_nomes = sizeof($nomes);

    for ($i = 1; $i < $size_nomes; $i++){

                foreach ($result as $chave => $value){
                        if (strpos($value, $nomes[$i]) !== FALSE){
                                $aux[$chave] = $value;
                        }
                }
                $size_aux = sizeof($aux);
                $size_result = sizeof($result);
                if(($size_aux > 0) and ($size_aux < $size_result)){
                        unset($result);
                        $result = $aux;
                        $aux = array();
                }
        }

        return $result;
}



?>