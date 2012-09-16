<form id="sube-musica">

	<div class="heading">Subir m&uacute;sica a Devicelost</div>
	
	<div class="content">
	
		<p><i class="icon-info-sign"></i> Primero rellena estos campos, despu&eacute;s a&ntilde;ade las canciones a la lista de carga y para terminar, pulsa aceptar.</p>

		<div>
			<input type="text" name="autor" class="input1 w100 f300" placeholder="Autor" /> &nbsp;
			<input type="text" name="disco" class="input1 w100 f300" placeholder="Disco" /> &nbsp;
			<input type="number" name="a–o" class="input1 w100" min="1700" max="<?=date('Y')?>" placeholder="A&ntilde;o" />
		</div>
		
		<p style="color:#c00;"><i class="icon-warning-sign"></i> Una vez iniciado el proceso de carga, es muy importante que no cierres la p&aacute;gina hasta que se haya completado.</p>
		
		<input type="file" name="file_upload" id="file_upload" />
	</div>

</form>

