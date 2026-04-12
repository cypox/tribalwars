<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
/* Configurações principais: */
$nome = ''; // Nome do jogo
$titulo = ' | Support'; // Título das páginas
$forum = 'http://.nl/forum/index.php'; // Fórum do servidor
$ano = '2023'; //Ano de início


// Confiuração do upload de arquivos:
$upload['file'] = 'uploads/'; // Pasta onde o arquivo vai ser salvo
$upload['size'] = 1024 * 1024 * 2; // Tamanho máximo do arquivo (em Bytes) | Padrão: 1024 * 1024 * 2 (2Mb)
$upload['extension'] = array('jpg', 'png', 'bmp', 'dib', 'gif', 'jpe', 'jpeg', 'jfif', 'tif', 'tiff'); // Array com as extensões permitidas
$upload['rename'] = true; // Renomear o arquivo? (Se true, o arquivo será salvo como: upload_data_hora_userid.extensão | Se false o nome irá permanecer)


// Footer links
$config['footer_1'] = '<a href="http://www..nl"" target="_blank">imperalis</a> - ';
/* Máximo: 10 links */
?>