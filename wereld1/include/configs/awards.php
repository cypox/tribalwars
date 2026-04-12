<?php
$cl_awards = new awards();

$cl_awards->desc_stage = array();
$cl_awards->desc_stage[0] = "dummy";
$cl_awards->desc_stage[1] = "Hout - Level 1";
$cl_awards->desc_stage[2] = "Brons - Level 2";
$cl_awards->desc_stage[3] = "Zilver - Level 3";
$cl_awards->desc_stage[4] = "Goud - Level 4";

//medalhas Fixas
$cl_awards->add_awards("Campeao de Pontuacao","points");
$cl_awards->set_need(array("1" => "100", "2" => "5000", "3" => "100000", "4" => "10000000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Chegar a %*% pontos!");
$cl_awards->set_thisStage("Voce já chegou a %*% pontos!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario atingir uma certa pontuaçao para poder ganhar esta medalha.");

$cl_awards->add_awards("Líder em pontos","rank");
$cl_awards->set_need(array("1" => "1000", "2" => "100", "3" => "20", "4" => "1"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Chegue ao top %*% neste mundo!");
$cl_awards->set_thisStage("Voce chegou no top %*% neste mundo!");
$cl_awards->set_type("fix_rank");
$cl_awards->set_description("E necessario estar em uma determinada classificaçao na classificaçao geral.");

$cl_awards->add_awards("Ladrao","lad");
$cl_awards->set_need(array("1" => "500", "2" => "10000", "3" => "100000", "4" => "1000000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Roube %*% recursos!");
$cl_awards->set_thisStage("Voce já roubou %*% recursos!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario saquear um certo número de recursos.");

$cl_awards->add_awards("Saqueador","saque");
$cl_awards->set_need(array("1" => "10", "2" => "100", "3" => "1000", "4" => "10000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Saqueie %*% aldeias!");
$cl_awards->set_thisStage("Voce já saqueou %*% aldeias!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario saquear um certo número de aldeias.");

$cl_awards->add_awards("Conquista","conquer");
$cl_awards->set_need(array("1" => "5", "2" => "50", "3" => "500", "4" => "1000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Conquiste %*% aldeias!");
$cl_awards->set_thisStage("Voce já conquistou %*% aldeias!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Medalha ganha quando conquista uma certa quantidade de aldeias.");

$cl_awards->add_awards("Lider","lider");
$cl_awards->set_need(array("1" => "10000", "2" => "100000", "3" => "1000000", "4" => "20000000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Destrua %*% unidades inimigas!");
$cl_awards->set_thisStage("Voce já destruiu %*% unidades inimigas!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario abater um certo número de unidades inimigas.");

$cl_awards->add_awards("Morte de um Heroi","hero");
$cl_awards->set_need(array("1" => "100", "2" => "1000", "3" => "10000", "4" => "100000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Perca %*% de suas unidades enquanto apoia seus aliados!");
$cl_awards->set_thisStage("Voce já perdeu %*% unidades apoiando seus aliados!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Esta medalha é ganha quando perde um certo número de unidades que foram enviadas por você em apoio.");

$cl_awards->add_awards("Reservas Conquistadas","reserved");
$cl_awards->set_need(array("1" => "10", "2" => "50", "3" => "100", "4" => "1000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Conquiste %*% aldeias reservadas.");
$cl_awards->set_thisStage("Voce ja conquistou %*% aldeias reservadas!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Ganha esta medalha ao conquistar aldeias reservadas.");

$cl_awards->add_awards("Mercador","merkat");
$cl_awards->set_need(array("1" => "10", "2" => "100", "3" => "500", "4" => "1000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Negocie %*% vezes através do seu mercado.");
$cl_awards->set_thisStage("Voce já negociou %*% através do seu mercado!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario negociar recursos através do mercado.");

$cl_awards->add_awards("Amigo fiel","friends");
$cl_awards->set_need(array("1" => "10", "2" => "25", "3" => "50", "4" => "100"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Faça %*% amizades.");
$cl_awards->set_thisStage("Voce já fez %*% amizades!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Faça amizades para obter esta medalha.");

$cl_awards->add_awards("Comandante de Guerra","wars");
$cl_awards->set_need(array("1" => "10", "2" => "25", "3" => "100", "4" => "200"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Ataque %*% jogadores!");
$cl_awards->set_thisStage("Voce já atacou %*% jogadores!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario atacar jogadores.");

$cl_awards->add_awards("Vândalo","demolisher");
$cl_awards->set_need(array("1" => "25", "2" => "250", "3" => "2500", "4" => "10000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Destrua %*% niveis de edifícios!");
$cl_awards->set_thisStage("Voce já destruiu %*% níveis de edifícios!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario destruir uma quantidade de níveis de edifícios.");

$cl_awards->add_awards("Irmaos de guerra","tribo");
$cl_awards->set_need(array("1" => "30", "2" => "60", "3" => "180", "4" => "360"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Permaneça %*% dias em uma tribo!");
$cl_awards->set_thisStage("Voce é membro de sua tribo a %*% dias!");
$cl_awards->set_type("fix");
$cl_awards->set_description("E necessario passar um determinado período de dias na mesma tribo.");

$cl_awards->add_awards("Fé da Nobreza","nobles_faith");
$cl_awards->set_need(array("1" => "15", "2" => "100", "3" => "350", "4" => "700"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Derrote %*% nobres!");
$cl_awards->set_thisStage("Voce já derrotou %*% nobres!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Número de nobres mortos em batalhas.");

$cl_awards->add_awards("Mestre do Campo de Batalha","master_camp");
$cl_awards->set_need(array("1" => "25", "2" => "250", "3" => "1500", "4" => "2500"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Destruir completamente %*% exércitos inimigos!");
$cl_awards->set_thisStage("Voce já destruiu completamente %*% exércitos inimigos!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Número de batalhas vencidas, pequenas batalhas nao serao contadas!");

$cl_awards->add_awards("Reforços","refors");
$cl_awards->set_need(array("1" => "50", "2" => "100", "3" => "500", "4" => "3000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Apoie outro jogador em %*% batalhas!");
$cl_awards->set_thisStage("Apoiou outro jogador em %*% batalhas!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Número de batalhas que estiveram envolvidos seus apoios.");

$cl_awards->add_awards("Explorador","scout");
$cl_awards->set_need(array("1" => "25", "2" => "50", "3" => "250", "4" => "500"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Defender-se de %*% ataques de exploradores!");
$cl_awards->set_thisStage("Voce já defendeu-se de %*% ataques de exploradores!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Defenda-se com sucesso de ataques de exploradores.");

$cl_awards->add_awards("Auto-ataque","aatack");
$cl_awards->set_need(array("1" => "10", "2" => "100", "3" => "1000", "4" => "10000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Atacou a si mesmo e perdeu mais de %*% unidades em uma batalha.");
$cl_awards->set_thisStage("Atacou a si mesmo e perdeu mais de %*% unidades em uma batalha.");
$cl_awards->set_type("fix");
$cl_awards->set_description("Ganha esta medalha o jogador que perder um certo número de unidades devido aos seus ataques (auto-ataques)!");

$cl_awards->add_awards("A riqueza vem em ouro","gold");
$cl_awards->set_need(array("1" => "50", "2" => "500", "3" => "5000", "4" => "50000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Cunhe %*% moedas de ouro!");
$cl_awards->set_thisStage("Voce já cunhou %*% moedas de ouro.");
$cl_awards->set_type("fix");
$cl_awards->set_description("Número de moedas cunhadas.");

// medalhas fixas mais com apenas um nivel
$cl_awards->add_awards("Cara de sorte","gluck");
$cl_awards->set_need(array("1" => "1"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("A lealdade de uma aldeia deve ser 0 após você conquistá-la!");
$cl_awards->set_thisStage("A lealdade de uma aldeia caiu para 0 devido a uma de suas conquistas!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("Quando se tem sorte a fazer ataques.");

$cl_awards->add_awards("Cara sem sorte","bluck");
$cl_awards->set_need(array("1" => "1"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("A lealdade de uma aldeia deve cair para 1 devido ao seu ataque!");
$cl_awards->set_thisStage("A lealdade de uma aldeia caiu para 1 devido a um dos seus ataques!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("A Lealdade de uma aldeia caiu para 1 devido a um ataque seu!");

$cl_awards->add_awards("Alto-conquista","aconquer");
$cl_awards->set_need(array("1" => "1"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("Conquistar a si mesmo!");
$cl_awards->set_thisStage("Conquistou-se a si mesmo!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("Ganha esta medalha o jogador que se conquistar a ele mesmo.");

$cl_awards->add_awards("Ressurreiçao","resurrection");
$cl_awards->set_need(array("1" => "5"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("Recomece 5 vezes!");
$cl_awards->set_thisStage("Recomeçou 5 vezes!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("Recomeçou 5 vezes no mesmo mundo.");

//Medalhas Diarias 
?>