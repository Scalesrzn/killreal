
<link href="lab1.css" rel="stylesheet">
<div id="vneshniy">
	<div id="block1">
		<div id="block11">
		</div>
		<div id="block12">
		</div>
	</div>
	<div id="block2">
		<div class="block2x4">
			<div class="block211">
				<div class="block222">
					<div id="block2221">
					</div>
					<div id="block2222">
					</div>
				</div>
				<div class="block222">
				</div>
			</div>
			<div class="block212">
			</div>
		</div>
		<div class="block2x4">
			<div class="block212">
			</div>
			<div id="red" class="block211">
			</div>
		</div>
		<div class="block2x4">
			<div class="block211">
			</div>
			<div id="yellow" class="block212">
			</div>
		</div>
		<div class="block2x4">
			<div id="green" class="block24x4">
			</div>
			<div class="block24x4">
			</div>
			<div class="block24x4">
			</div>
			<div class="block24x4">
			</div>
		</div>
	</div>

</div>


<div class="contact_form">
	<form class="form" action="POST">
		<p>
			<span id="formlabel">Форма заказа товара со склада</span>
		</p>
		<p>
			<label id="name">Имя:</label>
			<input type="text"  name="name" placeholder="Введите Ваше имя" required />
		</p>
		<p>
			<label id="email">E-mail:</label>
			<input type="email" name="email" placeholder="Введите Ваш E-mail" required />
		</p>
		<p>
			<label id="tel">Телефон:</label>
			<input type="tel" name="tel" minlength="18" maxlength="18" pattern="[\+]\d{1}\s[\(]\d{3}[\)]\s\d{3}[\-]\d{2}[\-]\d{2}" placeholder= "Введите номер телефона" required />
		</p>
		<p>
			<label id = "city">Город:</label>
			<input type ="text" name="city" placeholder = "Введите город, в котором вы хотите забрать товар" pattern= "(http|https)://.+"/>
		</p>
		<p>
			<label id = "item">Способ получения товара:</label>
			<select size="1">
				<option>Самовывоз</option>
				<option>Доставка курьером</option>
			</select>
		</p>
		<p>
			<label id="message">Текст сообщения:</label>
			<textarea name="message" cols="40" rows="6" required ></textarea>
		</p>
		<div class="btnform">
			<button class="btn" type="submit">
				Отправить сообщение
			</button>
		</div>

	</form>
</div>
