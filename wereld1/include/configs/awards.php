<?php
$cl_awards = new awards();

$cl_awards->desc_stage = array();
$cl_awards->desc_stage[0] = "dummy";
$cl_awards->desc_stage[1] = "Wood - Level 1";
$cl_awards->desc_stage[2] = "Bronze - Level 2";
$cl_awards->desc_stage[3] = "Silver - Level 3";
$cl_awards->desc_stage[4] = "Gold - Level 4";

// fixed medals
$cl_awards->add_awards("Points Champion","points");
$cl_awards->set_need(array("1" => "100", "2" => "5000", "3" => "100000", "4" => "10000000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Reach %*% points!");
$cl_awards->set_thisStage("You have already reached %*% points!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Reach a certain number of points to earn this medal.");

$cl_awards->add_awards("Top Rank","rank");
$cl_awards->set_need(array("1" => "1000", "2" => "100", "3" => "20", "4" => "1"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Reach the top %*% in this world!");
$cl_awards->set_thisStage("You reached the top %*% in this world!");
$cl_awards->set_type("fix_rank");
$cl_awards->set_description("Be in a certain overall ranking position.");

$cl_awards->add_awards("Robber","lad");
$cl_awards->set_need(array("1" => "500", "2" => "10000", "3" => "100000", "4" => "1000000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Loot %*% resources!");
$cl_awards->set_thisStage("You have already looted %*% resources!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Loot a certain amount of resources.");

$cl_awards->add_awards("Raider","saque");
$cl_awards->set_need(array("1" => "10", "2" => "100", "3" => "1000", "4" => "10000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Raid %*% villages!");
$cl_awards->set_thisStage("You have already raided %*% villages!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Raid a certain number of villages.");

$cl_awards->add_awards("Conqueror","conquer");
$cl_awards->set_need(array("1" => "5", "2" => "50", "3" => "500", "4" => "1000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Conquer %*% villages!");
$cl_awards->set_thisStage("You have already conquered %*% villages!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Earn this medal by conquering a certain number of villages.");

$cl_awards->add_awards("Leader","lider");
$cl_awards->set_need(array("1" => "10000", "2" => "100000", "3" => "1000000", "4" => "20000000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Destroy %*% enemy units!");
$cl_awards->set_thisStage("You have already destroyed %*% enemy units!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Destroy a certain number of enemy units.");

$cl_awards->add_awards("Hero's Death","hero");
$cl_awards->set_need(array("1" => "100", "2" => "1000", "3" => "10000", "4" => "100000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Lose %*% of your units while supporting allies!");
$cl_awards->set_thisStage("You have already lost %*% units while supporting your allies!");
$cl_awards->set_type("fix");
$cl_awards->set_description("This medal is earned by losing a certain number of units sent as support.");

$cl_awards->add_awards("Reserved Conquests","reserved");
$cl_awards->set_need(array("1" => "10", "2" => "50", "3" => "100", "4" => "1000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Conquer %*% reserved villages.");
$cl_awards->set_thisStage("You have already conquered %*% reserved villages!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Earn this medal by conquering reserved villages.");

$cl_awards->add_awards("Merchant","merkat");
$cl_awards->set_need(array("1" => "10", "2" => "100", "3" => "500", "4" => "1000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Trade %*% times through your market.");
$cl_awards->set_thisStage("You have already traded %*% times through your market!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Trade resources through the market.");

$cl_awards->add_awards("Loyal Friend","friends");
$cl_awards->set_need(array("1" => "10", "2" => "25", "3" => "50", "4" => "100"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Make %*% friendships.");
$cl_awards->set_thisStage("You have already made %*% friendships!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Make friends to earn this medal.");

$cl_awards->add_awards("Warlord","wars");
$cl_awards->set_need(array("1" => "10", "2" => "25", "3" => "100", "4" => "200"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Attack %*% players!");
$cl_awards->set_thisStage("You have already attacked %*% players!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Attack other players.");

$cl_awards->add_awards("Vandal","demolisher");
$cl_awards->set_need(array("1" => "25", "2" => "250", "3" => "2500", "4" => "10000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Destroy %*% building levels!");
$cl_awards->set_thisStage("You have already destroyed %*% building levels!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Destroy a certain number of building levels.");

$cl_awards->add_awards("Brothers in Arms","tribo");
$cl_awards->set_need(array("1" => "30", "2" => "60", "3" => "180", "4" => "360"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Stay %*% days in one tribe!");
$cl_awards->set_thisStage("You have been a member of your tribe for %*% days!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Stay in the same tribe for a certain period of time.");

$cl_awards->add_awards("Noble Faith","nobles_faith");
$cl_awards->set_need(array("1" => "15", "2" => "100", "3" => "350", "4" => "700"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Defeat %*% nobles!");
$cl_awards->set_thisStage("You have already defeated %*% nobles!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Number of nobles killed in battle.");

$cl_awards->add_awards("Master of the Battlefield","master_camp");
$cl_awards->set_need(array("1" => "25", "2" => "250", "3" => "1500", "4" => "2500"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Completely destroy %*% enemy armies!");
$cl_awards->set_thisStage("You have already completely destroyed %*% enemy armies!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Number of battles won; very small fights do not count.");

$cl_awards->add_awards("Reinforcements","refors");
$cl_awards->set_need(array("1" => "50", "2" => "100", "3" => "500", "4" => "3000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Support another player in %*% battles!");
$cl_awards->set_thisStage("You supported another player in %*% battles!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Number of battles in which your support troops were involved.");

$cl_awards->add_awards("Scout Defender","scout");
$cl_awards->set_need(array("1" => "25", "2" => "50", "3" => "250", "4" => "500"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Defend against %*% scout attacks!");
$cl_awards->set_thisStage("You have already defended against %*% scout attacks!");
$cl_awards->set_type("fix");
$cl_awards->set_description("Successfully defend against scout attacks.");

$cl_awards->add_awards("Self-Attack","aatack");
$cl_awards->set_need(array("1" => "10", "2" => "100", "3" => "1000", "4" => "10000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Attack yourself and lose more than %*% units in one battle.");
$cl_awards->set_thisStage("You attacked yourself and lost more than %*% units in one battle.");
$cl_awards->set_type("fix");
$cl_awards->set_description("This medal is earned by losing a certain number of units in self-attacks.");

$cl_awards->add_awards("Wealth in Gold","gold");
$cl_awards->set_need(array("1" => "50", "2" => "500", "3" => "5000", "4" => "50000"));
$cl_awards->set_maxstage("4");
$cl_awards->set_nextStage("Mint %*% gold coins!");
$cl_awards->set_thisStage("You have already minted %*% gold coins.");
$cl_awards->set_type("fix");
$cl_awards->set_description("Number of coins minted.");

// single-level fixed medals
$cl_awards->add_awards("Lucky Fellow","gluck");
$cl_awards->set_need(array("1" => "1"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("A village's loyalty must fall to 0 after your conquest!");
$cl_awards->set_thisStage("A village's loyalty fell to 0 because of one of your conquests!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("Earned through exceptional luck in attacks.");

$cl_awards->add_awards("Unlucky Fellow","bluck");
$cl_awards->set_need(array("1" => "1"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("A village's loyalty must fall to 1 because of your attack!");
$cl_awards->set_thisStage("A village's loyalty fell to 1 because of one of your attacks!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("A village's loyalty fell to 1 due to one of your attacks.");

$cl_awards->add_awards("Self-Conquest","aconquer");
$cl_awards->set_need(array("1" => "1"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("Conquer yourself!");
$cl_awards->set_thisStage("You conquered yourself!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("Earned by the player who manages to conquer their own village.");

$cl_awards->add_awards("Resurrection","resurrection");
$cl_awards->set_need(array("1" => "5"));
$cl_awards->set_maxstage("1");
$cl_awards->set_nextStage("Restart 5 times!");
$cl_awards->set_thisStage("You restarted 5 times!");
$cl_awards->set_type("fix_one");
$cl_awards->set_description("Restarted 5 times in the same world.");

// daily medals
?>