<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$HomeLink =  Yii::app()->createUrl('/site/index'); 

?>
<!-- Header -->
<div class=row>
	<div class="jumbotron col-md-10 col-md-offset-1 jumboheader">
			<div class=row>
				<h2>Hello <?php echo Yii::app()->user->name; ?></h2>
				<p>
					<?php 
						echo "We are waiting for ".$invitee->username." to answer the call ..."; 
					?>
				</p>
		</div>
	</div>
</div>
<?php
	/*
	echo "<pre>";
	var_dump($invitee->ownUserStories[0]->userStory);
	echo sizeOf($invitee->ownUserStories);
	echo "</pre>";
	*/
?>
<!-- Main -->
<div class=row">
	<div class="jumbotron col-md-10 col-md-offset-1">
		<p class=lead>
		While waiting ...
		</p>
		<br/>
		<div class=row>
			<!-- Carousel START-->
				  <?php
						  for ($i = 0; $i < sizeOf($invitee->ownUserStories); $i++) {
							echo  "<div class='media'>
								<a class='pull-left' href='#'>
									<img class='media-object img-circle' style='max-height:120px;' src='images/userImages/user" . $invitee->userID . ".jpg'>
								</a>
								<div class='media-body'>
									<h3 class='media-heading'>Did you know about ".$invitee->username."?</h3>
									<p>". $invitee->ownUserStories[$i]->userStory. "</p>
								</div>
							</div>";
							}
					?>
				<!-- Carousel END-->
		</div>
	</div>

<!-- Footer -->
<div class=row>
		<div class="jumbotron col-md-10 col-md-offset-1">
			<div class="col-md-4 col-md-offset-4">
			<!--TODO: replace hard-coded logout-->
				<a href='<?php echo $HomeLink; ?>';">Hang Up!&nbsp;<span style="cursor:pointer" class="glyphicon glyphicon-log-out" alt="Bye!"></span></a>
			</div>
		</div>
</div>	
	
</div>