<?php
use yii\helpers\Html;
?>
<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <td>
                        <?=Html::img("@web/images/products/{$item['img']}", [
                            'alt' => $item['name'],
                            'class' => 'preview',
                        ]);?>
                    </td>
                    <td><?=$item['name'];?></td>
                    <td><?=$item['qty'];?></td>
                    <td><?=$item['price'];?></td>
                    <td>
                        <a class="del-item glyphicon glyphicon-remove text-danger" data-id="<?=$id?>" href="<?=\yii\helpers\Url::to(['cart/del', 'id'=>$id]);?>"></a>
                    </td>
                </tr>
            <?php endforeach;?>
                <tr>
                    <td colspan="4">Итого: </td>
                    <td><?=$session['cart.qty'];?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму: </td>
                    <td><?=$session['cart.sum'];?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h1>Корзина пуста</h1>
<?php endif; ?>