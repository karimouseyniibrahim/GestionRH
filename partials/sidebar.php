	 <!-------sidebar--design------------>
	 
	 <?php $myMenu1=MenuSideBar($_SESSION['role']);

	 ?>
	 <div id="sidebar">
	    <div class="sidebar-header">
		    <img src="<?php echo $_SERVER['HTTP_HOST']==URL_FINANCE?'img/logoF.png':'img/logo-icrisat.png';?>" class="img-fluid" style="height:150px" />  v0.1
		</div>
		<ul class="list-unstyled component m-0">
		  <li >
		  <a href="#" class="dashboard"><i class="material-icons">dashboard</i>Tableau de bord </a>
		  </li>
		  
		  <?php foreach($myMenu1 as $m): 
			$subMenu1=MenuSideBarNiveau1($_SESSION['role'],$m->id);
			?>

			<li class="dropdown"  >
				<a href="<?php echo (count($subMenu1)>0?"#":"").$m->url?>"  <?php echo (count($subMenu1)>0?  'data-toggle="collapse" aria-expanded="true" 
			aria-controls="'.$m->url.'" class="dropdown-toggle"':"")?> >
					<i class="material-icons"><?php echo $m->icon?></i><?php echo $m->name?>
				</a>
				<?php foreach($subMenu1 as $sub1): 
					$subMenu2=MenuSideBarNiveau2($_SESSION['role'],$sub1->id);
					?>
					<ul class="list-unstyled menu collapse" id="<?php echo $m->url?>" style="">
						<li class="<?php echo  $_SERVER['REQUEST_URI']=='/'.$sub1->url?'active':''?>">
							<a href="<?php echo (count($subMenu2)>0?"#":"").$sub1->url?>"
							<?php echo (count($subMenu2)>0?  'data-toggle="collapse" aria-expanded="true" 
							class="dropdown-toggle"':"")?> ><?php echo $sub1->name?></a>
							<ul class="list-unstyled menu collapse" id="<?php echo $sub1->url?>" style="background-color: orange;">
							<?php foreach($subMenu2 as $sub2): ?>
								
									<li class="<?php echo  $_SERVER['REQUEST_URI']=='/'.$sub2->url?'active':''?>">
										<a href="<?php echo $sub2->url?>"><?php echo utf8_decode($sub2->name)?></a>
									</li>
								
							<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				<?php endforeach; ?>
		    </li>
		  <?php endforeach; ?>
		
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   