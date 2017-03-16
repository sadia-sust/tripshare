<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
	@include('layouts.head')
	<body>
		<!---start-wrap---->
			@include('layouts.header')
		<!---start-content---->
		<div class="content">
			<div class="wrap">
			 <div id="main" role="main">
			 	@yield('content')
			    </div>
			</div>
		</div>
		<!---//End-content---->
		@include('layouts.footer')
		<!---//End-wrap---->
	</body>
</html>

