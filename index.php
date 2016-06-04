<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Awesome test task</title>

	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	
</head>
<body>
	
	<?php
		if ( strlen($_SERVER['QUERY_STRING']) > 0 ) {
			parse_str($_SERVER['QUERY_STRING']);
			echo '<h1>Привет, ' . $name . '!</h1>';
		}
		else {
			echo '<h1>Awesome test task</h1>';
		}
	?>
	<ul>
		<?php
			include 'connect_bd.php';
			include 'function.php';
			
			ShowTreeList(0, 0); 
		?>
	</ul>
	<hr>
	<form id="form_id2">
		<input type="hidden" id="inputNameP" name="name"><br><br>
		<input type="button" class="add" id="addParent" value="Добавить родителя">
		<input type="button" class="save" value="Сохранить">
	</form>
	<hr>
	<form id="form_id3">
		<input type="hidden" id="inputNameC" name="name">
		<select id="selectParent" name="selectParent" style="display:none;">
			<option selected >Выберите родителя</option>
			
			<?php ShowParent(); ?>
		
		</select><br><br>
		<input type="button" class="add" id="addChild" value="Добавить ребенка">
		<input type="button" class="save" value="Сохранить">
	</form>
	<hr>
	<input type="button" id="button1" value="Кнопка 1">
	<P>Удаление имени</P>
	<select id="deleteName">
		<option selected >Выберите имя для удаления</option>
		
		<?php
			ShowTreeSelect(0, 0); 
			$dbh = null;
		?>
		
	</select>
	
	<div class="results"></div>
	
	<div class="popup" id="popup-ask" style="display: none">
		<div class="popup__overlay">
		<table>
			<tbody>
			<tr>
				<td>
				<div class="popup__dark js-popup-close"></div>
				<div class="popup__block">
					<div class="popup__close js-popup-close"></div>
					<div id="formHide">
						<h2 class="popup__title">Введите Ваше имя</h2>
						<form method="GET" id="form_id1">
							<input type="text" class="txt-input" placeholder="Ваше имя" name="name">
							<input type="submit" class="btn btnform" value="Отправить">
						</form>
					</div>
					<div id="result1"></div>
				</div>
				</td>
			</tr>
			</tbody>
		</table>
		</div>
	</div>
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/ajax.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>
</body>
</html>


