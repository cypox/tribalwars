<?php
/*******************************************/
/********* ARQUIVO DE CONFIGURAÇÃO *********/
/********** Versão: Zapping Wars ***********/
/*********** Por Caique Portela ************/
/******* (No jogo: Felipe Medeiros) ********/
/*******************************************/

/**********************************************************

Recomenda-se que durante a execução da mundo não haja alterações nessa configuração,
Caso contrário, o total funcionamente do mundo não será garantido.
Velocidade do mundo e tropas estão sujeitos a modificações.

**********************************************************/ 

// Configurações do banco de dados
$config['db_host'] = getenv('DB_HOST') ?: 'localhost'; // Host of the Database
$config['db_user'] = getenv('DB_USER') ?: 'root'; // Database username
$config['db_pw'] = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '123'; // Database Password
$config['db_name'] = getenv('DB_NAME_WORLD') ?: 'tribalwars_world'; // Database name

// Zona de horário a ser seguido:
date_default_timezone_set("America/Sao_Paulo");

// Configurações especiais:
$config['name'] = 'Tribalwars'; // Game name :) Can be your own ;D
$config['ano'] = '2023'; // Year of server start
$config['cdn'] = '../global_cdn'; // Image / JS directory
$config['forum'] = ''; // Link to your forum
$config['version'] = 'V0.1 '; // Version number
$config['global_db'] = getenv('DB_NAME_MAIN') ?: 'tribalwars_main'; // DATABASE name! 
$config['world_name'] = 'World1'; // Name of the World :) 
$config['c_db_name'] = getenv('DB_NAME_WORLD') ?: 'tribalwars_world'; // Name of the world database



// Stuff down here are just configuration lines. Like the world speed, movement speed etc. 




// Senha da administração:
$config['master_pw'] = "testtest";

// Velocidade do jogo:
$config['speed'] = 100;

// Depois de quantas aldeias criadas, será adicionada uma aldeia barbára?
// Se definido "-1" não será criado aldeias barbáras automaticamente.
$config['count_create_left'] = 1;

// Quantas aldeias, um jogador deve ter pelo menos?
// Se por exemplo: agora o número for 5, então o jogador tem no início imediatamente cinco aldeias. 
// Se ele perder todas, ele recebe de volta 5!
// Não coloque o valor 0 (zero)!
// Não exagere com um número, por exemplo, "4000"
// Caso contrário o primeiro login pode demorar muito tempo
$config['min_villages'] = 1;

// NOTA: Esta configuração não terá efeito até que um reset na administração
// ou soft reset é realizado.
$config['map_incircle'] = 0;

//Qual o nome padrão da aldeia de barbáros?
$config['left_name'] = 'Barbarendorp';

// Quando alguem for criar uma aldeia, poderá escolher a direção?
// Use true ou false
$config['village_choose_direction'] = true;

// Defesa básica de cada aldeia.
$config['reason_defense'] = 50;

// O que se aplica a um fator em espiões? O valor "2" meios: 2x Se o defensor
// espião mais como o atacante, o atacante vai morrer todos os espiões
// (Proporção 2:1). Quando o "3", que é, em seguida, um rácio "3:1" e que meio
// O defensor, três vezes mais escuteiros precisa garantir que o atacante perde todos os escuteiros.
$config['factor_spy'] = 2;

// Em minutos após um ataque pode ser interrompido?
// NOTA: Este valor não depende da velocidade! Isto é, aos 10 minutos
// Horário de visitação estão em uma velocidade de jogo de 300 ainda 10 minutos!
$config['cancel_movement'] = 10;

// Velocidade das unidades. Quanto menor for o valor, mais lento será o
// Unidades. Velocidade normal tem o valor "1".
$config['movement_speed'] = 0.03;

// Deve ser moralidade ativa ou não?
// true => Moral é ativo
// false => Moral não está ativo
$config['moral_activ'] = true;

// Até que deve % declínio moral no máximo? O valor padrão é de 35%. como valor
// basta digitar o número sem o caractere "%"!
$config['min_moral'] = 35;

// Quanto consentimento, o consentimento por aumento de horas? O valor padrão
// é de 1! Quanto menor for o número, mais lento o consentimento do aumento! (por exemplo 0,5)
$config['agreement_per_hour'] = 0.1;

// Consentimento: Por quanto ele deve diminuir um pouco?
$config['agreement_min'] = 20;

// Consentimento: Por quanto ele deve cair para?
$config['agreement_max'] = 35;

// Quantos minutos de iniciante proteção aplica-se a uma nova aldeia? Se não houver nenhuma
// Deve dar iniciantes proteção, em seguida, digite o valor -1.
$config['noob_protection'] = 3600;

// A proteção de iniciante após ser noblado, vai ser diminuida de acordo com a % | MÁXIMO: 100
$config['ennobled_protection'] = 90;

// Quantidade de tempo que os concessionários precisam por campo?
$config['dealer_time'] = 5;

// Para o número de minutos, os comerciantes podem ser cancelado?
// NOTA: Este valor não depende da velocidade! Isto é, menos 5 minutos
// Horário de visitação estão em uma velocidade de jogo de 300 ainda 5 minutos!
$config['cancel_dealers'] = 5;

// AG estilo que deve ser usado?
// 0 => por aldeia pode ter como PLCs muitos são construídos tão elevado como o Adelshof é (S1)
// 1 => Como PLCs muitos são construídos de modo elevada é a soma de todas as propriedades nobres (SDS)
// 2 => moedas de ouro
$config['ag_style'] = 2;

// Estilo Farm:
// 0 => Se o nível de fazenda estão sendo desenvolvidos 30, portanto, ele está indo para 22.782 (S1).
// 1 => Quando a fazenda são de nível 30 é expandido, em seguida, ele vai para 24000 (SDS)
$config['bh_style'] = 1;

// Tribos podem ser criados?
// true => SIM
// false => NÃO
$config['create_ally'] = true;

// Tribos pode deixar / jogador demitido / jogador para ser convidado?
// true => SIM
// false => NÃO
$config['leave_ally'] = true;

// Tribos pode ser resolvido?
// true => SIM
// false => NÃO
$config['close_ally'] = true;

// Limite de membros em cada tribo
$config['members_ally'] = 50;

// Ele pode ser ajustado para que haja uma tribos x fixos, automaticamente para aqueles
// Jogadores são atribuídos. Durante o primeiro login, cada jogador é atribuído a um tronco!
// Recomenda-se que a dissolução se juntar, ... desativação das tribos! as tribos
// primeiro deve ser criado!
// Ativar?
// true => SIM
// false => NÃO
$config['auto_ally'] = false;

// Se esse valor é definido como verdadeiro, então o jogo não pode executar qualquer ação.
// Isto serve, por exemplo, se quaisquer preparações devem ser feitas
// e ninguém deve construir algo etc. Cepas pode ser criado de qualquer jeito!
$config['no_actions'] = false;

// Se esse valor é definido como verdadeiro, não há mais aldeias a ser criado. embora
// um jogador é enobrecido, ele não pode criar mais aldeias.
$config['not_more_villages'] = false;

// Deve haver um limite de IP?
$config['ip_control'] = false;

// IPs de rede que estão autorizados a acessar a Internet? Esta opção só é relevante se
// $config['ip_control'] está definido para "true".
$allow_ips[] = "192.168.0.1";
$allow_ips[] = "192.168.0.2";
$allow_ips[] = "192.168.0.3";
$allow_ips[] = "192.168.0.4";

// Se um ataque é considerado uma visita?
// true => SIM
// false => NÃO
$config['attack_visit'] = false;

// São abandonados aldeias para ser expandido automaticamente?
$config['build_destroy'] = 1;

// Configurações para arqueiros
// true = com
// false = sem
$config['archers'] = false;

// Definições para o dia / noite
// Assunto geral da aldeia e mapa
// De quando a quando de noite?
//Dados = horas cheias
$config['night_start'] = 20;
$config['night_end'] = 7;

// O que são batedores podem ver?
// Scouts pode (de acordo com a DS), veja:
// - Tropas (se pelo menos um olheiro sobreviveu)
// - Ressis (50% dos batedores sobreviver)
// - Edifício (70% de sobrevivência)
// - Tropas fora (90%)
// O que deve ser ativado / habilitado?
// 0 = Somente tropas
// 1 = forças Ressis
// 2 = tropas Ressis edifício,
// 3 = Ressis forças, edifícios, tropas fora
$config['spy_style'] = 3;

// Kosten van de Gold Coins...
$config['gold_coin_price'] = array(
	'wood' => 28000,
	'stone' => 30000,
	'iron' => 25000,
);

// Edifícios que iniciarão
$config['buildings_starting_by_one'] = array("main", "farm", "storage", "hide", "place");

// Barbaren dorpen uitbouwen...
$config['auto_build']['active'] = true;
$config['auto_build']['max_points'] = 400;
$config['auto_build']['grow_time'] = 0.5;

// O fator de quanto diminuir o edifício carneiros (Wall).
// fator para calcular como catapultas pode danificar edifícios (padrão: 195 e 1.115)
$config['catapult']['buildings']['base'] = 195;
$config['catapult']['buildings']['factor'] = 1.115;

// Ou. como firmemente o Wall-las a suportar
// fator de como a parede derrotas a catapulta (padrão: 300 e 1,09)
$config['catapult']['wall']['base'] = 300;
$config['catapult']['wall']['factor'] = 1.09;


// fator para calcular como carneiros podem danificar a parede (padrão: 1,8 e 1,205)
$config['ram']['buildings']['base'] = 1.8;
$config['ram']['buildings']['factor'] = 1.205;

// Ou. como firmemente o Wall-las a suportar
// fator de como a parede derrota o aríete (padrão: 4 e 1,09)
$config['ram']['wall']['base'] = 4;
$config['ram']['wall']['factor'] = 1.09;

// Igreja
$config['church'] = false;

// Einstellungen für Statue und Paladin
// 0 = ausgeschaltet
// 1 = aktiv, keine Gegenstände
// 2 = aktiv, einfache Gegenstände
// 3 = aktiv, verbesserte Gegenstände
$config['statue_style'] = 2;

// Welcher "Paladin" soll auf der Startseite erscheinen?
// 0 = Mann
// 1 = Frau
// 2 = Sarazene
$config['index_pala'] = 1;
?>