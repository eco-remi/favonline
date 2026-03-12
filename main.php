<?php	
				/* Affichage des récents
			$requete= "Select * from fav where note>=0 order by note desc, id desc Limit 20";	
			$reponse = mysql_query($requete,$id) or die(mysql_error());
			if($reponse){
				echo '<div class="block_link">';
				echo '<h3>Récent</h3>';
				while($donnees = mysql_fetch_array($reponse)){
					$html='';
					$html .= '<div class="line_link">';
					$html .= '<img class="btn_edit" src="../images/icone.ico" alt="X" title="edit"/>';
					$html .= '<a href="'.(substr($donnees['link'],0,7)!="http://"?"http://":"").$donnees['link'].'" rel="'.$donnees['id'].'" target="_blanc">'.($donnees['name']?$donnees['name']:$donnees['link']).'</a>';
					$html .= '</div>';
					echo $html;				
				}
				echo '</div>';
			}
			*/
			
			// MAIN 	
			$requete= "Select * from fav where note>=0 order by folder ASC, note desc, id desc";	
			$reponse = mysql_query($requete,$id) or die(mysql_error());
			$i=0;
			if($reponse){
				$fold = "Non-Classé";
				$html = '<h3>'.$fold.'<span title="Toggle"></span></h3><div class="folder_link">';
				while($donnees = mysql_fetch_array($reponse)){
					if($fold != $donnees['folder'] && $donnees['folder'] != ''){
						$i++;
						echo '<div class="block_link'.($i!=1 && $i!=5?' close':'').'">'.$html.'</div></div>';
						$fold = $donnees['folder'];
						$html = '<h3>'.ucfirst($fold).'<span title="Toggle"></span></h3><div class="folder_link">';
						if($i%4==0){ echo '</div><div class="list_link">'; }
					}
					$html .= '<div class="line_link">';
					$html .= '<img class="btn_edit" src="../images/icone.ico" alt="X" title="edit"/>';
					$html .= '<a href="'.(substr($donnees['link'],0,7)!="http://"?"http://":"").$donnees['link'].'" rel="'.$donnees['id'].'" target="_blanc"><span class="title">'.($donnees['name']?$donnees['name']:minify($donnees['link'])).'</span><span class="preview" title="preview"></span><span class="note'.($donnees['note']?' not'.$donnees['note']:'').'"></span></a>';
					$html .= '</div>';
					
				}
				if($html != '<h3>'.$fold.'<span title="Toggle"></span></h3><div class="folder_link">'){
					echo '<div class="block_link close">'.$html.'</div></div>';
				}
			}