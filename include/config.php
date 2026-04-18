<?php
/*******************************************/
/********* ARQUIVO DE CONFIGURAÇÃO *********/
/********** Versão: Zapping Wars ***********/
/*********** Por Caique Portela ************/
/******* (No jogo: Felipe Medeiros) ********/
/*******************************************/

// Timezone
date_default_timezone_set("America/Sao_Paulo");

// Configurações do banco de dados
$config['db_host'] = getenv('DB_HOST') ?: 'localhost'; // Host of your Database, probably Localhost
$config['db_user'] = getenv('DB_USER') ?: 'root'; // Database Username
$config['db_pw'] = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '123'; // Database Password
$config['db_name'] = getenv('DB_NAME_MAIN') ?: 'tribalwars_main'; // Database Name

// Acesso master ao painel administrativo
$config['master_user'] = 'Admin';
$config['master_pw'] = 'Zapping1234';

// Configurações especiais...
$config['name'] = 'Tribalwars';
$config['ano'] = '2023';
$config['cdn'] = 'global_cdn';
$config['forum'] = '#';
$config['support'] = 'zapping_support/';
$config['version'] = 'V0.1 DEVELOPMENT';
$config['prefix'] = '';

?>