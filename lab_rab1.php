
		<div class='center'>
                <div class="table-structure">
                        <h2 style="text-align:center;">Табличная структура</h2>
                        
                        <table class="table">
                        
                            <tbody>
                                    <tr>
                                            <td style="background-color:yellow;"></td>
                                            <td colspan="3"></td>
                                            <td rowspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td style="background-color:blue;" rowspan="2"></td>
                                            <td rowspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td rowspan="2"></td>
                                            <td style="background-color:red;" rowspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td style="background-color:green;"></td>
                                            <td></td>
                                        </tr>									
                            </tbody></table>
                        </div>

                        <div class="order">				
                                <h2>Форма записи к врачу</h2>
                                        
                                    <div class="field-block">
                                        <label for="name">Ваше имя:</label>
                                        <input id="name" class="field" name="name" required type="text" placeholder="Иванов Иван Иванович">
                                    </div>
                                    
                                    <div class="field-block">
                                        <label for="age">Дата рождения:</label>
                                        <input id="age" class="field" name="age" required type="date">
                                    </div>
                                    
                                    <div class="field-block">
                                        <label for="date">Желаемая дата посещения врача:</label>
                                        <input id="date" class="field" name="date" required type="date">
                                    </div>
                                    
                                
                                    <div class="field-block">
                                        <label for="doctor">Имя лечащего врача:</label>
                                        <input id="doctor" class="field" name="doctor" required type="text" placeholder="Протезист Иванов И.И.">
                                    </div>
                                            
                                    <div class="field-block">
                                        <label for="email">Ваш E-mail:</label>
                                        <input id="email" class="field" name="email" required type="email" placeholder="ivanov@email.com">
                                    </div>
                                
                                    <div class="field-block">
                                        <label for="phone">Ваш телефон:</label>
                                        <input id="phone" class="field" name="phone" required type="text" placeholder="+7 (800) 000-00-00">
                                     </div>
                                
                                    <div class="field-block">
                                        <label for="message">Текст сообщения:</label>
                                        <textarea id="message" class="field" required name="message" rows="4"></textarea>
                                    </div>
                                
                                    <div class="field-block">
                                        <input id="check" name="check" checked type="checkbox">
                                        <span class="check-text">Я добровольно отправляю свои данные</span>
                                    </div>
                                
                                    <button id="button" class="button" type="submit">Отправить</button>	
                                
                                </div>
		</div>
		<div class="rborder">
		</div>
	</div>
	