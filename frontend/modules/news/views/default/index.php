<?php

?>
<div class="row">
    <div class="col-md-2">
        <div>

            <?php

            // создадим массив с годами
            $year = [];
            foreach ($years as $item){
                if (!in_array($item['year'], $year))
                {
                    array_push($year, $item['year']);
                }
            }

            // переберем массив полученных данных с учетом годов и выделим из него месяцы
            echo '<a href="/news/default/index"><p><b>' . $year[$i] . '</b>Все публикации (' . count($news) . ')</p></a>';
            ?>
            <p><b>Годы:</b></p>
            <?php
            for ($i = 0; $i < count($year); $i++){
                echo '<a href="/news/default/index?y=' . $year[$i]. '"><b>' . $year[$i] . '</b></a><br>';
                foreach ($years as $y) {
                    if (in_array($year[$i], $y)) {
                        echo '<a href="/news/default/index?y=' . $year[$i] . '&m=' . $y['month'] . '"> - ' . $y['month'] . ' (' . $y['count'] . ')</a><br>';
                    }
                }
            }
            ?>
        </div>
        <hr>
        <div>
            <p><b>Темы:</b></p>
            <?php foreach ($themes as $theme) {
                echo '<a href="/news/default/index?t=' . $theme['theme_id'] . '">' . $theme['theme_title'] . ' (' . $theme['count'] . ')</a><br>';
            }?>
        </div>
    </div>
    <div class="col-md-10">
        <?php foreach ($news[0] as $item) {?>
            <b>Название:</b> <?= $item['title']?><br>
            <b>Дата публикации:</b> <?= $item['date']?><br>
            <b>Тема:</b> <?= $item['theme']?><br><br>
            <b>Текст:</b>  <?= substr($item['text'],0,256)?>...<br><br>
            <a href="/news/default/post?id=<?= $item['news_id'] ?>"><button>Читать далее</button></a>
            <hr>
        <?php } ?>
    </div>
</div>
<?php
$pag_str = ceil($news[1][0]['count'] / 5);
$page = $_GET['page'];
for ($i = 1; $i <= $pag_str; $i++){
    $page == $i ? $active = 'color:red' : $active = '';
    echo "<a href=/news/default/index?page=".$i."> <button style='{$active}'>".$i."</button> </a>";
}?>