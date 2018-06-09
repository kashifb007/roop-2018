<?php
header("Content-type: text/css; charset: UTF-8");

// set up home page 4 card flips for services
for($x=1; $x<10; $x++)
{
?>

	#card<?php echo $x; ?> .front
	{
		margin: 0;
		display: block;
		width: 100%;
		height: 100%;
		backface-visibility: hidden;
		-webkit-backface-visibility: hidden;
		transform: rotateX(0deg);
	}

	#card<?php echo $x; ?> > .front.hide
	{
		position: absolute;
	}

	.grid_6 > #card<?php echo $x; ?> > .front.hide
	{
		position: absolute;
		display:none;
	}

	#card<?php echo $x; ?> .back
	{
		padding:5px;
		transform: rotateY( 180deg );
		display: none;
	}

	#card<?php echo $x; ?>
	{
		width: 100%;
		height: 100%;
		transform-style: preserve-3d;
		transition: transform 1s;
	}

	#card<?php echo $x; ?> .back.show
	  {
	    display:block;
	    padding: 5px 10px;
	  }


	  .grid_6 > #card<?php echo $x; ?> .back.show
	  {
	    display:block;
	    padding: 5px 10px;
	    color:white;
	    background: rgba(253, 0, 125, 0.75);
	    min-height: 234px;
	  }

	#card<?php echo $x; ?>.flipped
	  {
	    transform: rotateY( 180deg );
	  }

<?php
}


for($x=1; $x<4; $x++)
{
?>

	#bridal_card<?php echo $x; ?> .front
	{
		margin: 0;
		display: block;
		width: 100%;
		height: 100%;
		backface-visibility: hidden;
		-webkit-backface-visibility: hidden;
		transform: rotateX(0deg);
	}

	#bridal_card<?php echo $x; ?> > .front.hide
	{
		position: absolute;
	}

	.grid_6 > #bridal_card<?php echo $x; ?> > .front.hide
	{
		position: absolute;
		display:none;
	}

	#bridal_card<?php echo $x; ?> .back
	{
		padding:5px;
		transform: rotateY( 180deg );
		display: none;
	}

	#bridal_card<?php echo $x; ?>
	{
		width: 100%;
		height: 100%;
		transform-style: preserve-3d;
		transition: transform 1s;
	}

	#bridal_card<?php echo $x; ?> .back.show
	  {
	    display:block;
	    padding: 5px 10px;
	  }
	  

	  .grid_6 > #bridal_card<?php echo $x; ?> .back.show
	  {
	    display:block;
	    padding: 5px 10px;
	    color:white;
	    background: rgba(253, 0, 125, 0.75);
	    min-height: 234px;
	  }

	#bridal_card<?php echo $x; ?>.flipped
	  {
	    transform: rotateY( 180deg );
	  }

<?php
}



?>