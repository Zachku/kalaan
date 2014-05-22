<h1>Add new lure</h1>

<div>
    <?php $this->renderPartial('_lake_form', array('lake' => $lake)); ?>
</div>  

<div>
    <h2>All lakes</h2>
    <table>
        <tr><th>Town</th><th>Lake</th></tr>
        <?php foreach ($lakes as $lake) { ?>
            <tr><td><?php echo $lake->town; ?></td><td><?php echo $lake->lake_name; ?></td></tr>

        <?php } ?>
    </table>
</div>