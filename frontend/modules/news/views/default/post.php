<div class="row">
    <div class="col-md-2">
        <div>
            <p><b>Годы:</b></p>
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
            echo '<a href="/news/default/index"><p><b>' . $year[$i] . '</b>Все публикации</p></a>';
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
        <hr>
            <b>Название:</b> <?= $post['title']?><br>
            <b>Дата публикации:</b> <?= $post['date']?><br>
            <b>Тема:</b> <?= $post['theme']?><br><br>
            <b>Текст:</b>  <?= $post['text']?>
    </div>
</div>
