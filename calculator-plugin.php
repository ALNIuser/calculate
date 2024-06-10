<?php
   /*
   Plugin Name: Калькулятор стоимости натяжных потолков
   Description: Плагин для расчета стоимости натяжных потолков на WordPress.
   Version: 1.1 Lite
   Author: ALNIuser
   */
function display_calculator() {
       ob_start();
       ?>
       <div class="calculator-container">
           <div class="calculator border rounded shadow-sm">
               <h3 class="my-3 text-center">Калькулятор стоимости натяжного потолка</h3>
               <form id="calculator">
                   <table class="table table-bordered table-hover">
                       <col width="70%">
                       <col width="30%">
                       <tbody>
                           <tr class="required">
                               <td>Площадь потолка</td>
                               <td><input name="area" type="text" value="" class="form-control form-control-sm"></td>
                               <td>м<sup>2</sup></td>
                           </tr>
                           <tr class="required">
                               <td>Фактура</td>
                               <td colspan="2">
                                   <select name="texture" class="form-control form-control-sm">
                                       <option value="mat">Матовый</option>
                                       <option value="glossy">Глянцевый</option>
                                       <option value="satin">Сатиновый</option>
                                       <option value="fabric">Тканевый</option>
                                   </select>
                               </td>
                           </tr>
                           <tr>
                               <td>Количество углов</td>
                               <td><input name="corners" type="number" value="" class="form-control form-control-sm"></td>
                               <td>шт</td>
                           </tr>
                           <tr>
                               <td>Люстр</td>
                               <td><input name="chandelier-hook" type="number" value="" class="form-control form-control-sm"></td>
                               <td>шт</td>
                           </tr>
                           <tr>
                               <td>Светильников</td>
                               <td><input name="lamp" type="number" value="" class="form-control form-control-sm"></td>
                               <td>шт</td>
                           </tr>
                           <tr>
                               <td>Трубы в потолок</td>
                               <td><input name="tube" type="number" value="" class="form-control form-control-sm"></td>
                               <td>шт</td>
                           </tr>
                           <tr>
                               <td>Стоимость без скидки</td>
    <td colspan="2" class="total">
        <strong class="d-block h5 total text-center" id="total_cost"></strong>
    </td>
</tr>
<tr>
    <td colspan="3" class="text-center">
        <button type="button" class="btn btn-primary" onclick="calculate()">Рассчитать</button>
    </td>
</tr>
</tbody>
</table>
</form>
</div>
</div>
<style>
.calculator-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.calculator {
    width: 30%; /* Уменьшаем ширину */
    padding: 20px;
}
.form-control-sm {
    padding: 5px; /* Уменьшаем высоту */
    font-size: 12px;
}
.text-center {
    text-align: center;
}
</style>
<script>
function calculate() {
    const area = parseFloat(document.querySelector('input[name="area"]').value.replace(',', '.'));
    const texture = document.querySelector('select[name="texture"]').value;
    const corners = parseInt(document.querySelector('input[name="corners"]').value);
    const chandelierHook = parseInt(document.querySelector('input[name="chandelier-hook"]').value);
    const lamp = parseInt(document.querySelector('input[name="lamp"]').value);
    const tube = parseInt(document.querySelector('input[name="tube"]').value);
    
    if (isNaN(area) || isNaN(corners) || isNaN(chandelierHook) || isNaN(lamp) || isNaN(tube)) {
        alert("Пожалуйста, введите все необходимые значения.");
        return;
    }
    
    let total = 0;
    
    switch (texture) {
        case 'mat':
            total += area * 100;
            break;
        case 'glossy':
            total += area * 150;
            break;
        case 'satin':
            total += area * 200;
            break;
        case 'fabric':
            total += area * 300;
            break;
    }
    
    total += corners * 50;
    total += chandelierHook * 500;
    total += lamp * 250;
    total += tube * 250;
    total += area * 110;
    
    document.getElementById('total_cost').textContent = total.toLocaleString() + ' руб';
}
</script>
<?php
return ob_get_clean();
}
add_shortcode('calculator', 'display_calculator');
