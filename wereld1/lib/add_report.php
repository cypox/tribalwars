<?php
class add_report{
    function new_report($playerid){
		global $db;

		$db->query("UPDATE `users` SET `new_report`='1' WHERE `id`='".$playerid."'");
    }
    function support($from_player,$from_village,$from_villagename,$to_player,$to_playername,$to_village,$units,$time){
		global $db;

		if($to_player != "-1"){
			$title = parse($from_villagename." apoiou ".$to_playername.".");
		}else{
			$title = parse($from_villagename." apoiou (aldeia abandonada).");
		}
		if($to_player != "-1"){
			$db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`to_user`,`to_village`,`from_user`,`from_village`,`a_units`) VALUES ('".$title."','".$time."','support','support','".$to_player."','".$to_player."','".$to_village."','".$from_player."','".$from_village."','".$units."')");
		}
		if($from_player != "-1" && $from_player != $to_player){
			$db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`to_user`,`to_village`,`from_user`,`from_village`,`a_units`) VALUES ('".$title."','".$time."','support','support','".$from_player."','".$to_player."','".$to_village."','".$from_player."','".$from_village."','".$units."')");
		}
		$this->new_report($to_player);
		$this->new_report($from_player);
    }
    function attack($from_player,$from_playername,$from_village,$from_villagename,$to_player,$to_village,$to_villagename,$wins,$att_color,$def_color,$time,$a_units,$b_units,$c_units,$d_units,$e_units,$agreement,$ram,$catapult,$hives,$luck,$moral,$see_def_units){
		global $db;
		global $config;

		if($to_playername == ""){
			$to_playername = "Bárbaros";
		}

   	    $nobre = explode(';',$agreement);	
	    if($nobre[1] <= "0"){
			$cccc_c = "1";
		}

	    $see_def_units = (!$see_def_units) ? "0" : "1";
		$ex_agreement = explode(";", $agreement);
		if($ex_agreement['1'] <= 0){
			$title_att = parse($from_playername." (".$from_villagename.") conquista ".$to_villagename.".");
			$titleimage_att = "".$config['cdn']."/graphic/dots/".$att_color.".png";
			$title_def = parse($to_villagename." foi conquistada por ".$from_playername." (".$from_villagename.")");
			$titleimage_def = "".$config['cdn']."/graphic/dots/".$def_color.".png";
		}else{
			$title_att = parse($from_playername." (".$from_villagename.") ataca ".$to_villagename.".");
			$titleimage_att = "".$config['cdn']."/graphic/dots/".$att_color.".png";
			$title_def = parse($to_villagename." foi atacada por ".$from_playername." (".$from_villagename.")");
			$titleimage_def = "".$config['cdn']."/graphic/dots/".$def_color.".png";
		}

		if($from_player == $to_player){ 
			$sss = array_sum(explode(";",$b_units))+array_sum(explode(";",$d_units));
		}else{
			$hero = array_sum(explode(";",$d_units));
			if($hero >= 200){
				if($c_units == $d_units){
					$master_camp = "1";
				}
			}
		}
		$exploraa = explode(';',$a_units);
		$nobre_m = explode(';',$b_units);
		if($this->explora($a_units,$b_units) == false){
			if($exploraa["4"] >= 1){
				if($exploraa["4"] == $nobre_m["4"]){
					$exp_f = "1";
				}
			}
		}
		$catapultt = explode(';',$catapult);
		$c_total = $catapultt["0"]-$catapultt["1"];
	    $saque = explode(';',$hives);
		if($nobre[1] == "0"){
			$gluck = "1";
			$bluck = "0";
		}elseif($nobre[1] == "1"){
			$bluck = "1";
			$gluck = "0";
		}else{
			$bluck = "0";
			$gluck = "0";
		}

		if($from_player != '-1'){
		    $db->query("INSERT into reports (title,title_image,time,type,in_group,receiver_userid,to_user,to_village,from_user,from_village,a_units,b_units,c_units,d_units,e_units,wins,agreement,ram,catapult,hives,luck,moral,see_def_units) VALUES ('$title_att','$titleimage_att','$time','attack','attack','$from_player','$to_player','$to_village','$from_player','$from_village','$a_units','$b_units','$c_units','$d_units','$e_units','$wins','$agreement','$ram','$catapult','$hives','$luck','$moral','$see_def_units')");
			$this->new_report($from_player);
		}
		if($to_player != "-1" && $from_player != $to_player){
		    $db->query("INSERT into reports (title,title_image,time,type,in_group,receiver_userid,to_user,to_village,from_user,from_village,a_units,b_units,c_units,d_units,e_units,wins,agreement,ram,catapult,hives,luck,moral) VALUES ('$title_def','$titleimage_def','$time','attack','defense','$to_player','$to_player','$to_village','$from_player','$from_village','$a_units','$b_units','$c_units','$d_units','$e_units','$wins','$agreement','$ram','$catapult','$hives','$luck','$moral')");
			$this->new_report($to_player);
			//$this->wars($from_player,$to_player,$b_units,$d_units,$agreement,$to_village);
		}
		$this->get_medal($from_player,$saque['3'],"1",$c_total,$comand,"0",$master_camp,"0",$gluck,$bluck,$aconquer,"0","0",$cccc_c,$sss,"0","0");
 		$this->get_medal($to_player,"0","0","0","0",$nobre_m['11'],"0",$exp_f,"0","0","0","0","0","0","0","0","0");
    }
    function support_attack($from_player,$from_village,$from_villagename,$to_player,$to_village,$to_villagename,$color,$time,$a_units,$b_units){
		global $db;
		global $config;

		$title = parse("Seu apoio de ".$from_villagename." em ".$to_villagename." foi atacado.");
		$titleimage = "".$config['cdn']."/graphic/dots/".$color.".png";
		if($from_player != "-1"){
		    $db->query("INSERT into reports (title,title_image,time,type,in_group,receiver_userid,to_user,to_village,from_user,from_village,a_units,b_units) VALUES ('$title','$titleimage','$time','supportAttack','defense','$from_player','$to_player','$to_village','$from_player','$from_village','$a_units','$b_units')");
			$this->new_report($from_player);
			if($from_player != $to_player){
		 		$refors = "1";
		 	}
		 	$hero = array_sum(explode(";",$b_units));
		 	$this->get_medal($from_player,"0","0","0","0","0","0","0","0","0","0","0",$hero,"0","0","0","$refors");
		}
    }
    function sendRess($from_player,$from_village,$from_villagename,$to_player,$to_playername,$to_village,$wood,$stone,$iron,$time){
		global $db;

		$title = parse($from_villagename." forneceu ".$to_playername.".");
		$ress = $wood.";".$stone.";".$iron;

		if($from_player != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,to_village,from_user,from_village,hives) VALUES ('$title','$time','sendRess','trade','$from_player','$to_player','$to_village','$from_player','$from_village','$ress')");
		    $this->new_report($from_player);
		}
		if($to_player != "-1" && $from_player != $to_player){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,to_village,from_user,from_village,hives) VALUES ('$title','$time','sendRess','trade','$to_player','$to_player','$to_village','$from_player','$from_village','$ress')");
		    $this->new_report($to_player);
		}
    }
    function assume_offer($from_player,$from_playername,$from_village,$to_player,$to_playername,$to_village,$buy,$sell,$buy_ress,$sell_ress){
		global $db;

		$time = time();
		$title = parse("A oferta de ".$from_playername." foi aceita.");
		$ress = "$buy;$sell;$buy_ress;$sell_ress";
		if($from_player != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,to_village,from_user,from_village,hives) VALUES ('$title','$time','offer','trade','$to_player','$to_player','$to_village','$from_player','$from_village','$ress')");
		    $this->new_report($from_player);
		}
		$title = parse($to_playername." aceitou sua oferta.");
		if($to_player != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,to_village,from_user,from_village,hives) VALUES ('$title','$time','offer','trade','$from_player','$to_player','$to_village','$from_player','$from_village','$ress')");
		    $this->new_report($to_player);
		}
    }
    function ally_invite($from_username,$from_userid,$to_userid,$ally,$allyname){
		global $db;

		$time = time();
		$title = parse($from_username." lhe convidou para à tribo '".$allyname."'.");

		if($to_userid != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,from_user,ally,allyname) VALUES ('$title','$time','ally_invite','other','$to_userid','$to_userid','$from_userid','$ally','$allyname')");
		    $this->new_report($to_userid);
		}
    }
    function ally_cancel_invite($from_userid,$to_userid,$ally,$allyname){
		global $db;

		$time = time();
		$title = parse("O convite para à tribo ".$allyname." foi cancelado.");

		if($to_userid != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,from_user,ally,allyname) VALUES ('$title','$time','ally_cancel_invite','other','$to_userid','$to_userid','$from_userid','$ally','$allyname')");
		    $this->new_report($to_userid);
		}
    }
    function ally_close($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." debandou sua tribo.");

		if($to_userid != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,from_username,from_user) VALUES ('$title','$time','ally_clear','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
    }
    function accept_uv($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." aceitou a substituição de férias.");

		if($to_userid != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,from_username,from_user) VALUES ('$title','$time','accept_uv','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
    }
    function inquires_uv($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." solicitou uma substituição de férias.");

		if($to_userid != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,from_username,from_user) VALUES			('$title','$time','inquires_uv','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
    }
    function reject_uv($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." rejeitou a substituição de férias.");

		if($to_userid != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,from_username,from_user) VALUES ('$title','$time','reject_uv','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
    }
    function cancel_uv($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." cacelou a substituição de férias.");

		if($to_userid != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,from_username,from_user) VALUES ('$title','$time','cancel_uv','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
    }
    function attack_ally_visit($from_player,$from_playername,$to_player,$to_village,$to_villagename){
		global $db;

		$title = parse($from_playername." visitou ".$to_villagename.".");
		$time = time();

		if($from_player != "-1"){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,to_village,from_user) VALUES ('$title','$time','attack_ally_visit_att','attack','$from_player','$to_player','$to_village','$from_player')");
		}
		if($to_player != "-1" && $from_player != $to_player){
		    $db->query("INSERT into reports (title,time,type,in_group,receiver_userid,to_user,to_village,from_user) VALUES ('$title','$time','attack_ally_visit_def','defense','$to_player','$to_player','$to_village','$from_player')");
		}
		$this->new_report($to_player);
		$this->new_report($from_player);
    }
	function add_buddy($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." deseja adicionar você em sua lista de amigos.");

		if($to_userid != "-1"){
		    $db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`from_username`,`from_user`) VALUES ('$title','$time','invite_friend','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
	}
	function delete_buddy($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." removeu você de sua lista de amigos.");

		if($to_userid != "-1"){
		    $db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`from_username`,`from_user`) VALUES ('$title','$time','delete_friend','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
	}
	function cancel_buddy($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." cancelou o pedido de amizade.");

		if($to_userid != "-1"){
		    $db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`from_username`,`from_user`) VALUES ('$title','$time','cancel_friend','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
	}
	function approve_buddy($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." aceitou seu pedido de amizade.");

		if($to_userid != "-1"){
		    $db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`from_username`,`from_user`) VALUES ('$title','$time','approve_friend','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
	}
	function reject_buddy($from_username,$from_userid,$to_userid){
		global $db;

		$time = time();
		$title = parse(entparse($from_username)." rejeitou seu pedido de amizade.");

		if($to_userid != "-1"){
		    $db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`from_username`,`from_user`) VALUES ('$title','$time','reject_friend','other','$to_userid','$from_username','$from_userid')");
		    $this->new_report($to_userid);
		}
	}
	function explora($a_units,$b_units){
		global $cl_units;

		$bb = explode(';',$a_units);
		$dd = explode(';',$b_units);

		$count= "-1";
		$spya = "0";
		$spyb = "0";
		foreach($cl_units->get_array("dbname") as $name=>$dbname){
			$count++;
			if($dbname == "unit_spy"){
			   if($bb[$count] != $dd[$count]){
			       $spy = true;
		       }else{
				   $spy = false;
			   }
			}else{
			    $spya += $bb[$count];
		        $spyb += $dd[$count];
			}
		}	 			 
		if($spya == $spyb){
			if($spy){
				return true;
			}
		}else{
			return false;
		}
	}
	function get_medal($playerid,$lad,$saque,$demolish,$wars,$nobre,$master_camp,$scout,$gluck,$bluck,$aconquer,$merkat,$hero,$conquer,$aatack,$reserva,$refors){
		global $db;
		if($wars){
			$comand = $wars;
		}
  		$db->query("UPDATE medal SET lad=lad+'$lad',saque=saque+'$saque',demolisher=demolisher+'$demolish',wars=wars+'$comand',nobles_faith=nobles_faith+'$nobre',master_camp=master_camp+'$master_camp',scout=scout+'$scout',gluck=gluck+'$gluck',bluck=bluck+'$bluck',aconquer=aconquer+'$aconquer',hero=hero+'$hero',conquer=conquer+'$conquer',aatack=aatack+'$aatack',reserved=reserved+'$reserva',refors=refors+'$refors' WHERE userid='".$playerid."'");
	} 
	
	
	function new_knight_item($userid, $item){
		global $db;

		$time = time();
		$title = parse("O paladino encontrou um item");

		if($to_userid != "-1"){
		    $db->query("INSERT INTO `reports` (`title`,`time`,`type`,`message`,`in_group`,`receiver_userid`,`from_user`) VALUES ('$title','$time','knight_item','$item','other','$userid','0')");
		    $this->new_report($userid);
		}
    }		
}

?>