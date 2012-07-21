<div id="sidebar" class="nano">
<div class="content">
	<ul>
		<?PHP
		for($i=0;$i<10;$i++){
		?>
		<li>Menu <?=$i?></li>
		<ul>
			<li><a href="javascript:display('on'); return false;">Test display ON</a></li>
			<li><a href="javascript:display('off'); return false;">Test display OFF</a></li>
			<li>Submenu <?=$i?></li>
		</ul>
		<?PHP
		}
		?>
	</ul>
</div>
</div>

<div id="reproductor">
	<ul id="controles">
		<li id="anterior"><a href="#">Anterior</a></li>
		<li id="playpause"><a href="#">Play</a></li>
		<li id="siguiente"><a href="#">Siguiente</a></li>
	</ul>
	
	<div id="display">
		<div id="tiempo">1:23</div>
		<div id="titulo">Cat Power - I found a reason</div>
		<div>
			<div>
				<div></div>
			</div>
		</div>
	</div>
</div>
