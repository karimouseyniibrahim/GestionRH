	 <!-------sidebar--design------------>
	 
	 <?php $myMenu1=MenuSideBar($_SESSION['role']);

	 ?>
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img src="img/logo.jpg" class="img-fluid"/><span>Systeme Payroll</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="active">
		  <a href="#" class="dashboard"><i class="material-icons">dashboard</i>Dashboard </a>
		  </li>
		  <?php foreach($myMenu1 as $m): 
			$subMenu1=MenuSideBarNiveau1($_SESSION['role'],$m->id);
			?>

			<li class="dropdown"  >
				<a href="<?php echo (count($subMenu1)>0?"#":"").$m->url?>"  <?php echo (count($subMenu1)>0?  'data-toggle="collapse" aria-expanded="false" 
			class="dropdown-toggle"':"")?>>
					<i class="material-icons"><?php echo $m->icon?></i><?php echo $m->name?>
				</a>
				<?php foreach($subMenu1 as $sub1): 
					$subMenu2=MenuSideBarNiveau2($_SESSION['role'],$sub1->id);
					?>
					<ul class="list-unstyled menu collapse" id="<?php echo $m->url?>" style="">
						<li>
							<a href="<?php echo (count($subMenu2)>0?"#":"").$sub1->url?>"
							<?php echo (count($subMenu2)>0?  'data-toggle="collapse" aria-expanded="false" 
							class="dropdown-toggle"':"")?> ><?php echo $sub1->name?></a>

							<?php foreach($subMenu2 as $sub2): ?>
								<ul class="list-unstyled menu collapse" id="<?php echo $sub1->url?>" style="">
									<li>
										<a href="<?php echo $sub2->url?>"><?php echo $sub2->name?></a>
									</li>
								</ul>
							<?php endforeach; ?>
						</li>
					</ul>
				<?php endforeach; ?>
		    </li>
		  <?php endforeach; ?>
		
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   