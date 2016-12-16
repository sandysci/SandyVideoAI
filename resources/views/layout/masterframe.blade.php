<html>
<head>
	@include('layout.head')
	 <style>
	 .containers
	 {
		width:400px;
		height:300px;
		padding:20px;
		border:1px solid gray;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
	  background: black;
	}

	.image-slider-wrapper
	{
	overflow: hidden;
	}

	#image_slider
	{
		position: relative;
		overflow: hidden;
		height: 280px;
		padding:0;
		left:0;
	}
	
	#image_slider li
	{
		position:relative;
		max-width: 100%;
		float:left;
		list-style: none;
		left: 0;
	}
   
  </style>
      
</head>

<body style="background-color:white">
	<a id="back-top" href="javascript:void(0)"><i class="icon-chevron-up"></i></a>
	@yield('frame')
	@include('layout.contact')	
</body>
</html>